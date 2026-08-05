<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jam_buka'  => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'lokasi'    => 'nullable|string|max:255',
        ]);

        // simpan file gambar ke storage/app/public/destinasi,
        // simpan hanya nama filenya ke database
        $path = $request->file('gambar')->store('destinasi', 'public');
        $validated['gambar'] = basename($path);

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
            // gambar tidak wajib diisi ulang saat update, hanya kalau mau ganti
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jam_buka'  => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'lokasi'    => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama supaya storage tidak menumpuk file tak terpakai
            if ($destinasi->gambar && Storage::disk('public')->exists('destinasi/' . $destinasi->gambar)) {
                Storage::disk('public')->delete('destinasi/' . $destinasi->gambar);
            }

            $path = $request->file('gambar')->store('destinasi', 'public');
            $validated['gambar'] = basename($path);
        } else {
            // tidak upload gambar baru -> pertahankan gambar lama
            unset($validated['gambar']);
        }

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

        if ($destinasi->gambar && Storage::disk('public')->exists('destinasi/' . $destinasi->gambar)) {
            Storage::disk('public')->delete('destinasi/' . $destinasi->gambar);
        }

        $destinasi->delete();

        return redirect()
            ->route('destinasi')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}