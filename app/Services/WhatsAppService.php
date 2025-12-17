<?php

namespace App\Services;

use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->from = config('services.twilio.whatsapp_from');
    }

    /**
     * Send WhatsApp message
     */
    public function sendMessage(string $to, string $message): array
    {
        try {
            // Format nomor WhatsApp (pastikan dimulai dengan +)
            $to = $this->formatPhoneNumber($to);
            
            $message = $this->client->messages->create(
                "whatsapp:$to",
                [
                    'from' => "whatsapp:$this->from",
                    'body' => $message
                ]
            );

            Log::info("WhatsApp message sent successfully", [
                'to' => $to,
                'sid' => $message->sid
            ]);

            return [
                'success' => true,
                'message_sid' => $message->sid,
                'status' => $message->status
            ];

        } catch (Exception $e) {
            Log::error("Failed to send WhatsApp message", [
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
     * Send template message (untuk promo, notifikasi, dll)
     */
    public function sendTemplateMessage(string $to, string $templateName, array $variables = []): array
    {
        try {
            $to = $this->formatPhoneNumber($to);
            
            $message = $this->client->messages->create(
                "whatsapp:$to",
                [
                    'from' => "whatsapp:$this->from",
                    'contentSid' => $templateName,
                    'contentVariables' => json_encode($variables)
                ]
            );

            return [
                'success' => true,
                'message_sid' => $message->sid,
                'status' => $message->status
            ];

        } catch (Exception $e) {
            Log::error("Failed to send WhatsApp template message", [
                'to' => $to,
                'template' => $templateName,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Verify WhatsApp number
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
                // Store verification code in session or cache
                session(['whatsapp_verification_code' => $verificationCode]);
                session(['whatsapp_verification_number' => $phoneNumber]);
                return true;
            }
            
            return false;
        } catch (Exception $e) {
            Log::error("Failed to verify WhatsApp number", [
                'number' => $phoneNumber,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Format phone number to international format
     */
    private function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove all non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // If starts with 0, replace with +62
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '+62' . substr($phoneNumber, 1);
        }
        // If starts with 62, add +
        elseif (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = '+' . $phoneNumber;
        }
        // If doesn't start with +, assume Indonesian number
        elseif (substr($phoneNumber, 0, 1) !== '+') {
            $phoneNumber = '+62' . $phoneNumber;
        }
        
        return $phoneNumber;
    }

    /**
     * Get message templates for different types
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