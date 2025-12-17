<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WhatsAppController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    /**
     * Update user's WhatsApp number
     */
    public function updateWhatsApp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'whatsapp_number' => 'required|string|min:10|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp tidak valid'
            ], 400);
        }

        $user = Auth::user();
        $whatsappNumber = $request->whatsapp_number;

        // Update nomor WhatsApp
        $user->update([
            'whatsapp_number' => $whatsappNumber,
            'whatsapp_verified' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nomor WhatsApp berhasil diperbarui'
        ]);
    }

    /**
     * Send verification code to WhatsApp
     */
    public function sendVerification(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->whatsapp_number) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp belum diatur'
            ], 400);
        }

        $result = $this->whatsappService->verifyNumber($user->whatsapp_number);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kode verifikasi telah dikirim ke WhatsApp Anda'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim kode verifikasi'
            ], 500);
        }
    }

    /**
     * Verify WhatsApp number with code
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => 'required|string|size:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi harus 6 digit'
            ], 400);
        }

        $sessionCode = session('whatsapp_verification_code');
        $sessionNumber = session('whatsapp_verification_number');
        $user = Auth::user();

        if (!$sessionCode || !$sessionNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan. Silakan kirim ulang.'
            ], 400);
        }

        if ($request->verification_code !== $sessionCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi salah'
            ], 400);
        }

        if ($user->whatsapp_number !== $sessionNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp tidak cocok'
            ], 400);
        }

        // Verifikasi berhasil
        $user->update(['whatsapp_verified' => true]);
        
        // Hapus session
        session()->forget(['whatsapp_verification_code', 'whatsapp_verification_number']);

        return response()->json([
            'success' => true,
            'message' => 'Nomor WhatsApp berhasil diverifikasi'
        ]);
    }

    /**
     * Toggle broadcast permission
     */
    public function toggleBroadcast(Request $request)
    {
        $user = Auth::user();
        
        $user->update([
            'allow_broadcast' => !$user->allow_broadcast
        ]);

        return response()->json([
            'success' => true,
            'allow_broadcast' => $user->allow_broadcast,
            'message' => $user->allow_broadcast 
                ? 'Anda akan menerima broadcast WhatsApp' 
                : 'Anda tidak akan menerima broadcast WhatsApp'
        ]);
    }
}
