@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
@stop

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
        height: 100%;
    }
    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .stat-card.blue { border-left: 4px solid #3b82f6; }
    .stat-card.green { border-left: 4px solid #10b981; }
    .stat-card.yellow { border-left: 4px solid #f59e0b; }
    .stat-card.red { border-left: 4px solid #ef4444; }
    .stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1d29;
        margin: 0;
    }
    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        font-weight: 600;
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .stat-icon.blue { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #2563eb; }
    .stat-icon.green { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #059669; }
    .stat-icon.yellow { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #d97706; }
    .stat-icon.red { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #dc2626; }
    
    .quick-action {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        text-decoration: none;
        color: #1a1d29;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s ease;
    }
    .quick-action:hover {
        background: #f8fafc;
        transform: translateX(4px);
        color: #3b82f6;
        text-decoration: none;
    }
    .quick-action i {
        font-size: 1.25rem;
        color: #3b82f6;
    }

    .card-custom {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    .card-custom-header {
        padding: 1rem 1.5rem;
        background-color: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 600;
        color: #1a1d29;
    }
    .card-custom-body {
        padding: 1.5rem;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 2px solid #e5e7eb;
    }
    .table-custom tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }
    .table-custom tbody td {
        padding: 12px 16px;
        color: #334155;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-proses { background-color: #dbeafe; color: #1e40af; }
    .badge-selesai { background-color: #d1fae5; color: #065f46; }
    .badge-batal { background-color: #fee2e2; color: #991b1b; }

    .terlaris-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background-color: #f8fafc;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.2s ease;
    }
    .terlaris-item:hover {
        background-color: #f1f5f9;
    }
    .terlaris-item:last-child {
        margin-bottom: 0;
    }
    .badge-rank {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #3b82f6;
        color: white;
        border-radius: 50%;
        font-weight: 700;
        font-size: 0.8rem;
        margin-right: 12px;
    }
    .badge-sold {
        background-color: #d1fae5;
        color: #065f46;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="container-fluid">
    <!-- Stat Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-box"></i> Total Barang</p>
                        <p class="stat-number">{{ number_format($totalBarang) }}</p>
                    </div>
                    <div class="stat-icon blue">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card green">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-receipt"></i> Total Transaksi</p>
                        <p class="stat-number">{{ number_format($totalTransaksi) }}</p>
                    </div>
                    <div class="stat-icon green">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card yellow">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-wallet"></i> Total Penjualan</p>
                        <p class="stat-number">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                    </div>
                    <div class="stat-icon yellow">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card red">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-exclamation-triangle"></i> Stok Menipis</p>
                        <p class="stat-number">{{ number_format($stokMenipis) }}</p>
                        <small class="text-muted">Perlu restock</small>
                    </div>
                    <div class="stat-icon red">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card-custom">
                <div class="card-custom-header">
                    <i class="fas fa-bolt"></i> Menu Cepat
                </div>
                <div class="card-custom-body">
                    <a href="{{ route('jual.create') }}" class="quick-action mb-3">
                        <i class="fas fa-plus-circle"></i>
                        <span>Transaksi Baru</span>
                    </a>
                    <a href="{{ route('barang.index') }}" class="quick-action mb-3">
                        <i class="fas fa-boxes"></i>
                        <span>Kelola Barang</span>
                    </a>
                    <a href="{{ route('jual.index') }}" class="quick-action mb-3">
                        <i class="fas fa-list"></i>
                        <span>Daftar Transaksi</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="quick-action">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Barang Terlaris -->
        <div class="col-lg-4 mb-4">
            <div class="card-custom">
                <div class="card-custom-header">
                    <i class="fas fa-fire text-warning"></i> Barang Terlaris
                </div>
                <div class="card-custom-body">
                    @if($barangTerlaris->count() > 0 && $barangTerlaris->first()->total_terjual > 0)
                        @foreach($barangTerlaris as $index => $item)
                            @if($item->total_terjual > 0)
                            <div class="terlaris-item">
                                <div class="d-flex align-items-center">
                                    <span class="badge-rank">{{ $index + 1 }}</span>
                                    <span class="fw-medium">{{ $item->nama_barang }}</span>
                                </div>
                                <span class="badge-sold">{{ $item->total_terjual }} terjual</span>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada data penjualan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Transaksi Terbaru -->
        <div class="col-lg-4 mb-4">
            <div class="card-custom">
                <div class="card-custom-header">
                    <i class="fas fa-clock"></i> Transaksi Terbaru
                </div>
                <div class="card-custom-body p-0">
                    @if($transaksiTerbaru->count() > 0)
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksiTerbaru as $trx)
                                    <tr>
                                        <td>
                                            <strong>{{ $trx->no_transaksi }}</strong>
                                            <br><small class="text-muted">{{ date('d/m/Y', strtotime($trx->tanggal)) }}</small>
                                        </td>
                                        <td>
                                            <strong>Rp {{ number_format($trx->jumlah_pembelian ?? 0, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada transaksi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
    <script>
        console.log('Dashboard Admin loaded');
    </script>
@stop
