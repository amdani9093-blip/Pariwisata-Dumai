<?php

namespace App\Http\Controllers;

use App\Models\Atraksi;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AtraksiController extends Controller
{
    // =========================================================
    // MENAMPILKAN DAFTAR ATRAKSI
    // =========================================================
    public function index()
    {
        $atraksiList = Atraksi::with('destinasi')
            ->latest()
            ->get();

        return view('atraksi', compact('atraksiList'));
    }


    // =========================================================
    // MENAMPILKAN FORM TAMBAH ATRAKSI
    // File:
    // resources/views/atraksi-create.blade.php
    // =========================================================
    public function create()
    {
        $destinasiList = Destinasi::all();

        return view('atraksi-create', compact('destinasiList'));
    }


    // =========================================================
    // MENYIMPAN ATRAKSI BARU
    // =========================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|exists:destinasi,id',
            'nama'        => 'required|string|min:4|max:255',
            'deskripsi'   => 'nullable|string',
            'kategori'    => 'required|in:Budaya,Alam,Kuliner',
            'harga'       => 'required|numeric|min:0',

            // Gambar wajib diisi saat tambah
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'destinasi_id.required' => 'Destinasi wajib dipilih.',
            'destinasi_id.exists'   => 'Destinasi tidak ditemukan.',

            'nama.required'         => 'Nama atraksi wajib diisi.',
            'nama.min'              => 'Nama atraksi minimal 4 karakter.',

            'kategori.required'     => 'Kategori wajib dipilih.',
            'kategori.in'           => 'Kategori tidak valid.',

            'harga.required'        => 'Harga wajib diisi.',
            'harga.numeric'         => 'Harga harus berupa angka.',

            'gambar.required'       => 'Gambar atraksi wajib dipilih.',
            'gambar.image'          => 'File yang dipilih harus berupa gambar.',
            'gambar.mimes'          => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max'            => 'Ukuran gambar maksimal 5 MB.',
        ]);


        // =====================================================
        // SIMPAN GAMBAR
        // =====================================================

        $validated['gambar'] = $request->file('gambar')->store('atraksi', 'public');


        // =====================================================
        // SIMPAN DATA KE DATABASE
        // =====================================================

        Atraksi::create($validated);


        return redirect()
            ->route('atraksi')
            ->with('success', 'Atraksi berhasil ditambahkan.');
    }


    // =========================================================
    // MENAMPILKAN FORM EDIT ATRAKSI
    // File:
    // resources/views/atraksi-edit.blade.php
    // =========================================================
    public function edit($id)
    {
        $atraksi = Atraksi::findOrFail($id);

        $destinasiList = Destinasi::all();

        return view(
            'atraksi-edit',
            compact('atraksi', 'destinasiList')
        );
    }


    // =========================================================
    // MEMPERBARUI ATRAKSI
    // =========================================================
    public function update(Request $request, $id)
    {
        $atraksi = Atraksi::findOrFail($id);


        $validated = $request->validate([
            'destinasi_id' => 'required|exists:destinasi,id',
            'nama'        => 'required|string|min:4|max:255',
            'deskripsi'   => 'nullable|string',
            'kategori'    => 'required|in:Budaya,Alam,Kuliner',
            'harga'       => 'required|numeric|min:0',

            // Gambar TIDAK wajib saat edit
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'destinasi_id.required' => 'Destinasi wajib dipilih.',
            'destinasi_id.exists'   => 'Destinasi tidak ditemukan.',

            'nama.required'         => 'Nama atraksi wajib diisi.',
            'nama.min'              => 'Nama atraksi minimal 4 karakter.',

            'kategori.required'    => 'Kategori wajib dipilih.',
            'kategori.in'          => 'Kategori tidak valid.',

            'harga.required'        => 'Harga wajib diisi.',
            'harga.numeric'         => 'Harga harus berupa angka.',

            'gambar.image'          => 'File yang dipilih harus berupa gambar.',
            'gambar.mimes'          => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max'            => 'Ukuran gambar maksimal 5 MB.',
        ]);


        // =====================================================
        // JIKA ADA GAMBAR BARU
        // =====================================================

        if ($request->hasFile('gambar')) {
    $validated['gambar'] = $request->file('gambar')->store('atraksi', 'public');
} else {
    unset($validated['gambar']);
}



        // Update database
        $atraksi->update($validated);


        return redirect()
            ->route('atraksi')
            ->with('success', 'Atraksi berhasil diperbarui.');
    }


    // =========================================================
    // MENGHAPUS ATRAKSI
    // =========================================================
    public function destroy($id)
    {
        $atraksi = Atraksi::findOrFail($id);


        // =====================================================
        // HAPUS GAMBAR DARI STORAGE
        // =====================================================

        if (
            !empty($atraksi->gambar) &&
            Storage::disk('public')->exists(
                'atraksi/' . $atraksi->gambar
            )
        ) {
            Storage::disk('public')->delete(
                'atraksi/' . $atraksi->gambar
            );
        }


        // Hapus data dari database
        $atraksi->delete();


        return redirect()
            ->route('atraksi')
            ->with('success', 'Atraksi berhasil dihapus.');
    }
}