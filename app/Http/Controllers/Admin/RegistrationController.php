<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Services\WhatsAppService;
use App\Services\BarcodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationApprovedMail;

class RegistrationController extends Controller
{
    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if (!in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = 20;
        }

        $registrationsQuery = Registration::query();

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $registrationsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('bib_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $registrations = $registrationsQuery
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'currentPerPage' => $perPage,
            'searchKeyword' => $request->input('search', ''),
        ]);
    }

    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }

    public function approve(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        // Generate registration number if not exists or format is old (not SFR - XXXX or SFR5xxx)
        if (!$registration->registration_number || 
            (!preg_match('/^SFR\s*-\s*\d{4}$/', $registration->registration_number) && 
             !preg_match('/^SFR5\d{4}$/', $registration->registration_number))) {
            $registration->registration_number = Registration::generateRegistrationNumber();
            Log::info('Generated registration number', [
                'registration_id' => $registration->id,
                'registration_number' => $registration->registration_number,
            ]);
        }

        // Always generate barcode if registration number exists (regenerate if missing or invalid)
        $barcodePath = null;
        if ($registration->registration_number) {
            $barcodePathToCheck = $registration->barcode ? str_replace('storage/', '', $registration->barcode) : null;
            
            // Check if barcode file exists, if not generate new one
            if (!$registration->barcode || !Storage::disk('public')->exists($barcodePathToCheck)) {
                Log::info('Generating barcode for registration', [
                    'registration_id' => $registration->id,
                    'registration_number' => $registration->registration_number,
                    'existing_barcode' => $registration->barcode,
                ]);
                
                $barcodePath = BarcodeService::generateBarcode(
                    $registration->registration_number,
                    $registration->registration_number
                );
                
                if ($barcodePath) {
                    Log::info('Barcode generated successfully', [
                        'barcode_path' => $barcodePath,
                    ]);
                } else {
                    Log::error('Failed to generate barcode', [
                        'registration_id' => $registration->id,
                        'registration_number' => $registration->registration_number,
                    ]);
                }
            } else {
                $barcodePath = $registration->barcode;
                Log::info('Using existing barcode', [
                    'barcode_path' => $barcodePath,
                ]);
            }
        }

        // Update registration with all data (including registration_number and barcode)
        $registration->update([
            'registration_number' => $registration->registration_number,
            'status' => 'approved',
            'payment_status' => 'verified',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
            'rejected_at' => null,
            'barcode' => $barcodePath ?? $registration->barcode,
        ]);
        
        // Refresh registration to ensure we have latest data
        $registration->refresh();
        
        Log::info('Registration approved and saved', [
            'registration_id' => $registration->id,
            'registration_number' => $registration->registration_number,
            'barcode' => $registration->barcode,
        ]);

        // Send Email notification (automatic)
        try {
            if (!empty($registration->email)) {
                Mail::to($registration->email)->send(new RegistrationApprovedMail($registration));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to send approval email', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage(),
            ]);
        }

        $successMessage = 'Pendaftaran berhasil disetujui. Email konfirmasi telah dikirim.';

        return redirect()->route('admin.registrations.index')
            ->with('success', $successMessage)
            ->with('whatsapp_url', null)
            ->with('whatsapp_sent', false);
    }

    public function reject(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $registration->update([
            'status' => 'rejected',
            'payment_status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'rejected_at' => now(),
            'approved_at' => null,
        ]);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran telah ditolak.');
    }

    private function sendWhatsAppNotification(Registration $registration): array
    {
        $whatsappService = new WhatsAppService();

        $message = "Halo {$registration->first_name},\n\n";
        $message .= "Pendaftaran Anda untuk *Satpam Fun Run 5K* telah dikonfirmasi!\n\n";
        $message .= "📋 *Nomor Pendaftaran:* {$registration->registration_number}\n";
        $message .= "👤 *Nama:* {$registration->full_name}\n";
        $message .= "🏃 *Kategori:* {$registration->category}\n";
        $message .= "📅 *Tanggal Event:* 4 Januari 2026\n\n";
        $message .= "Silahkan cek detail lengkap pendaftaran Anda di:\n";
        $message .= url('/registration/check') . "?registration_number={$registration->registration_number}\n\n";
        $message .= "Terima kasih dan selamat berlari! 🏃‍♂️🏃‍♀️";

        // Send message via WhatsApp service
        return $whatsappService->sendMessage($registration->phone, $message);
    }
}
