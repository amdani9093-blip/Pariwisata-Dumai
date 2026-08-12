<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar { width: 220px; background: #0E3B36; color: #fdfdfd; padding: 1.5rem 1rem; flex-shrink: 0; }
        .sidebar a { color: #ffffff; text-decoration: none; display: block; padding: 0.6rem 0.8rem;
                     border-radius: 6px; margin-bottom: 0.3rem; }
        .sidebar a:hover, .sidebar a.active { background: #fdd348d0; color: #ffffff; font-weight: 600; }
        .main-content { flex: 1; background: #ffffff34; }
        .topbar { background: #00311931; padding: 1rem 1.5rem; border-bottom: 1px solid #004a50;
                  display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h5 class="mb-4">Pariwisata Dumai <small class="d-block">Admin</small></h5>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('destinasi') }}">Kelola Destinasi</a>
        <a href="{{ route('atraksi') }}">Kelola Atraksi</a>
        <a href="{{ route('user') }}">Kelola User</a>
        <hr style="border-color:#00000000;">
        <a href="{{ route('beranda') }}">← Kembali ke Situs</a>
    </div>
    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0">@yield('title')</h5>
            <span>{{ Auth::user()->name }} (Admin)</span>
        </div>
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>
