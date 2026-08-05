@extends('layouts.app')
@section('body-class', 'page-user-list')
@section('title', 'Daftar User')

@section('content')

    {{-- External Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/user-list.css') }}">

    <div class="container my-5 user-page">

        {{-- ===================== BREADCRUMB ===================== --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    User
                </li>
            </ol>
        </nav>

        {{-- ===================== HEADER ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4 user-page-header">
            <h2>Daftar User</h2>
            <a href="{{ route('user.create') }}" class="btn-add-user">
                <i class="bi bi-plus-lg"></i> Tambah User
            </a>
        </div>

        {{-- ===================== TABEL USER ===================== --}}
        <div class="user-table-wrap">
            <div class="table-responsive">
                <table class="table align-middle user-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userList as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="action-cell">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn-edit-user">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('user.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-user">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="user-empty">
                                    Belum ada user yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection