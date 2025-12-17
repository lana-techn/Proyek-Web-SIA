@extends('adminlte::page')

@section('title', 'Rekap Penjualan Bulanan')

@section('content_header')
    <h1><i class="fas fa-calendar-alt"></i> Rekap Penjualan Per Bulan</h1>
@stop

@section('content')
<style>
    .card-custom {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        padding: 24px;
        margin-bottom: 20px;
    }
    .filter-section {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .filter-section label {
        color: #374151;
        font-weight: 600;
        margin-bottom: 6px;
        font-size: 13px;
    }
    .filter-section .form-control,
    .filter-section .form-select {
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 14px;
    }
    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
    }
    .btn-filter {
        background-color: #4f46e5;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }
    .btn-filter:hover {
        background-color: #4338ca;
        color: white;
    }
    .btn-reset {
        background-color: #ffffff;
        color: #374151;
        padding: 8px 20px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .btn-reset:hover {
        background-color: #f3f4f6;
        color: #374151;
        border-color: #9ca3af;
    }
    .btn-print {
        background-color: #6366f1;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }
    .btn-print:hover {
        background-color: #4f46e5;
        color: white;
    }
    .stat-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stat-card.blue { border-left: 4px solid #3b82f6; }
    .stat-card.green { border-left: 4px solid #10b981; }
    .stat-card.purple { border-left: 4px solid #8b5cf6; }
    .stat-card.orange { border-left: 4px solid #f59e0b; }
    .stat-card h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: #1f2937;
    }
    .stat-card p {
        color: #6b7280;
        margin-bottom: 0;
        font-size: 13px;
    }
    .stat-card i {
        color: #9ca3af;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        background-color: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }
    th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    td {
        padding: 12px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
        color: #4b5563;
    }
    tbody tr {
        transition: background-color 0.15s ease;
    }
    tbody tr:hover {
        background-color: #f9fafb;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }
    .empty-state i {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 24px;
    }
    .month-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
    .month-jan { background: #fee2e2; color: #991b1b; }
    .month-feb { background: #fce7f3; color: #9d174d; }
    .month-mar { background: #ede9fe; color: #5b21b6; }
    .month-apr { background: #dbeafe; color: #1e40af; }
    .month-may { background: #d1fae5; color: #065f46; }
    .month-jun { background: #fef3c7; color: #92400e; }
    .month-jul { background: #ffedd5; color: #9a3412; }
    .month-aug { background: #cffafe; color: #155e75; }
    .month-sep { background: #e0e7ff; color: #3730a3; }
    .month-oct { background: #fae8ff; color: #86198f; }
    .month-nov { background: #f3e8ff; color: #6b21a8; }
    .month-dec { background: #ecfccb; color: #3f6212; }
    .progress-bar-custom {
        background-color: #6366f1;
        height: 20px;
        border-radius: 4px;
        transition: width 0.4s ease;
    }
    .progress-bg {
        background-color: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
        height: 20px;
    }
    @media print {
        .filter-section, .btn-print, .no-print {
            display: none !important;
        }
        .card-custom {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>

<div class="container-fluid">
    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('laporan.rekap-bulanan') }}">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label><i class="fas fa-calendar"></i> Tahun</label>
                    <select name="tahun" class="form-select">
                        @foreach($tahunList as $t)
                            <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                        @if(!$tahunList->contains($tahun))
                            <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label><i class="fas fa-box"></i> Filter Barang</label>
                    <select name="barang_id" class="form-select">
                        <option value="">-- Semua Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}" {{ $barangId == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('laporan.rekap-bulanan') }}" class="btn-reset">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card blue">
                <p><i class="fas fa-calendar"></i> Tahun</p>
                <h3>{{ $tahun }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card green">
                <p><i class="fas fa-money-bill-wave"></i> Total Penjualan</p>
                <h3>Rp {{ number_format($totalTahunan, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card purple">
                <p><i class="fas fa-receipt"></i> Total Transaksi</p>
                <h3>{{ number_format($totalTransaksi) }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card orange">
                <p><i class="fas fa-chart-line"></i> Rata-rata / Bulan</p>
                <h3>Rp {{ count($rekapBulanan) > 0 ? number_format($totalTahunan / count($rekapBulanan), 0, ',', '.') : 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Rekap Penjualan Per Bulan - Tahun {{ $tahun }}</h5>
                <small class="text-muted">
                    @if($barangId)
                        Filter berdasarkan barang terpilih
                    @else
                        Menampilkan semua barang
                    @endif
                </small>
            </div>
            <button onclick="window.print()" class="btn-print no-print">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>

        @if(count($rekapBulanan) > 0)
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Bulan</th>
                        <th width="15%">Jumlah Transaksi</th>
                        <th width="25%">Total Penjualan</th>
                        <th width="35%">Visualisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $maxPenjualan = $rekapBulanan->max('total_penjualan') ?: 1;
                        $monthClasses = [
                            1 => 'month-jan', 2 => 'month-feb', 3 => 'month-mar', 4 => 'month-apr',
                            5 => 'month-may', 6 => 'month-jun', 7 => 'month-jul', 8 => 'month-aug',
                            9 => 'month-sep', 10 => 'month-oct', 11 => 'month-nov', 12 => 'month-dec'
                        ];
                    @endphp
                    @foreach($rekapBulanan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="month-badge {{ $monthClasses[$item->bulan] ?? 'month-jan' }}">
                                {{ $item->nama_bulan }} {{ $item->tahun }}
                            </span>
                        </td>
                        <td>
                            <strong>{{ number_format($item->jumlah_transaksi) }}</strong> transaksi
                        </td>
                        <td>
                            <strong style="color: #059669; font-size: 1.1em;">
                                Rp {{ number_format($item->total_penjualan, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            <div class="progress-bg">
                                <div class="progress-bar-custom" 
                                     style="width: {{ ($item->total_penjualan / $maxPenjualan) * 100 }}%">
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot style="background: #f8fafc; font-weight: bold;">
                    <tr>
                        <td colspan="2" style="text-align: right; padding: 16px;">TOTAL {{ $tahun }}:</td>
                        <td style="padding: 16px;">
                            <strong>{{ number_format($totalTransaksi) }}</strong> transaksi
                        </td>
                        <td style="padding: 16px; color: #059669; font-size: 1.1em;">
                            Rp {{ number_format($totalTahunan, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h5>Tidak Ada Data</h5>
            <p>Tidak ditemukan transaksi penjualan pada tahun {{ $tahun }}</p>
        </div>
        @endif
    </div>

    <!-- Detail per Barang (jika filter barang dipilih) -->
    @if($barangId && $detailBarang->count() > 0)
    <div class="card-custom">
        <h5 class="mb-3"><i class="fas fa-box"></i> Detail Penjualan Barang Per Bulan</h5>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Bulan</th>
                        <th width="30%">Nama Barang</th>
                        <th width="15%">Total Qty</th>
                        <th width="30%">Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailBarang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="month-badge {{ $monthClasses[$item->bulan] ?? 'month-jan' }}">
                                {{ $item->nama_bulan }}
                            </span>
                        </td>
                        <td>{{ $item->nama_barang }}</td>
                        <td><strong>{{ number_format($item->total_qty) }}</strong></td>
                        <td>
                            <strong style="color: #059669;">
                                Rp {{ number_format($item->total_nilai, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot style="background: #f8fafc; font-weight: bold;">
                    <tr>
                        <td colspan="3" style="text-align: right; padding: 16px;">TOTAL:</td>
                        <td style="padding: 16px;">
                            <strong>{{ number_format($detailBarang->sum('total_qty')) }}</strong>
                        </td>
                        <td style="padding: 16px; color: #059669;">
                            Rp {{ number_format($detailBarang->sum('total_nilai'), 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
    <script>
        console.log('Rekap Penjualan Bulanan loaded');
    </script>
@stop
