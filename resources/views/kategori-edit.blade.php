@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('content')

<div class="card" style="max-width:500px;">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori"
                       class="form-control @error('nama_kategori') is-invalid @enderror"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kategori') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
