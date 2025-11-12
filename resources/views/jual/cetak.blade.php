<!DOCTYPE html>
<html>
<head>
    <title>Cetak Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }
        .header p {
            margin: 5px 0;
            color: #7f8c8d;
        }
        .info-section {
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-section td {
            padding: 6px 0;
        }
        .info-section td:first-child {
            width: 150px;
            font-weight: 600;
            color: #495057;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .items-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-radius: 8px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 18px;
        }
        .total-row.grand-total {
            font-weight: 700;
            font-size: 22px;
            color: #2c3e50;
            border-top: 2px solid #27ae60;
            padding-top: 15px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }
        .print-button {
            text-align: center;
            margin: 20px 0;
        }
        .btn-print {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }
        .btn-print:hover {
            background-color: #2980b9;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏪 TOKO SERBA ADA</h1>
        <p>Jl. Raya Perdagangan No. 123, Telp: (021) 1234-5678</p>
        <p>Email: tokoserbaada@email.com</p>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td>No. Transaksi</td>
                <td>: <strong>{{ $id }}</strong></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ date('d F Y', strtotime($tgl)) }}</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>: {{ $pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $pelanggan->alamat }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{ $pelanggan->telp_hp }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ auth()->user()->name }}</td>
            </tr>
        </table>
    </div>

    <h3 style="margin-bottom: 15px; color: #2c3e50;">
        <i>📋</i> Detail Pembelian
    </h3>
    <table class="items-table">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">Kode Barang</th>
                <th width="35%">Nama Barang</th>
                <th class="text-center" width="10%">Qty</th>
                <th width="15%">Satuan</th>
                <th class="text-right" width="20%">Harga (Rp)</th>
                <th class="text-right" width="20%">Subtotal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($djual as $index => $item)
            @php 
                $subtotal = $item->qty * $item->harga_sekarang;
                $grandTotal += $subtotal;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->barang_id }}</td>
                <td>{{ $item->barang->nama_barang }}</td>
                <td class="text-right">{{ number_format($item->qty, 0, ',', '.') }}</td>
                <td>{{ $item->barang->satuan }}</td>
                <td class="text-right">{{ number_format($item->harga_sekarang, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row grand-total">
            <span>TOTAL PEMBAYARAN</span>
            <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>Terima kasih atas kunjungan Anda!</strong></p>
        <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
        <p style="font-style: italic; margin-top: 10px;">Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>

    <div class="print-button">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk</button>
    </div>

    <script>
        // Auto print saat halaman dimuat (opsional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
