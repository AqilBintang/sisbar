<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class MockWhatsAppService
{
    /**
     * Mock send WhatsApp message for testing
     */
    public function sendMessage(string $to, string $message): array
    {
        // Simulate sending message
        Log::info("MOCK WhatsApp: Sending message to {$to}", [
            'to' => $to,
            'message' => $message,
            'timestamp' => now()
        ]);

        // Simulate success response
        return [
            'success' => true,
            'message_sid' => 'MOCK_' . uniqid(),
            'status' => 'sent'
        ];
    }

    /**
     * Mock send template message
     */
    public function sendTemplateMessage(string $to, string $templateName, array $variables = []): array
    {
        Log::info("MOCK WhatsApp: Sending template message to {$to}", [
            'to' => $to,
            'template' => $templateName,
            'variables' => $variables,
            'timestamp' => now()
        ]);

        return [
            'success' => true,
            'message_sid' => 'MOCK_TEMPLATE_' . uniqid(),
            'status' => 'sent'
        ];
    }

    /**
     * Mock verify number
     */
    public function verifyNumber(string $phoneNumber): bool
    {
        Log::info("MOCK WhatsApp: Verifying number {$phoneNumber}");
        
        // Simulate verification code
        $verificationCode = rand(100000, 999999);
        session(['whatsapp_verification_code' => $verificationCode]);
        session(['whatsapp_verification_number' => $phoneNumber]);
        
        Log::info("MOCK WhatsApp: Verification code for {$phoneNumber}: {$verificationCode}");
        
        return true;
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