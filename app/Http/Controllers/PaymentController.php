<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Create payment for booking
     */
    public function createPayment(Request $request, $bookingId)
    {
        try {
            $booking = Booking::with(['barber', 'service'])->findOrFail($bookingId);

            // Check if booking is eligible for payment
            if ($booking->payment_method !== 'online') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking ini tidak menggunakan pembayaran online.'
                ], 400);
            }

            if ($booking->payment_status === 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking ini sudah dibayar.'
                ], 400);
            }

            // Create or get existing snap token
            if (!$booking->snap_token) {
                $snapToken = $this->midtransService->createSnapToken($booking);
                $booking->update(['snap_token' => $snapToken]);
            } else {
                $snapToken = $booking->snap_token;
            }

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'client_key' => config('midtrans.client_key'),
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'service_name' => $booking->service->name,
                    'barber_name' => $booking->barber->name,
                    'total_price' => $booking->total_price,
                    'formatted_price' => 'Rp ' . number_format($booking->total_price, 0, ',', '.')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Creation Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pembayaran. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Handle Midtrans webhook notification
     */
    public function handleNotification(Request $request)
    {
        try {
            // Handle both JSON and form data
            $notification = $request->isJson() ? 
                json_decode($request->getContent()) : 
                (object) $request->all();
            
            Log::info('Midtrans Notification Received: ' . json_encode($notification));

            $result = $this->midtransService->handleNotification($notification);

            if ($result) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error'], 400);
            }

        } catch (\Exception $e) {
            Log::error('Webhook Notification Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    /**
     * Payment finish page
     */
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');
        $statusCode = $request->get('status_code');
        $transactionStatus = $request->get('transaction_status');

        // Extract booking ID from order ID
        if (preg_match('/^BOOKING-(\d+)-\d+$/', $orderId, $matches)) {
            $bookingId = (int) $matches[1];
            
            return redirect()->route('booking.receipt', ['booking_id' => $bookingId])
                ->with('payment_status', $transactionStatus);
        }

        return redirect()->route('booking.status')->with('error', 'Pembayaran tidak dapat diverifikasi.');
    }

    /**
     * Payment unfinish page
     */
    public function unfinish(Request $request)
    {
        $orderId = $request->get('order_id');

        if (preg_match('/^BOOKING-(\d+)-\d+$/', $orderId, $matches)) {
            $bookingId = (int) $matches[1];
            
            return redirect()->route('booking.receipt', ['booking_id' => $bookingId])
                ->with('payment_status', 'unfinish');
        }

        return redirect()->route('booking.status')->with('error', 'Pembayaran dibatalkan.');
    }

    /**
     * Payment error page
     */
    public function error(Request $request)
    {
        $orderId = $request->get('order_id');

        if (preg_match('/^BOOKING-(\d+)-\d+$/', $orderId, $matches)) {
            $bookingId = (int) $matches[1];
            
            return redirect()->route('booking.receipt', ['booking_id' => $bookingId])
                ->with('payment_status', 'error');
        }

        return redirect()->route('booking.status')->with('error', 'Terjadi kesalahan dalam pembayaran.');
    }

    /**
     * Check payment status
     */
    public function checkStatus($bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            if (!$booking->midtrans_order_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking ini belum memiliki transaksi pembayaran.'
                ], 400);
            }

            $status = $this->midtransService->getTransactionStatus($booking->midtrans_order_id);

            return response()->json([
                'success' => true,
                'transaction_status' => $status->transaction_status,
                'payment_type' => $status->payment_type ?? null,
                'fraud_status' => $status->fraud_status ?? null,
                'booking_status' => $booking->payment_status
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Status Check Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran.'
            ], 500);
        }
    }
}
