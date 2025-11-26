<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BarcodeService
{
    /**
     * Generate QR code and save to storage
     * 
     * @param string $data Data to encode in QR code
     * @param string $filename Filename without extension
     * @return string|null Path to saved file or null on failure
     */
    public static function generateBarcode($data, $filename): ?string
    {
        try {
            // Ensure barcodes directory exists
            $directory = 'barcodes';
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Generate QR code
            $path = $directory . '/' . $filename . '.png';
            $fullPath = storage_path('app/public/' . $path);

            QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($data, $fullPath);

            return 'storage/' . $path;
        } catch (\Exception $e) {
            Log::error('Failed to generate barcode: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate QR code as base64 string for inline use
     * 
     * @param string $data Data to encode in QR code
     * @return string Base64 encoded image data URL
     */
    public static function generateBarcodeBase64($data): string
    {
        try {
            $qrCode = QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($data);

            return 'data:image/png;base64,' . base64_encode($qrCode);
        } catch (\Exception $e) {
            Log::error('Failed to generate barcode base64: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Static method for Blade templates with retry logic
     * 
     * @param string $data Data to encode in QR code
     * @param int $maxRetries Maximum number of retries
     * @return string Base64 encoded image data URL
     */
    public static function generateBarcodeBase64Static($data, $maxRetries = 3): string
    {
        $attempt = 0;
        
        while ($attempt < $maxRetries) {
            try {
                $result = self::generateBarcodeBase64($data);
                
                if (!empty($result)) {
                    return $result;
                }
                
                $attempt++;
                
                // Wait a bit before retry (only if not last attempt)
                if ($attempt < $maxRetries) {
                    usleep(100000); // 0.1 second
                }
            } catch (\Exception $e) {
                Log::error('Barcode generation attempt ' . ($attempt + 1) . ' failed: ' . $e->getMessage());
                $attempt++;
                
                if ($attempt < $maxRetries) {
                    usleep(100000);
                }
            }
        }
        
        Log::error('Failed to generate barcode after ' . $maxRetries . ' attempts');
        return '';
    }
}

