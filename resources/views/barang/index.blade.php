@extends('adminlte::page')

@section('title', 'Daftar Barang')

@section('content_header')
    <h1><i class="fas fa-box-seam"></i> Daftar Barang</h1>
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
    }
    .page-header h3 {
        margin: 0;
        color: #1a1d29;
        font-weight: 700;
        font-size: 1.75rem;
    }
    .card-table {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
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
    .btn-action-group {
        display: flex;
        gap: 6px;
    }
    .btn-sm {
        padding: 6px 14px;
        font-size: 0.875rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background-color: #3b82f6;
        border: none;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
    }
    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
    }
    .btn-info {
        background-color: #0ea5e9;
        border: none;
    }
    .btn-info:hover {
        background-color: #0284c7;
    }
    .btn-warning {
        background-color: #f59e0b;
        border: none;
        color: white;
    }
    .btn-warning:hover {
        background-color: #d97706;
        color: white;
    }
    .btn-danger {
        background-color: #ef4444;
        border: none;
    }
    .btn-danger:hover {
        background-color: #dc2626;
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
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-stock {
        background-color: #dbeafe;
        color: #1e40af;
    }
</style>

<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga Pokok</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td><span class="badge" style="background-color: #e0e7ff; color: #4338ca;">{{ $b->jenis->nama_jenis }}</span></td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->satuan }}</td>
                    <td class="text-end">Rp {{ number_format($b->harga_pokok, 0, ',', '.') }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</strong></td>
                    <td class="text-center"><span class="badge badge-stock">{{ $b->stok }}</span></td>
                    <td>
                        <div class="btn-action-group">
                            <a href="{{ route('barang.show', $b->id) }}"
                               class="btn btn-sm btn-info text-white"
                               title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('barang.edit', $b->id) }}"
                               class="btn btn-sm btn-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('barang.destroy', $b->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <style>
            .pagination {
                display: flex;
                gap: 8px;
                justify-content: center;
                align-items: center;
            }
            .pagination .page-item {
                list-style: none;
            }
            .pagination .page-link {
                padding: 10px 16px;
                border-radius: 8px;
                border: 1px solid #e5e7eb;
                color: #475569;
                font-weight: 500;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 4px;
                background-color: #ffffff;
            }
            .pagination .page-link:hover {
                background-color: #f8fafc;
                border-color: #3b82f6;
                color: #3b82f6;
                transform: translateY(-1px);
                box-shadow: 0 2px 6px rgba(59, 130, 246, 0.2);
            }
            .pagination .page-item.active .page-link {
                background-color: #3b82f6;
                border-color: #3b82f6;
                color: white;
                font-weight: 600;
                box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
            }
            .pagination .page-item.disabled .page-link {
                background-color: #f1f5f9;
                border-color: #e5e7eb;
                color: #cbd5e1;
                cursor: not-allowed;
            }
            .pagination .page-item.disabled .page-link:hover {
                transform: none;
                box-shadow: none;
            }
        </style>
        {{ $barang->links('vendor.pagination.custom') }}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
    <script>
        console.log('Halaman Daftar Barang');
    </script>
@stop
