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
                
                // Validate base64 result (use substr for PHP 7.x compatibility)
                if (empty($this->qrCodeBase64) || substr($this->qrCodeBase64, 0, 22) !== 'data:image/png;base64,') {
                    Log::warning('RegistrationApprovedMail: Base64 QR code invalid, retrying...', [
                        'base64_preview' => substr($this->qrCodeBase64 ?? '', 0, 50),
                    ]);
                    // Retry once
                    $this->qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                }
                
                Log::info('RegistrationApprovedMail: Base64 QR code generated', [
                    'has_base64' => !empty($this->qrCodeBase64),
                    'base64_length' => strlen($this->qrCodeBase64 ?? ''),
                    'starts_with_data_url' => !empty($this->qrCodeBase64) && substr($this->qrCodeBase64, 0, 22) === 'data:image/png;base64,',
                    'base64_preview' => substr($this->qrCodeBase64 ?? '', 0, 50),
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
        
        // Prepare QR code content for CID embedding (more reliable for mobile email clients)
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
        
        // If still no content, generate from registration number
        if (!$qrCodeContent && $this->registration->registration_number) {
            Log::info('RegistrationApprovedMail: Generating QR code content directly');
            try {
                // Generate base64 first
                $tempBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                if (!empty($tempBase64)) {
                    $base64Data = preg_replace('/^data:image\/png;base64,/', '', $tempBase64);
                    $qrCodeContent = base64_decode($base64Data, true);
                    if ($qrCodeContent && !$this->qrCodeBase64) {
                        $this->qrCodeBase64 = $tempBase64;
                    }
                    Log::info('RegistrationApprovedMail: Generated QR code content directly', [
                        'content_size' => strlen($qrCodeContent ?? ''),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Failed to generate QR code content', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        // Generate base64 from content if we have content but no base64
        if ($qrCodeContent && empty($this->qrCodeBase64)) {
            try {
                $this->qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeContent);
                Log::info('RegistrationApprovedMail: Generated base64 from content');
            } catch (\Exception $e) {
                Log::error('Failed to generate base64 from content: ' . $e->getMessage());
            }
        }
        
        // Final attempt: if still no base64, try to generate one more time
        if (empty($this->qrCodeBase64) && $this->registration->registration_number) {
            Log::warning('RegistrationApprovedMail: No base64 after all attempts, trying one final generation');
            try {
                $this->qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                if (!empty($this->qrCodeBase64) && substr($this->qrCodeBase64, 0, 22) === 'data:image/png;base64,') {
                    Log::info('RegistrationApprovedMail: Final generation successful');
                } else {
                    Log::error('RegistrationApprovedMail: Final generation failed or invalid format');
                }
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Final generation exception', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        // Try to embed as CID (for better mobile compatibility)
        // Get QR code content from file or decode from base64
        if (!$qrCodeContent && $this->qrCodePath) {
            $barcodePathToCheck = str_replace('storage/', '', $this->qrCodePath);
            if (Storage::disk('public')->exists($barcodePathToCheck)) {
                try {
                    $qrCodeContent = Storage::disk('public')->get($barcodePathToCheck);
                } catch (\Exception $e) {
                    Log::error('Failed to read QR code file for CID: ' . $e->getMessage());
                }
            }
        }
        
        // If no file content, decode from base64
        if (!$qrCodeContent && $this->qrCodeBase64) {
            try {
                $base64Data = preg_replace('/^data:image\/png;base64,/', '', $this->qrCodeBase64);
                $qrCodeContent = base64_decode($base64Data, true);
            } catch (\Exception $e) {
                Log::error('Failed to decode base64 for CID: ' . $e->getMessage());
            }
        }
        
        // Embed as CID if we have content (embedData must be called on $this, not $message)
        if ($qrCodeContent && strlen($qrCodeContent) > 100) {
            try {
                // embedData() must be called on $this (Mailable instance), not on $message
                $this->qrCodeCid = $this->embedData($qrCodeContent, 'qrcode.png');
                
                Log::info('RegistrationApprovedMail: QR code embedded as CID', [
                    'cid' => $this->qrCodeCid,
                    'content_size' => strlen($qrCodeContent),
                ]);
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Failed to embed QR code as CID', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                $this->qrCodeCid = null;
            }
        }
        
        // CRITICAL: Always try to generate CID from base64 if we don't have content yet
        // This ensures CID is always generated if base64 is available
        if (!$this->qrCodeCid && $this->qrCodeBase64) {
            try {
                $base64Data = preg_replace('/^data:image\/png;base64,/', '', $this->qrCodeBase64);
                $decodedContent = base64_decode($base64Data, true);
                if ($decodedContent && strlen($decodedContent) > 100) {
                    $this->qrCodeCid = $this->embedData($decodedContent, 'qrcode.png');
                    Log::info('RegistrationApprovedMail: Generated CID from base64 in build()', [
                        'cid' => $this->qrCodeCid,
                        'content_size' => strlen($decodedContent),
                    ]);
                } else {
                    Log::warning('RegistrationApprovedMail: Decoded content too small for CID', [
                        'size' => strlen($decodedContent ?? ''),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Failed to generate CID from base64', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
        
        // Final check: if still no CID, log why
        if (!$this->qrCodeCid) {
            Log::warning('RegistrationApprovedMail: CID not generated', [
                'has_content' => !empty($qrCodeContent),
                'content_size' => strlen($qrCodeContent ?? ''),
                'has_base64' => !empty($this->qrCodeBase64),
                'base64_length' => strlen($this->qrCodeBase64 ?? ''),
            ]);
        }
        
        // Ensure variables are always set (even if null/empty)
        // CRITICAL: Make sure base64 is always available and valid
        $qrCodeBase64 = $this->qrCodeBase64 ?? '';
        $qrCodePath = $this->qrCodePath ?? null;
        
        // Final validation: ensure base64 is valid and long enough
        if (!empty($qrCodeBase64)) {
            $isValid = (substr($qrCodeBase64, 0, 22) === 'data:image/png;base64,') && strlen($qrCodeBase64) > 500;
            if (!$isValid) {
                Log::warning('RegistrationApprovedMail: Base64 invalid, clearing it', [
                    'length' => strlen($qrCodeBase64),
                    'preview' => substr($qrCodeBase64, 0, 50),
                ]);
                $qrCodeBase64 = '';
            }
        }
        
        // If base64 is empty but we have registration number, generate it one more time
        if (empty($qrCodeBase64) && $this->registration->registration_number) {
            Log::info('RegistrationApprovedMail: Regenerating base64 as final attempt');
            try {
                $qrCodeBase64 = BarcodeService::generateBarcodeBase64($this->registration->registration_number);
                if (empty($qrCodeBase64) || strlen($qrCodeBase64) < 500) {
                    $qrCodeBase64 = '';
                }
            } catch (\Exception $e) {
                Log::error('RegistrationApprovedMail: Final base64 generation failed', [
                    'error' => $e->getMessage(),
                ]);
                $qrCodeBase64 = '';
            }
        }
        
        // CRITICAL DEBUG: Log everything before passing to view
        Log::info('RegistrationApprovedMail: Final variables for view', [
            'has_base64' => !empty($qrCodeBase64),
            'base64_length' => strlen($qrCodeBase64),
            'base64_valid' => !empty($qrCodeBase64) && substr($qrCodeBase64, 0, 22) === 'data:image/png;base64,',
            'base64_preview' => substr($qrCodeBase64 ?? '', 0, 100),
            'has_path' => !empty($qrCodePath),
            'path' => $qrCodePath,
            'has_cid' => !empty($this->qrCodeCid),
            'cid_value' => $this->qrCodeCid ?? 'null',
            'cid_length' => strlen($this->qrCodeCid ?? ''),
            'registration_number' => $this->registration->registration_number,
            'registration_id' => $this->registration->id,
        ]);
        
        // CRITICAL: Ensure base64 is not empty before passing
        if (empty($qrCodeBase64) && $this->registration->registration_number) {
            Log::error('RegistrationApprovedMail: CRITICAL - Base64 is empty before passing to view!', [
                'registration_number' => $this->registration->registration_number,
            ]);
        }
        
        // CRITICAL: Ensure CID is passed correctly
        $qrCodeCid = $this->qrCodeCid ?? null;
        
        Log::info('RegistrationApprovedMail: Passing variables to view', [
            'has_base64' => !empty($qrCodeBase64),
            'base64_length' => strlen($qrCodeBase64),
            'has_path' => !empty($qrCodePath),
            'has_cid' => !empty($qrCodeCid),
            'cid_value' => $qrCodeCid ? substr($qrCodeCid, 0, 50) . '...' : 'null',
        ]);
        
        return $message->view('emails.registration_approved')
            ->with([
                'qrCodeBase64' => $qrCodeBase64,
                'qrCodePath' => $qrCodePath,
                'qrCodeCid' => $qrCodeCid,
            ]);
    }
}


