<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
{
    return view('login');
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
