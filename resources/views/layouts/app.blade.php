<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Barang')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow-y: auto;
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 280px;
            background-color: #1a1d29;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 80px;
            color: white;
            overflow-y: auto;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: #e0e6ed;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 24px;
            margin: 6px 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .sidebar a i {
            margin-right: 12px;
            font-size: 1.2rem;
        }
        .sidebar a:hover {
            background-color: #2a2d3a;
            color: #ffffff;
            transform: translateX(5px);
        }
        .sidebar a.active {
            background-color: #3b82f6;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .sidebar hr {
            margin: 20px 16px;
            opacity: 0.2;
        }
        .sidebar h6 {
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0 24px;
            opacity: 0.6;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #e5e7eb;
        }
        .navbar-brand {
            color: #1a1d29 !important;
            font-size: 1.4rem;
            font-weight: 700;
        }
        .navbar-brand i {
            color: #3b82f6;
            margin-right: 8px;
        }
        .content-wrapper {
            margin-left: 280px;
            padding: 100px 32px 40px;
            min-height: 100vh;
            overflow-y: auto;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px 0;
            color: #9ca3af;
            font-size: 0.9rem;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-box-seam"></i> Aplikasi Barang
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <h6 class="text-center mb-4 fw-bold">Menu Utama</h6>
        <a href="{{ url('/') }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        
        <hr class="bg-light">
        <h6 class="mt-3 mb-2">Database Query Builder</h6>
        <a href="{{ url('db/bacaDb1') }}">
            <i class="bi bi-table"></i> Tabel Kota
        </a>
        <a href="{{ url('db/selectData') }}">
            <i class="bi bi-list-ul"></i> Data Barang
        </a>
        
        <hr class="bg-light">
        <h6 class="mt-3 mb-2">Katalog Buku</h6>
        <a href="{{ route('buku.index') }}"
           class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Daftar Buku
        </a>
        
        <hr class="bg-light">
        <h6 class="mt-3 mb-2">Penjualan Online</h6>
        <a href="{{ route('penjualan.index') }}"
           class="{{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
            <i class="bi bi-cart"></i> Transaksi Penjualan
        </a>
        <a href="{{ route('penjualan.create') }}"
           class="{{ request()->routeIs('penjualan.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Transaksi Baru
        </a>
        
        <hr class="bg-light">
        <h6 class="mt-3 mb-2">Master Data</h6>
        <a href="{{ route('jenis-barang.index') }}"
           class="{{ request()->routeIs('jenis-barang.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Jenis Barang
        </a>
        <a href="{{ route('barang.index') }}"
           class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Barang
        </a>
        
        <hr class="bg-light">
        <a href="#" onclick="return confirm('Yakin ingin keluar?')">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <footer>
            <p class="mt-4">&copy; {{ date('Y') }} Aplikasi Barang - Laravel 12</p>
        </footer>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
