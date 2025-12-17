<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists
            $user = User::where('google_id', $googleUser->id)
                       ->orWhere('email', $googleUser->email)
                       ->first();

            if ($user) {
                // Update existing user with Google info if needed
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                    'allow_broadcast' => true, // Default allow broadcast
                ]);
            }

            Auth::login($user);

            // Check if user needs to add WhatsApp number
            if (!$user->whatsapp_number) {
                return redirect('/profile/whatsapp-setup')->with('info', 'Silakan tambahkan nomor WhatsApp untuk menerima notifikasi booking.');
            }

            // Redirect to intended page or dashboard
            $intendedUrl = session('url.intended', '/');
            session()->forget('url.intended');
            
            return redirect($intendedUrl)->with('success', 'Berhasil login dengan Google!');

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        return view('auth.modern-login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        return view('auth.modern-login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil logout!');
    }

    // Test login method for development (remove in production)
    public function showTestLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        return view('auth.test-login');
    }

    public function testLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Create or find user
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);

        // Redirect to intended page or home
        $intendedUrl = session('url.intended', '/');
        session()->forget('url.intended');
        
        return redirect($intendedUrl)->with('success', 'Berhasil login untuk testing!');
    }

    /**
     * Handle manual registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'whatsapp_number' => 'required|string|min:10|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.min' => 'Nomor WhatsApp minimal 10 digit.',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'whatsapp_number.unique' => 'Nomor WhatsApp sudah terdaftar.',
        ]);

        try {
            // Format WhatsApp number
            $whatsappNumber = $this->formatWhatsAppNumber($request->whatsapp_number);
            
            // Create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'whatsapp_number' => $whatsappNumber,
                'whatsapp_verified' => false, // Will need verification
                'allow_broadcast' => true, // Default allow broadcast
                'password' => bcrypt($request->password),
                'email_verified_at' => now(), // Auto verify for simplicity
            ]);

            // Auto login after registration
            Auth::login($user);

            return redirect('/')->with('success', 'Registrasi berhasil! Silakan verifikasi nomor WhatsApp Anda untuk menerima notifikasi.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.'])->withInput();
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

    /**
     * Handle manual login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        return back()->withErrors(['error' => 'Email atau password salah. Silakan coba lagi.'])->withInput();
    }
}