@extends('adminlte::page')

@section('title', 'Laporan Penjualan')

@section('content_header')
    <div class="no-print">
        <h1><i class="fas fa-file-alt"></i> Laporan Penjualan</h1>
    </div>
@stop

@section('content')
<style>
    .filter-box {
        background: #fff;
        padding: 15px 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    .report-container {
        background: #fff;
        padding: 30px 40px;
        border: 1px solid #ddd;
    }
    .report-header {
        text-align: center;
        margin-bottom: 25px;
        border-bottom: 3px double #333;
        padding-bottom: 15px;
    }
    .report-header h2 {
        margin: 0 0 5px 0;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .report-header h3 {
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: bold;
    }
    .report-header p {
        margin: 0;
        font-size: 13px;
        color: #555;
    }
    .report-info {
        margin-bottom: 20px;
        font-size: 13px;
    }
    .report-info table td {
        padding: 3px 10px 3px 0;
        border: none;
        vertical-align: top;
    }
    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 0;
    }
    .report-table th, .report-table td {
        border: 1px solid #333;
        padding: 6px 8px;
    }
    .report-table th {
        background: #f0f0f0;
        font-weight: bold;
        text-align: center;
        font-size: 11px;
    }
    .report-table td.number {
        text-align: right;
    }
    .report-table td.center {
        text-align: center;
    }
    .report-table tfoot td {
        font-weight: bold;
        background: #f5f5f5;
    }
    .report-footer {
        margin-top: 40px;
        display: flex;
        justify-content: flex-end;
    }
    .signature-box {
        text-align: center;
        width: 200px;
    }
    .signature-box .date {
        margin-bottom: 70px;
        font-size: 12px;
    }
    .signature-box .name {
        border-top: 1px solid #333;
        padding-top: 5px;
        font-size: 12px;
        font-weight: bold;
    }
    .signature-box .title {
        font-size: 11px;
        color: #555;
    }
    @media print {
        body { -webkit-print-color-adjust: exact; }
        .no-print, .filter-box, .content-header, .main-sidebar, .main-header, .main-footer {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }
        .content { padding: 0 !important; }
        .report-container {
            border: none;
            padding: 0;
            box-shadow: none;
        }
        .report-table th { background: #e0e0e0 !important; }
    }
</style>

<div class="container-fluid">
    <!-- Filter -->
    <div class="filter-box no-print">
        <form method="GET" action="{{ route('laporan.penjualan') }}" class="row align-items-end g-2">
            <div class="col-md-3">
                <label class="form-label small mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control form-control-sm" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small mb-1">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control form-control-sm" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small mb-1">Barang</label>
                <select name="barang_id" class="form-control form-control-sm">
                    <option value="">-- Semua Barang --</option>
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}" {{ request('barang_id') == $b->id ? 'selected' : '' }}>{{ $b->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filter</button>
                <a href="{{ route('laporan.penjualan') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i> Reset</a>
                <button type="button" onclick="window.print()" class="btn btn-dark btn-sm"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>

    <!-- Report -->
    <div class="report-container">
        <div class="report-header">
            <h2>Toko Serba Ada</h2>
            <h3>Laporan Rekapitulasi Penjualan</h3>
            <p>
                @if(request('tanggal_mulai') && request('tanggal_akhir'))
                    Periode: {{ date('d/m/Y', strtotime(request('tanggal_mulai'))) }} s/d {{ date('d/m/Y', strtotime(request('tanggal_akhir'))) }}
                @elseif(request('tanggal_mulai'))
                    Mulai Tanggal: {{ date('d/m/Y', strtotime(request('tanggal_mulai'))) }}
                @elseif(request('tanggal_akhir'))
                    Sampai Tanggal: {{ date('d/m/Y', strtotime(request('tanggal_akhir'))) }}
                @else
                    Semua Periode
                @endif
            </p>
        </div>

        <div class="report-info">
            <table>
                <tr>
                    <td width="120">Tanggal Cetak</td>
                    <td width="10">:</td>
                    <td>{{ date('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Total Transaksi</td>
                    <td>:</td>
                    <td>{{ number_format(count($penjualan)) }} transaksi</td>
                </tr>
                @if(request('barang_id'))
                    @php $barangFilter = $barang->where('id', request('barang_id'))->first(); @endphp
                    <tr>
                        <td>Filter Barang</td>
                        <td>:</td>
                        <td>{{ $barangFilter->nama_barang ?? '-' }}</td>
                    </tr>
                @endif
            </table>
        </div>

        <table class="report-table">
            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th width="14%">No Transaksi</th>
                    <th width="10%">Tanggal</th>
                    <th width="22%">Pelanggan</th>
                    <th width="15%">Kasir</th>
                    <th width="10%">Status</th>
                    <th width="15%">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan as $index => $item)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $item->no_transaksi ?? '-' }}</td>
                    <td class="center">{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                    <td>{{ $item->nama_pelanggan ?? $item->nama_pembeli ?? '-' }}</td>
                    <td>{{ $item->kasir ?? '-' }}</td>
                    <td class="center">{{ ucfirst($item->status ?? 'pending') }}</td>
                    <td class="number">{{ number_format($item->jumlah_pembelian ?? $item->total ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="center" style="padding: 20px;">Tidak ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
            @if(count($penjualan) > 0)
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: right; font-weight: bold;">TOTAL PENJUALAN</td>
                    <td class="number" style="font-weight: bold;">{{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>

        <div class="report-footer">
            <div class="signature-box">
                <div class="date">.............................., {{ date('d F Y') }}</div>
                <div class="name">( .................................. )</div>
                <div class="title">Petugas</div>
            </div>
        </div>
    </div>
</div>
@stop
