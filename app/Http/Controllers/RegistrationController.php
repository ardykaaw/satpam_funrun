<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Settings;
use App\Mail\RegistrationConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Check if registration is open
        if (!Settings::isRegistrationOpen()) {
            return redirect()->route('archive.register')
                ->withErrors(['registration_closed' => 'Pendaftaran saat ini sudah ditutup.']);
        }

        $validator = Validator::make($request->all(), [
            'categoryType' => 'required|in:satpam,umum',
            'category' => 'required|string',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bibName' => 'required|string|max:16',
            'phone' => 'required|string|max:20',
            'birthDate' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'occupation' => 'required|string|max:255',
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
            'satpamCard' => 'required_if:categoryType,satpam|file|mimes:jpeg,jpg,png,pdf|max:10240', // 10MB, required only for satpam
            'consent' => 'required|accepted',
        ]);

        if ($validator->fails()) {
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
        
        // Generate unique price code
        $uniquePriceCode = Registration::generateUniquePriceCode($request->categoryType);

        // Split full name into first and last name
        $fullName = trim($request->fullName);
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        // Create registration
        $registration = Registration::create([
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
            'occupation' => $request->occupation,
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
}
