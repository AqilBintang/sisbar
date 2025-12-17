<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show WhatsApp setup page
     */
    public function showWhatsAppSetup()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('profile.whatsapp-setup');
    }

    /**
     * Handle WhatsApp setup
     */
    public function setupWhatsApp(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'whatsapp_number' => 'required|string|min:10|max:15|unique:users,whatsapp_number,' . Auth::id(),
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.min' => 'Nomor WhatsApp minimal 10 digit.',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'whatsapp_number.unique' => 'Nomor WhatsApp sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = Auth::user();
            $whatsappNumber = $this->formatWhatsAppNumber($request->whatsapp_number);
            
            $user->update([
                'whatsapp_number' => $whatsappNumber,
                'whatsapp_verified' => false,
                'allow_broadcast' => true,
            ]);

            return redirect('/')->with('success', 'Nomor WhatsApp berhasil ditambahkan! Anda dapat memverifikasinya di halaman profil.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan nomor WhatsApp. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Format WhatsApp number to international format
     */
    private function formatWhatsAppNumber($phoneNumber)
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
}
