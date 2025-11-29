<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Settings;
use App\Mail\RegistrationConfirmationMail;
use App\Services\BarcodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Check if registration is open
        if (!Settings::isRegistrationOpen()) {
            return redirect()->route('archive.register')
                ->withErrors(['registration_closed' => 'Pendaftaran saat ini sudah ditutup.']);
        }

        // Build validation rules conditionally
        $rules = [
            'categoryType' => 'required|in:satpam,umum',
            'category' => 'required|string',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bibName' => 'required|string|max:16',
            'phone' => 'required|string|max:20',
            'birthDate' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'occupation' => 'required_if:categoryType,umum|nullable|string|max:255',
            'ktaNumber' => 'required_if:categoryType,satpam|nullable|string|max:255',
            'idType' => 'required|string',
            'idNumber' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'jerseySize' => 'required|in:XS,S,M,L,XL,XXL',
            'bloodType' => 'required|string',
            'emergencyName' => 'required|string|max:255',
            'emergencyPhone' => 'required|string|max:20',
            'community' => 'nullable|string|max:255',
            'medicalNotes' => 'nullable|string',
            'consent' => 'required|accepted',
        ];

        // Conditionally add satpamCard validation based on categoryType
        if ($request->categoryType === 'satpam') {
            $rules['satpamCard'] = 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'; // 10MB, required only for satpam
        } else {
            $rules['satpamCard'] = 'nullable|file|mimes:jpeg,jpg,png,pdf|max:10240'; // Optional for umum
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Registration validation failed', [
                'errors' => $validator->errors()->all(),
                'categoryType' => $request->categoryType,
                'input' => $request->except(['satpamCard', '_token']),
            ]);
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle file upload (only for satpam category)
        $satpamCardPath = null;
        if ($request->hasFile('satpamCard')) {
            $file = $request->file('satpamCard');
            $satpamCardPath = $file->store('satpam-cards', 'public');
        }
        
        // Split full name into first and last name
        $fullName = trim($request->fullName);
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        // Create registration with transaction to ensure atomicity
        // Generate unique price code inside transaction to prevent race conditions
        $registration = DB::transaction(function () use ($request, $satpamCardPath, $firstName, $lastName) {
            // Generate unique price code inside transaction
            $uniquePriceCode = Registration::generateUniquePriceCode($request->categoryType);
            
            // Create registration
            return Registration::create([
                'category' => $request->category,
                'category_type' => $request->categoryType,
                'unique_price_code' => $uniquePriceCode,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->email,
                'bib_name' => $request->bibName,
                'phone' => $request->phone,
                'birth_date' => $request->birthDate,
                'gender' => $request->gender,
                'occupation' => $request->categoryType === 'umum' ? $request->occupation : 'Satpam',
                'kta_number' => $request->categoryType === 'satpam' ? $request->ktaNumber : null,
                'id_type' => $request->idType,
                'id_number' => $request->idNumber,
                'address' => $request->address,
                'city' => $request->city,
                'jersey_size' => $request->jerseySize,
                'blood_type' => $request->bloodType,
                'emergency_name' => $request->emergencyName,
                'emergency_phone' => $request->emergencyPhone,
                'community' => $request->community,
                'medical_notes' => $request->medicalNotes,
                'payment_proof_path' => $satpamCardPath, // Store satpam card path here
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);
        });

        // Send confirmation email immediately
        try {
            Mail::to($registration->email)->send(new RegistrationConfirmationMail($registration));
        } catch (\Throwable $e) {
            Log::error('Failed to send registration confirmation email', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('registration.success', ['id' => $registration->id]);
    }

    public function success($id)
    {
        $registration = Registration::findOrFail($id);
        return view('archive.registration-success', compact('registration'));
    }

    public function check(Request $request)
    {
        $registration = null;
        
        if ($request->has('registration_number')) {
            $registration = Registration::where('registration_number', $request->registration_number)
                ->first();
        }

        return view('archive.check-registration', compact('registration'));
    }

    public function show($registrationNumber)
    {
        $registration = Registration::where('registration_number', $registrationNumber)
            ->firstOrFail();
        
        return view('archive.registration-detail', compact('registration'));
    }

    public function checkKta(Request $request)
    {
        $request->validate([
            'kta_number' => 'required|string',
        ]);

        $exists = Registration::where('kta_number', $request->kta_number)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function barcode($registrationNumber)
    {
        // URL decode the registration number
        $decodedNumber = urldecode($registrationNumber);
        
        // Handle various formats: "SFR - 0213", "SFR-0213", "SFR%20-%200213"
        $cleanNumber = str_replace([' ', '-'], '', $decodedNumber);
        $withSpace = preg_replace('/([A-Z]+)(\d+)/', '$1 - $2', $cleanNumber);
        $withDash = preg_replace('/([A-Z]+)(\d+)/', '$1-$2', $cleanNumber);
        
        $registration = Registration::where(function($query) use ($decodedNumber, $cleanNumber, $withSpace, $withDash) {
                $query->where('registration_number', $decodedNumber)
                      ->orWhere('registration_number', $cleanNumber)
                      ->orWhere('registration_number', $withSpace)
                      ->orWhere('registration_number', $withDash)
                      ->orWhere('registration_number', 'like', str_replace(' ', '%', $decodedNumber));
            })
            ->where('status', 'approved')
            ->firstOrFail();

        // Generate barcode if not exists
        $barcodePathToCheck = $registration->barcode ? str_replace('storage/', '', $registration->barcode) : null;
        
        // Try to find existing barcode file with various filename formats
        $possibleFilenames = [
            $barcodePathToCheck, // Original path from database
            'barcodes/' . $registration->registration_number . '.png', // With spaces
            'barcodes/' . str_replace(' ', '-', $registration->registration_number) . '.png', // With dashes
            'barcodes/' . str_replace([' ', '-'], '', $registration->registration_number) . '.png', // No spaces/dashes
        ];
        
        $foundBarcodePath = null;
        foreach ($possibleFilenames as $possiblePath) {
            if ($possiblePath && Storage::disk('public')->exists($possiblePath)) {
                $foundBarcodePath = $possiblePath;
                break;
            }
        }
        
        // If not found, generate new one
        if (!$foundBarcodePath) {
            $barcodePath = BarcodeService::generateBarcode(
                $registration->registration_number,
                $registration->registration_number // Use registration number as-is for filename
            );
            if ($barcodePath) {
                $registration->update(['barcode' => $barcodePath]);
                $foundBarcodePath = str_replace('storage/', '', $barcodePath);
            }
        }

        if ($foundBarcodePath && Storage::disk('public')->exists($foundBarcodePath)) {
            return response()->file(Storage::disk('public')->path($foundBarcodePath), [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'public, max-age=31536000',
                'Access-Control-Allow-Origin' => '*', // Allow email clients to load
            ]);
        }

        abort(404, 'Barcode not found');
    }
}
