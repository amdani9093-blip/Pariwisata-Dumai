<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $userList = User::latest()->get();
        return view('user', compact('userList'));
    }

    public function create()
    {
        return view('user-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('user')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|min:3|max:255',
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user')
            ->with('success', 'User berhasil dihapus!');
    }
}