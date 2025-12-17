<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Booking;

class MidtransService
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
        
        // Log configuration for debugging (without exposing sensitive data)
        \Log::info('Midtrans Configuration:', [
            'is_production' => Config::$isProduction,
            'is_sanitized' => Config::$isSanitized,
            'is_3ds' => Config::$is3ds,
            'server_key_set' => !empty(Config::$serverKey),
            'client_key_set' => !empty(config('midtrans.client_key'))
        ]);
    }

    /**
     * Create Snap Token for payment
     */
    public function createSnapToken(Booking $booking)
    {
        // Validate booking data
        if (!$booking->service || !$booking->barber) {
            throw new \Exception('Booking data tidak lengkap. Service atau Barber tidak ditemukan.');
        }

        if ($booking->total_price <= 0) {
            throw new \Exception('Total harga tidak valid.');
        }

        $orderId = 'BOOKING-' . $booking->id . '-' . time();
        
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->customer_name,
                'email' => $booking->customer_email ?: 'noemail@sisbar.com',
                'phone' => $booking->customer_phone,
            ],
            'item_details' => [
                [
                    'id' => 'service-' . $booking->service_id,
                    'price' => (int) $booking->total_price,
                    'quantity' => 1,
                    'name' => $booking->service->name,
                    'category' => 'Barbershop Service',
                ]
            ],
            'callbacks' => [
                'finish' => url('/payment/finish'),
                'unfinish' => url('/payment/unfinish'),
                'error' => url('/payment/error'),
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'),
                'unit' => 'minutes',
                'duration' => 60
            ],
            'custom_field1' => 'booking_id:' . $booking->id,
            'custom_field2' => 'barber:' . $booking->barber->name,
            'custom_field3' => 'service:' . $booking->service->name,
        ];

        try {
            \Log::info('Creating Midtrans Snap Token for Order ID: ' . $orderId, [
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'customer' => $booking->customer_name
            ]);

            $snapToken = Snap::getSnapToken($params);
            
            \Log::info('Midtrans Snap Token created successfully for Order ID: ' . $orderId);
            
            return $snapToken;
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Token Error for Order ID: ' . $orderId, [
                'error' => $e->getMessage(),
                'booking_id' => $booking->id,
                'params' => $params
            ]);
            throw new \Exception('Gagal membuat token pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Get transaction status from Midtrans
     */
    public function getTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return $status;
        } catch (\Exception $e) {
            \Log::error('Midtrans Transaction Status Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Process webhook notification from Midtrans
     */
    public function handleNotification($notification)
    {
        try {
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;
            $paymentType = $notification->payment_type;

            // Extract booking ID from order ID
            $bookingId = $this->extractBookingIdFromOrderId($orderId);
            
            if (!$bookingId) {
                \Log::error('Invalid order ID format: ' . $orderId);
                return false;
            }

            $booking = Booking::find($bookingId);
            if (!$booking) {
                \Log::error('Booking not found for ID: ' . $bookingId);
                return false;
            }

            // Update booking based on transaction status
            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        if ($fraudStatus == 'challenge') {
                            $booking->update([
                                'payment_status' => 'challenge',
                                'midtrans_order_id' => $orderId,
                                'midtrans_transaction_id' => $notification->transaction_id ?? null,
                            ]);
                        } else {
                            $booking->update([
                                'payment_status' => 'paid',
                                'midtrans_order_id' => $orderId,
                                'midtrans_transaction_id' => $notification->transaction_id ?? null,
                            ]);
                        }
                    }
                    break;

                case 'settlement':
                    $booking->update([
                        'payment_status' => 'paid',
                        'midtrans_order_id' => $orderId,
                        'midtrans_transaction_id' => $notification->transaction_id ?? null,
                    ]);
                    break;

                case 'pending':
                    $booking->update([
                        'payment_status' => 'pending',
                        'midtrans_order_id' => $orderId,
                        'midtrans_transaction_id' => $notification->transaction_id ?? null,
                    ]);
                    break;

                case 'deny':
                case 'expire':
                case 'cancel':
                    $booking->update([
                        'payment_status' => 'failed',
                        'midtrans_order_id' => $orderId,
                        'midtrans_transaction_id' => $notification->transaction_id ?? null,
                    ]);
                    break;

                default:
                    \Log::warning('Unknown transaction status: ' . $transactionStatus);
                    break;
            }

            \Log::info('Midtrans notification processed for booking ID: ' . $bookingId . ', status: ' . $transactionStatus);
            return true;

        } catch (\Exception $e) {
            \Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Extract booking ID from Midtrans order ID
     */
    private function extractBookingIdFromOrderId($orderId)
    {
        // Order ID format: BOOKING-{booking_id}-{timestamp}
        if (preg_match('/^BOOKING-(\d+)-\d+$/', $orderId, $matches)) {
            return (int) $matches[1];
        }
        return null;
    }
}