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
    public ?string $qrCodeCid = null;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
        
        Log::info('RegistrationApprovedMail: Starting QR code generation', [
            'registration_id' => $this->registration->id,
            'registration_number' => $this->registration->registration_number,
            'existing_barcode' => $this->registration->barcode,
        ]);
        
        // Generate QR code if registration number exists
        if ($this->registration->registration_number) {
            // Force regenerate base64 QR code (always fresh for email)
            Log::info('RegistrationApprovedMail: Generating base64 QR code', [
                'registration_number' => $this->registration->registration_number,
            ]);
            
            try {
                $this->qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                
                // Validate base64 result
                if (empty($this->qrCodeBase64) || !str_starts_with($this->qrCodeBase64, 'data:image/png;base64,')) {
                    Log::warning('RegistrationApprovedMail: Base64 QR code invalid, retrying...');
                    // Retry once
                    $this->qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                }
                
                Log::info('RegistrationApprovedMail: Base64 QR code generated', [
                    'has_base64' => !empty($this->qrCodeBase64),
                    'base64_length' => strlen($this->qrCodeBase64 ?? ''),
                    'starts_with_data_url' => !empty($this->qrCodeBase64) && str_starts_with($this->qrCodeBase64, 'data:image/png;base64,'),
                ]);
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Failed to generate base64 QR code', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                $this->qrCodeBase64 = '';
            }
            
            // Always generate/verify barcode file exists
            $barcodePathToCheck = $this->registration->barcode ? str_replace('storage/', '', $this->registration->barcode) : null;
            $barcodeFileExists = $barcodePathToCheck && Storage::disk('public')->exists($barcodePathToCheck);
            
            if ($barcodeFileExists) {
                Log::info('RegistrationApprovedMail: Using existing barcode file', [
                    'path' => $this->registration->barcode,
                ]);
                $this->qrCodePath = $this->registration->barcode;
            } else {
                // Generate new barcode file
                Log::info('RegistrationApprovedMail: Generating new barcode file', [
                    'registration_number' => $this->registration->registration_number,
                ]);
                
                try {
                    $this->qrCodePath = BarcodeService::generateBarcode(
                        $this->registration->registration_number,
                        $this->registration->registration_number
                    );
                    
                    if ($this->qrCodePath) {
                        $verifyPath = str_replace('storage/', '', $this->qrCodePath);
                        $fileExists = Storage::disk('public')->exists($verifyPath);
                        
                        Log::info('RegistrationApprovedMail: Barcode file generated', [
                            'path' => $this->qrCodePath,
                            'exists' => $fileExists,
                        ]);
                        
                        // Update registration with barcode path
                        $this->registration->update(['barcode' => $this->qrCodePath]);
                        Log::info('RegistrationApprovedMail: Updated registration with barcode path');
                    } else {
                        Log::error('RegistrationApprovedMail: Barcode file generation returned null');
                        $this->qrCodePath = null;
                    }
                } catch (\Exception $e) {
                    Log::error('RegistrationApprovedMail: Failed to generate barcode file', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $this->qrCodePath = null;
                }
            }
            
            // If base64 is empty but we have a file, generate base64 from file
            if (empty($this->qrCodeBase64) && $this->qrCodePath) {
                try {
                    $barcodePathToCheck = str_replace('storage/', '', $this->qrCodePath);
                    if (Storage::disk('public')->exists($barcodePathToCheck)) {
                        $qrCodeContent = Storage::disk('public')->get($barcodePathToCheck);
                        if ($qrCodeContent) {
                            $this->qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeContent);
                            Log::info('RegistrationApprovedMail: Generated base64 from file as fallback', [
                                'base64_length' => strlen($this->qrCodeBase64),
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('RegistrationApprovedMail: Failed to generate base64 from file', [
                        'error' => $e->getMessage(),
                    ]);
                }
            }
            
            // Final validation - ensure we have at least base64
            if (empty($this->qrCodeBase64) && $this->qrCodePath) {
                // Last attempt: try to generate base64 from file one more time
                try {
                    $barcodePathToCheck = str_replace('storage/', '', $this->qrCodePath);
                    if (Storage::disk('public')->exists($barcodePathToCheck)) {
                        $qrCodeContent = Storage::disk('public')->get($barcodePathToCheck);
                        if ($qrCodeContent) {
                            $this->qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeContent);
                            Log::info('RegistrationApprovedMail: Final attempt - Generated base64 from file');
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('RegistrationApprovedMail: Final attempt failed', [
                        'error' => $e->getMessage(),
                    ]);
                }
            }
            
            // Log final status
            if (empty($this->qrCodeBase64) && empty($this->qrCodePath)) {
                Log::error('QR code generation completely failed for registration', [
                    'registration_id' => $this->registration->id,
                    'registration_number' => $this->registration->registration_number,
                ]);
            } else {
                Log::info('RegistrationApprovedMail: QR code generation completed', [
                    'has_base64' => !empty($this->qrCodeBase64),
                    'base64_length' => strlen($this->qrCodeBase64 ?? ''),
                    'has_path' => !empty($this->qrCodePath),
                ]);
            }
        } else {
            Log::warning('No registration number found for QR code generation', [
                'registration_id' => $this->registration->id,
            ]);
        }
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $message = $this->subject('Konfirmasi Pendaftaran - Satpam Fun Run 5K')
            ->from(config('mail.from.address'), config('mail.from.name'));
        
        Log::info('RegistrationApprovedMail: Building email message', [
            'registration_id' => $this->registration->id,
            'has_base64' => !empty($this->qrCodeBase64),
            'has_path' => !empty($this->qrCodePath),
        ]);
        
        // Prepare QR code content for CID embedding
        $qrCodeContent = null;
        $qrCodeCid = null;
        
        // Try to get QR code from file first (most reliable)
        if ($this->qrCodePath) {
            $barcodePathToCheck = str_replace('storage/', '', $this->qrCodePath);
            Log::info('RegistrationApprovedMail: Checking barcode file', [
                'original_path' => $this->qrCodePath,
                'check_path' => $barcodePathToCheck,
                'exists' => Storage::disk('public')->exists($barcodePathToCheck),
            ]);
            
            if (Storage::disk('public')->exists($barcodePathToCheck)) {
                try {
                    $qrCodeContent = Storage::disk('public')->get($barcodePathToCheck);
                    Log::info('RegistrationApprovedMail: Read QR code file successfully', [
                        'file_size' => strlen($qrCodeContent),
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to read QR code file: ' . $e->getMessage(), [
                        'path' => $barcodePathToCheck,
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            } else {
                Log::warning('QR code file does not exist', [
                    'path' => $barcodePathToCheck,
                ]);
            }
        }
        
        // If no file, try to decode from base64
        if (!$qrCodeContent && $this->qrCodeBase64) {
            Log::info('RegistrationApprovedMail: Attempting to decode base64 QR code');
            try {
                // Remove data URL prefix if present
                $base64Data = preg_replace('/^data:image\/png;base64,/', '', $this->qrCodeBase64);
                $qrCodeContent = base64_decode($base64Data, true);
                if ($qrCodeContent === false) {
                    Log::error('Failed to decode QR code base64 - invalid base64 string');
                    $qrCodeContent = null;
                } else {
                    Log::info('RegistrationApprovedMail: Decoded base64 QR code successfully', [
                        'decoded_size' => strlen($qrCodeContent),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Failed to decode QR code base64: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
        
        // Use base64 as primary method (most reliable for email clients)
        // CID embedding is complex and may not work in all email clients
        // Base64 works in Gmail, Outlook, Apple Mail, and most modern clients
        if ($this->qrCodeBase64) {
            Log::info('RegistrationApprovedMail: Using base64 QR code for email');
            $qrCodeCid = null; // We'll use base64 directly in the view
        } else {
            Log::warning('RegistrationApprovedMail: No base64 QR code available, will try to generate from file');
            // Try to generate base64 from file content if available
            if ($qrCodeContent) {
                try {
                    $this->qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeContent);
                    Log::info('RegistrationApprovedMail: Generated base64 from file content');
                } catch (\Exception $e) {
                    Log::error('Failed to generate base64 from file: ' . $e->getMessage());
                }
            }
        }
        
        // Ensure variables are always set (even if null/empty)
        $qrCodeBase64 = $this->qrCodeBase64 ?? '';
        $qrCodePath = $this->qrCodePath ?? null;
        
        Log::info('RegistrationApprovedMail: Final variables for view', [
            'has_base64' => !empty($qrCodeBase64),
            'base64_length' => strlen($qrCodeBase64),
            'has_path' => !empty($qrCodePath),
            'path' => $qrCodePath,
        ]);
        
        return $message->view('emails.registration_approved')
            ->with([
                'qrCodeBase64' => $qrCodeBase64,
                'qrCodePath' => $qrCodePath,
                'qrCodeCid' => $qrCodeCid ?? null,
            ]);
    }
}


