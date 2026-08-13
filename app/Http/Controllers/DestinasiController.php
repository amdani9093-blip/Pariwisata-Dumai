<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
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
    $kategoriId = $request->input('kategori');
 
    $destinasiList = Destinasi::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
        ->when($kategoriId, function ($query) use ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        })
        ->with('kategori')
        ->latest()
        ->paginate(4)
        ->appends($request->query());
 
    $kategoriList = Kategori::all();
 
    return view('destinasi', compact('destinasiList', 'keyword', 'kategoriId', 'kategoriList'));
}


    /**
     * Menampilkan detail satu destinasi.
     */
    public function show($id)
    {
    $destinasi = Destinasi::with(['atraksi', 'ulasan.user', 'kategori'])->findOrFail($id);

        return view('destinasi-detail', compact('destinasi'));
    }

    /**
     * Menampilkan form tambah destinasi.
     */
    public function create()
    {
        $kategoriList = Kategori::all();
    return view('destinasi-create', compact('kategoriList'));

    }

    /**
     * Menyimpan destinasi baru ke database.
     *
     * Catatan: field "gambar" di form adalah NAMA FILE (teks), bukan file upload.
     * File gambar aslinya harus sudah ditaruh manual di folder public/images/.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar' => 'required|image|max:15000',
            'jam_buka'    => 'required|date_format:H:i',
            'jam_tutup'   => 'required|date_format:H:i|after:jam_buka',
            'lokasi'      => 'required|string|max:255',
            'harga_tiket' => 'required|integer|min:0',
        
        ]);
$validated['gambar'] = $request->file('gambar')->store('destinasi', 'public');
Destinasi::create($validated);

        return redirect()
            ->route('destinasi')
            ->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit destinasi.
     */
    public function edit($id)
{
    $destinasi = Destinasi::findOrFail($id);
    $kategoriList = Kategori::all();
    return view('destinasi-edit', compact('destinasi', 'kategoriList'));
}


    /**
     * Memperbarui data destinasi yang sudah ada.
     *
     * Catatan: field "gambar" di form adalah NAMA FILE (teks) yang merujuk
     * ke file yang sudah ada di folder public/images/, bukan file upload.
     */
    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'nullable|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar' => 'nullable|image|max:15000',
            'jam_buka'    => 'required|date_format:H:i',
            'jam_tutup'   => 'required|date_format:H:i|after:jam_buka',
            'lokasi'      => 'required|string|max:255',
            'harga_tiket' => 'required|integer|min:0',
        ]);

        $validated = $request->validate([
    'gambar' => 'nullable|image|max:15000',
    // ...rules lain
]);
 
if ($request->hasFile('gambar')) {
    $validated['gambar'] = $request->file('gambar')->store('destinasi', 'public');
} else {
    unset($validated['gambar']);
}
 
$destinasi->update($validated);

        return redirect()
            ->route('destinasi')
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