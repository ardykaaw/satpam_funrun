<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private $method;
    private $senderNumber;
    private $flowkirimUrl;
    private $flowkirimToken;
    private $fonnteUrl;
    private $fonnteToken;
    private $evolutionUrl;
    private $evolutionToken;
    private $evolutionInstance;

    public function __construct()
    {
        // Konfigurasi dari .env
        // Pilihan: 'fonnte', 'flowkirim', 'evolution', 'url_only'
        $this->method = env('WHATSAPP_METHOD', 'url_only');
        $this->senderNumber = env('WHATSAPP_SENDER_NUMBER', '085851295471');
        
        // Fonnte Configuration (GRATIS untuk Development - Recommended)
        // Website: https://fonnte.com/
        // Dokumentasi: https://docs.fonnte.com/
        // GRATIS tanpa batas waktu untuk development
        $this->fonnteUrl = env('FONNTE_URL', 'https://api.fonnte.com/send');
        $this->fonnteToken = env('FONNTE_TOKEN', '');
        
        // FlowKirim Configuration (BENAR-BENAR GRATIS)
        // Website: https://flowkirim.com/
        $this->flowkirimUrl = env('FLOWKIRIM_URL', 'https://api.flowkirim.com/api/v1/send');
        $this->flowkirimToken = env('FLOWKIRIM_TOKEN', '');
        
        // Evolution API Configuration (Self-hosted, Open Source)
        // Setup di: https://github.com/EvolutionAPI/evolution-api
        $this->evolutionUrl = env('EVOLUTION_URL', '');
        $this->evolutionToken = env('EVOLUTION_TOKEN', '');
        $this->evolutionInstance = env('EVOLUTION_INSTANCE', '');
    }

    /**
     * Send WhatsApp message
     * 
     * @param string $phone Phone number (format: 6281234567890)
     * @param string $message Message content
     * @return array ['success' => bool, 'message' => string, 'url' => string]
     */
    public function sendMessage(string $phone, string $message): array
    {
        // Format phone number
        $phone = $this->formatPhone($phone);
        
        // Generate WhatsApp URL (fallback)
        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);
        
        switch ($this->method) {
            case 'fonnte':
                return $this->sendViaFonnte($phone, $message, $whatsappUrl);
                
            case 'flowkirim':
                return $this->sendViaFlowKirim($phone, $message, $whatsappUrl);
                
            case 'evolution':
                return $this->sendViaEvolution($phone, $message, $whatsappUrl);
                
            case 'url_only':
            default:
                // Hanya generate URL, tidak kirim otomatis
                Log::info('WhatsApp URL generated (not sent)', [
                    'phone' => $phone,
                    'sender_number' => $this->senderNumber,
                    'url' => $whatsappUrl
                ]);
                
                return [
                    'success' => false,
                    'message' => 'WhatsApp URL generated. Please send manually from number: ' . $this->senderNumber,
                    'url' => $whatsappUrl,
                    'sender_number' => $this->senderNumber
                ];
        }
    }

    /**
     * Send via Fonnte (GRATIS untuk Development)
     * Website: https://fonnte.com/
     * Dokumentasi: https://docs.fonnte.com/
     */
    private function sendViaFonnte(string $phone, string $message, string $fallbackUrl): array
    {
        if (empty($this->fonnteToken)) {
            Log::warning('Fonnte credentials not configured');
            return [
                'success' => false,
                'message' => 'Fonnte credentials not configured. Daftar gratis di https://fonnte.com/',
                'url' => $fallbackUrl
            ];
        }

        try {
            $url = $this->fonnteUrl;
            
            // Format nomor untuk Fonnte: format 62xxx (international) atau 0xxx
            // Fonnte biasanya menerima format 08xxx atau 628xxx
            $phoneFormatted = $phone;
            if (str_starts_with($phone, '62')) {
                $phoneFormatted = '0' . substr($phone, 2);
            }
            
            $response = Http::withHeaders([
                'Authorization' => $this->fonnteToken,
                'Content-Type' => 'application/json'
            ])->post($url, [
                'target' => $phoneFormatted,  // Format: 081234567890
                'message' => $message
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('WhatsApp message sent via Fonnte', [
                    'phone' => $phone,
                    'sender_number' => $this->senderNumber,
                    'response' => $data
                ]);
                
                return [
                    'success' => true,
                    'message' => 'Pesan WhatsApp berhasil dikirim via Fonnte',
                    'url' => $fallbackUrl,
                    'data' => $data
                ];
            } else {
                Log::error('Fonnte error', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                
                return [
                    'success' => false,
                    'message' => 'Gagal mengirim pesan WhatsApp via Fonnte: ' . $response->body(),
                    'url' => $fallbackUrl
                ];
            }
        } catch (\Exception $e) {
            Log::error('Fonnte exception', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'url' => $fallbackUrl
            ];
        }
    }

    /**
     * Send via FlowKirim (BENAR-BENAR GRATIS)
     * Website: https://flowkirim.com/
     * Dokumentasi: Lihat di dashboard setelah login
     */
    private function sendViaFlowKirim(string $phone, string $message, string $fallbackUrl): array
    {
        if (empty($this->flowkirimToken)) {
            Log::warning('FlowKirim credentials not configured');
            return [
                'success' => false,
                'message' => 'FlowKirim credentials not configured. Daftar gratis di https://flowkirim.com/',
                'url' => $fallbackUrl
            ];
        }

        try {
            $url = $this->flowkirimUrl;
            
            // Format nomor untuk FlowKirim: format 62xxx (international)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->flowkirimToken,
                'Content-Type' => 'application/json'
            ])->post($url, [
                'to' => $phone,  // Format: 6281234567890
                'message' => $message
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('WhatsApp message sent via FlowKirim', [
                    'phone' => $phone,
                    'sender_number' => $this->senderNumber,
                    'response' => $data
                ]);
                
                return [
                    'success' => true,
                    'message' => 'Pesan WhatsApp berhasil dikirim via FlowKirim',
                    'url' => $fallbackUrl,
                    'data' => $data
                ];
            } else {
                Log::error('FlowKirim error', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                
                return [
                    'success' => false,
                    'message' => 'Gagal mengirim pesan WhatsApp via FlowKirim: ' . $response->body(),
                    'url' => $fallbackUrl
                ];
            }
        } catch (\Exception $e) {
            Log::error('FlowKirim exception', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'url' => $fallbackUrl
            ];
        }
    }

    /**
     * Send via Evolution API (Self-hosted, GRATIS - Open Source)
     * GitHub: https://github.com/EvolutionAPI/evolution-api
     * Setup: Bisa deploy gratis di Railway.app atau Render.com
     */
    private function sendViaEvolution(string $phone, string $message, string $fallbackUrl): array
    {
        if (empty($this->evolutionUrl) || empty($this->evolutionToken) || empty($this->evolutionInstance)) {
            Log::warning('Evolution API credentials not configured');
            return [
                'success' => false,
                'message' => 'Evolution API credentials not configured. Setup di: https://github.com/EvolutionAPI/evolution-api',
                'url' => $fallbackUrl
            ];
        }

        try {
            $url = "{$this->evolutionUrl}/message/sendText/{$this->evolutionInstance}";
            
            $response = Http::withHeaders([
                'apikey' => $this->evolutionToken,
                'Content-Type' => 'application/json'
            ])->post($url, [
                'number' => $phone,
                'text' => $message
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('WhatsApp message sent via Evolution API', [
                    'phone' => $phone,
                    'sender_number' => $this->senderNumber,
                    'response' => $data
                ]);
                
                return [
                    'success' => true,
                    'message' => 'Pesan WhatsApp berhasil dikirim via Evolution API',
                    'url' => $fallbackUrl,
                    'data' => $data
                ];
            } else {
                Log::error('Evolution API error', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                
                return [
                    'success' => false,
                    'message' => 'Gagal mengirim pesan WhatsApp via Evolution API',
                    'url' => $fallbackUrl
                ];
            }
        } catch (\Exception $e) {
            Log::error('Evolution API exception', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'url' => $fallbackUrl
            ];
        }
    }

    /**
     * Format phone number to international format
     */
    private function formatPhone(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // If starts with 0, replace with 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // If doesn't start with country code, add 62
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}
