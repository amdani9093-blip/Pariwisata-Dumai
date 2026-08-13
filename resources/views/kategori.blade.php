@extends('layouts.app')
@section('title', 'Kelola Kategori')
@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Kategori</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Kategori</h2>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th style="width:60px;">No</th><th>Nama Kategori</th><th style="width:160px;">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($kategoriList as $i => $kategori)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

