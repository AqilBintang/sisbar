<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class FontteWhatsAppService
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
        $this->baseUrl = 'https://api.fonnte.com';
    }

    /**
     * Send WhatsApp message via Fonnte
     */
    public function sendMessage(string $to, string $message): array
    {
        try {
            // Format nomor untuk Fonnte (tanpa +)
            $to = $this->formatPhoneNumber($to);
            
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->baseUrl . '/send', [
                'target' => $to,
                'message' => $message,
                'countryCode' => '62', // Indonesia
            ]);

            $result = $response->json();

            Log::info("Fonnte WhatsApp message sent", [
                'to' => $to,
                'response' => $result
            ]);

            if ($response->successful() && isset($result['status']) && $result['status']) {
                return [
                    'success' => true,
                    'message_id' => $result['id'] ?? uniqid(),
                    'status' => 'sent'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['reason'] ?? 'Unknown error'
                ];
            }

        } catch (Exception $e) {
            Log::error("Failed to send Fonnte WhatsApp message", [
                'to' => $to,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send template message
     */
    public function sendTemplateMessage(string $to, string $templateName, array $variables = []): array
    {
        // Fonnte doesn't use templates like Twilio, so we'll use regular message
        $templates = $this->getMessageTemplates();
        
        if (!isset($templates[$templateName])) {
            return [
                'success' => false,
                'error' => 'Template not found'
            ];
        }

        $message = $templates[$templateName]['template'];
        
        // Replace variables
        foreach ($variables as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        return $this->sendMessage($to, $message);
    }

    /**
     * Verify WhatsApp number (mock for Fonnte)
     */
    public function verifyNumber(string $phoneNumber): bool
    {
        try {
            $phoneNumber = $this->formatPhoneNumber($phoneNumber);
            
            // Send verification code
            $verificationCode = rand(100000, 999999);
            $message = "Kode verifikasi WhatsApp Anda: $verificationCode\n\nJangan bagikan kode ini kepada siapapun.";
            
            $result = $this->sendMessage($phoneNumber, $message);
            
            if ($result['success']) {
                // Store verification code in session
                session(['whatsapp_verification_code' => $verificationCode]);
                session(['whatsapp_verification_number' => $phoneNumber]);
                return true;
            }
            
            return false;
        } catch (Exception $e) {
            Log::error("Failed to verify WhatsApp number with Fonnte", [
                'number' => $phoneNumber,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Format phone number for Fonnte (remove + and country code handling)
     */
    private function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove all non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // If starts with +62, remove +
        if (substr($phoneNumber, 0, 3) === '+62') {
            $phoneNumber = substr($phoneNumber, 1);
        }
        // If starts with 0, replace with 62
        elseif (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        // If doesn't start with 62, assume Indonesian number
        elseif (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }
        
        return $phoneNumber;
    }

    /**
     * Get message templates
     */
    public function getMessageTemplates(): array
    {
        return [
            'booking_reminder' => [
                'title' => 'Pengingat Booking',
                'template' => "Halo {name}!\n\nIni adalah pengingat untuk booking Anda:\n📅 Tanggal: {date}\n⏰ Waktu: {time}\n💇‍♂️ Barber: {barber}\n💰 Total: Rp {total}\n\nTerima kasih telah memilih layanan kami!"
            ],
            'promo' => [
                'title' => 'Promo Spesial',
                'template' => "🎉 PROMO SPESIAL! 🎉\n\n{promo_title}\n\n{promo_description}\n\nBerlaku hingga: {valid_until}\n\nBooking sekarang juga!"
            ],
            'booking_confirmation' => [
                'title' => 'Konfirmasi Booking',
                'template' => "Booking Anda telah dikonfirmasi!\n\n📅 Tanggal: {date}\n⏰ Waktu: {time}\n💇‍♂️ Barber: {barber}\n💰 Total: Rp {total}\n\nSampai jumpa di barbershop!"
            ],
            'payment_reminder' => [
                'title' => 'Pengingat Pembayaran',
                'template' => "Halo {name}!\n\nBooking Anda menunggu pembayaran:\n📅 {date} - {time}\n💰 Total: Rp {total}\n\nSilakan selesaikan pembayaran untuk mengkonfirmasi booking Anda."
            ]
        ];
    }
}