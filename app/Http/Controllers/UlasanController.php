<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Destinasi;
use App\Models\User;
class UlasanController extends Controller
{
    public function create($destinasiId)
{
    $destinasi = Destinasi::findOrFail($destinasiId);
    $userList = User::all();
    return view('ulasan-create', compact('destinasi', 'userList'));
}
 
public function store(Request $request)
{
    $validated = $request->validate([
        'destinasi_id' => 'required|exists:destinasi,id',
        'user_id' => 'required|exists:users,id',
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|min:5',
    ]);
 
    Ulasan::create($validated);
 
    return redirect()->route('destinasi.detail', $validated['destinasi_id'])
        ->with('success', 'Ulasan berhasil ditambahkan!');
}

}
