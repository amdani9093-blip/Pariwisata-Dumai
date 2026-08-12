<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan admin.
     */
    public function index()
    {
        $admin = Auth::user();

        return view('admin.settings', compact('admin'));
    }

    /**
     * Memperbarui profil admin.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        $admin->save();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Profil admin berhasil diperbarui.');
    }

    /**
     * Memperbarui password admin.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $admin = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Pastikan password lama benar
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $request->current_password,
            $admin->password
        )) {
            return back()
                ->withErrors([
                    'current_password' =>
                        'Password saat ini tidak sesuai.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan password baru
        |--------------------------------------------------------------------------
        */

        $admin->password = Hash::make(
            $request->password
        );

        $admin->save();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Password berhasil diperbarui.');
    }
}