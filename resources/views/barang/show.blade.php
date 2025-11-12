@extends('adminlte::page')

@section('title', 'Detail Barang')

@section('content')
<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Detail Barang</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200">ID Barang</th>
                    <td>{{ $barang->id }}</td>
                </tr>
                <tr>
                    <th>Jenis Barang</th>
                    <td>{{ $barang->jenis->nama_jenis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $barang->nama_barang }}</td>
                </tr>
                <tr>
                    <th>Satuan</th>
                    <td>{{ $barang->satuan }}</td>
                </tr>
                <tr>
                    <th>Harga Pokok</th>
                    <td>Rp {{ number_format($barang->harga_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Harga Jual</th>
                    <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $barang->stok }}</td>
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td>{{ $barang->create_at ? $barang->create_at->format('d-m-Y H:i:s') : '-' }}</td>
                </tr>
                <tr>
                    <th>Diupdate Pada</th>
                    <td>{{ $barang->update_at ? $barang->update_at->format('d-m-Y H:i:s') : '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
            <div>
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
