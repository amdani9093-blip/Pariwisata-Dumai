<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;



class AuthController extends Controller
{
    public function showLoginForm()
{
    return view('login');
}

public function redirectToWhatsApp()
{
    return redirect()->away(
        'https://wa.me/685278776696'
    );
}

public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
 
/**
 * Menangani balasan (callback) dari Google setelah user login.
 */
public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->user();
 
    // Cari user berdasarkan google_id, atau berdasarkan email
    // kalau sebelumnya sudah pernah daftar manual.
    $user = User::where('google_id', $googleUser->getId())
        ->orWhere('email', $googleUser->getEmail())
        ->first();
 
    if (! $user) {
        $user = User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password'  => bcrypt(Str::random(16)),
        ]);
    } else {
        // Kalau user sudah ada tapi belum tersimpan google_id-nya
        if (! $user->google_id) {
            $user->update(['google_id' => $googleUser->getId()]);
        }
    }
 
    Auth::login($user);
 
    return redirect()->route('beranda')
        ->with('success', 'Berhasil login dengan Google.');
}
 

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
 
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('beranda')
            ->with('success', 'Berhasil masuk!');
    }
 
    return back()
        ->withErrors(['email' => 'Email atau password salah.'])
        ->onlyInput('email');
}
 
public function showRegisterForm()
{
    return view('register');
}
 
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);
    $validated['role'] = 'user';
 
    $user = User::create($validated);
    Auth::login($user);
 
    return redirect()->route('beranda')
        ->with('success', 'Akun berhasil dibuat!');
}
 
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
 
    return redirect()->route('beranda')
        ->with('success', 'Berhasil keluar.');
}

}
