<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    /**
     * Menampilkan halaman beranda beserta daftar destinasi terbaru.
     */
    public function beranda()
    {
        $destinasiList = Destinasi::latest()->get();

        return view('beranda', compact('destinasiList'));
    }

    /**
     * Menampilkan daftar semua destinasi (halaman destinasi.blade.php).
     */
    public function index(Request $request)
    {
        $keyword = $request->input('cari');

        $destinasiList = Destinasi::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(2);

        return view('destinasi', compact('destinasiList', 'keyword'));
    }

    /**
     * Menampilkan detail satu destinasi.
     */
    public function show($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return view('destinasi-detail', compact('destinasi'));
    }

    /**
     * Menampilkan form tambah destinasi.
     */
    public function create()
    {
        return view('destinasi-create');
    }

    /**
     * Menyimpan destinasi baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'required|string|max:255',
            'jam_buka'  => 'required',
            'jam_tutup' => 'required',
            'lokasi'    => 'nullable|string|max:255',
        ]);

        Destinasi::create($validated);

        return redirect()
            ->route('destinasi')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit destinasi.
     */
    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return view('destinasi-edit', compact('destinasi'));
    }

    /**
     * Memperbarui data destinasi yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|string|max:255',
            'jam_buka'  => 'required',
            'jam_tutup' => 'required',
            'lokasi'    => 'nullable|string|max:255',
        ]);

        $destinasi->update($validated);

        return redirect()
            ->route('destinasi.detail', $destinasi->id)
            ->with('success', 'Destinasi berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi.
     */
    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $destinasi->delete();

        return redirect()
            ->route('destinasi')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}