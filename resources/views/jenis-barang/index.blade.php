@extends('adminlte::page')

@section('title', 'Data Jenis Barang')

@section('content_header')
    <h1><i class="fas fa-tags"></i> Data Jenis Barang</h1>
@stop

@section('content')
<style>
    .page-header {
        background-color: #ffffff;
        padding: 24px 28px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        border-left: 4px solid #3b82f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .page-header h3 {
        margin: 0;
        color: #1a1d29;
        font-weight: 700;
        font-size: 1.75rem;
    }
    .stats-row {
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border-left: 4px solid;
        border: 1px solid #e5e7eb;
    }
    .stat-card.total { border-left-color: #3b82f6; }
    .stat-card.active { border-left-color: #10b981; }
    .stat-card.inactive { border-left-color: #f59e0b; }
    .stat-number {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1a1d29;
        margin: 0;
    }
    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        margin-top: 4px;
    }
    .card-table {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    .card-table .card-body {
        padding: 24px;
    }
    .table {
        margin-bottom: 0;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 16px;
        border-bottom: 2px solid #e5e7eb;
    }
    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    .table tbody td {
        padding: 16px;
        vertical-align: middle;
        color: #334155;
    }
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .btn-primary {
        background-color: #3b82f6;
        border: none;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
    }
    .search-input {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.15s ease;
    }
    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .action-buttons {
        display: flex;
        gap: 6px;
    }
    .action-buttons form {
        margin: 0;
    }
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.875rem;
        border-radius: 6px;
    }
    .alert {
        border-radius: 10px;
        border: none;
        padding: 16px 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }
    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }
    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }
</style>

<div class="container-fluid">
    <!-- Add Button -->
    <div class="mb-3">
        <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Tambah Data
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Error Alert -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Stats -->
    <div class="row stats-row">
            <div class="col-md-4">
                <div class="stat-card total">
                    <p class="stat-number">{{ $jenisBarang->count() }}</p>
                    <p class="stat-label">Total Jenis Barang</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card active">
                    <p class="stat-number">{{ $jenisBarang->where('aktif', true)->count() }}</p>
                    <p class="stat-label">Status Aktif</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card inactive">
                    <p class="stat-number">{{ $jenisBarang->where('aktif', false)->count() }}</p>
                    <p class="stat-label">Status Non-Aktif</p>
                </div>
            </div>
        </div>
    <!-- Table Card -->
    <div class="card-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Daftar Jenis Barang</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control search-input" placeholder="Cari jenis barang..." style="width: 250px;">
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th>Kode</th>
                                <th>Nama Jenis</th>
                                <th>Deskripsi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                                <th>Direkam tgl</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisBarang as $index => $jb)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <code class="text-primary">{{ $jb->kode_jenis }}</code>
                                    </td>
                                    <td class="fw-medium">{{ $jb->nama_jenis }}</td>
                                    <td class="text-muted small">
                                        {{ Str::limit($jb->deskripsi, 60) }}
                                    </td>
                                    <td>
                                        @if($jb->aktif)
                                            <span class="badge bg-success-subtle text-success">Aktif</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('jenis-barang.edit', $jb->id) }}" 
                                               class="btn btn-warning btn-sm text-white" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('jenis-barang.destroy', $jb->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $jb->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">Belum ada data jenis barang</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="card-footer bg-white border-0">
                <small class="text-muted">
                    Menampilkan {{ $jenisBarang->count() }} data dari total {{ $jenisBarang->count() }}
                </small>
            </div>
    </div>
</div>

<script>
    document.querySelector('.search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return;
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
    <script>
        console.log('Halaman Jenis Barang');
    </script>
@stop
