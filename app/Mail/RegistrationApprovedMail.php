<?php

namespace App\Mail;

use App\Models\Registration;
use App\Services\BarcodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RegistrationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Registration $registration;
    public ?string $qrCodePath = null;
    public ?string $qrCodeBase64 = null;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
        
        // Generate QR code if registration number exists
        if ($this->registration->registration_number) {
            // Try to use existing barcode if available
            if ($this->registration->barcode && Storage::disk('public')->exists(str_replace('storage/', '', $this->registration->barcode))) {
                $this->qrCodePath = $this->registration->barcode;
            } else {
                // Generate new barcode
                $this->qrCodePath = BarcodeService::generateBarcode(
                    $this->registration->registration_number,
                    $this->registration->registration_number
                );
                
                // Update registration with barcode path
                if ($this->qrCodePath) {
                    $this->registration->update(['barcode' => $this->qrCodePath]);
                }
            }
            
            // Generate base64 for inline use as fallback
            $this->qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
        }
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        $message = $this->subject('Konfirmasi Pendaftaran - Satpam Fun Run 5K')
            ->view('emails.registration_approved');
        
        // Embed QR code if available
        if ($this->qrCodePath && Storage::disk('public')->exists(str_replace('storage/', '', $this->qrCodePath))) {
            try {
                $qrCodeContent = Storage::disk('public')->get(str_replace('storage/', '', $this->qrCodePath));
                $message->attachData($qrCodeContent, 'qrcode.png', [
                    'mime' => 'image/png',
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to attach QR code to email: ' . $e->getMessage());
            }
        }
        
        return $message;
    }
}


