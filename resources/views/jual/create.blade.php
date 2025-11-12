@extends('adminlte::page')

@section('title', 'Transaksi Penjualan')

@section('content_header')
    <h1><i class="fas fa-cash-register"></i> Tambah Transaksi Penjualan</h1>
@stop

@section('content')
<style>
    .card-form {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        padding: 24px;
        margin-bottom: 20px;
    }
    .form-table {
        width: 100%;
    }
    .form-table td {
        padding: 12px 8px;
    }
    .form-table td:first-child {
        width: 250px;
        font-weight: 600;
        color: #475569;
    }
    .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 8px 12px;
    }
    .form-control:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .btn-proses {
        background-color: #10b981;
        color: white;
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-proses:hover {
        background-color: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    #section-detail {
        display: none;
    }
    .table-primary {
        background-color: #eff6ff;
    }
    .table-primary th {
        background-color: #dbeafe;
        padding: 12px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, td, th {
        border: 1px solid #e5e7eb;
    }
    th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 12px;
        text-align: left;
    }
    td {
        padding: 10px;
    }
    input[type="text"], input[type="number"] {
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 6px 8px;
    }
    .btn-add {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
    }
    .btn-add:hover {
        background-color: #059669;
    }
    .btn-delete {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }
    .btn-delete:hover {
        background-color: #dc2626;
    }
    .btn-save {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }
    .btn-save:hover {
        background-color: #2563eb;
    }
    #table1 tfoot {
        background-color: #f1f5f9;
        font-weight: 700;
    }
</style>

<div class="container-fluid">
    <!-- Section 1: Form Pelanggan -->
    <div id="section-pelanggan">
        <div class="card-form">
            <table class="form-table">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>
                    <td>Nomor Transaksi</td>
                    <td>
                        <input type="text" class="form-control id" name="id" 
                               value="{{ $jual->id }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>
                        <input type="text" class="form-control tanggal" name="tanggal" 
                               value="{{ $jual->tanggal }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>
                        <input type="text" class="form-control username" name="username" 
                               value="{{ auth()->user()->name }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nomor ID Pelanggan <small>(tekan enter)</small></td>
                    <td>
                        <input type="text" class="form-control pelanggan_id" 
                               name="pelanggan_id" 
                               placeholder="Masukkan ID pelanggan...">
                    </td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>
                        <input type="text" class="form-control" id="nama_pelanggan" 
                               name="nama_pelanggan" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <input type="text" class="form-control" id="alamat" 
                               name="alamat" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>
                        <input type="text" class="form-control" id="telp_hp" 
                               name="telp_hp" readonly>
                    </td>
                </tr>
            </table>
            
            <div class="form-group mt-4">
                <button type="button" class="btn-proses proses">
                    <i class="fas fa-arrow-right"></i> Lanjut ke Detail Pembelian
                </button>
            </div>
        </div>
    </div>

    <!-- Section 2: Form Detail Belanja (Hidden by default) -->
    <div id="section-detail">
        <div class="card-form">
            <h5 class="mb-3"><i class="fas fa-info-circle"></i> Informasi Transaksi</h5>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Kasir:</strong> <span id="info-kasir"></span></div>
                <div class="col-md-4"><strong>Tanggal:</strong> <span id="info-tanggal"></span></div>
                <div class="col-md-4"><strong>No Transaksi:</strong> <span id="info-no"></span></div>
            </div>
        </div>

        <h5 class="mb-3"><i class="fas fa-plus-circle"></i> Tambah Barang</h5>
        <table class="table-primary mb-4">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Harga (Rp)</th>
                    <th>Total (Rp)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" class="barang_id" size="10" name="barang_id" 
                               placeholder="Kode" title="Setelah diisi tekan enter">
                    </td>
                    <td>
                        <input size="35" id="nama_barang" type="text" name="nama_barang" disabled>
                    </td>
                    <td>
                        <input size="5" type="number" id="qty" name="qty" value="0">
                    </td>
                    <td>
                        <input size="10" id="satuan" type="text" name="satuan" disabled>
                    </td>
                    <td>
                        <input size="12" id="harga" type="number" name="harga_sekarang" 
                               style="text-align:right" disabled>
                    </td>
                    <td>
                        <input size="12" id="total" type="number" name="total" 
                               style="text-align:right" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn-add add-row">+</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h5 class="mb-3"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h5>
        <table id="table1" class="mb-3">
            <thead>
                <tr>
                    <th width="5%">Pilih</th>
                    <th width="10%">Kode</th>
                    <th width="35%">Nama Barang</th>
                    <th width="10%">Qty</th>
                    <th width="10%">Satuan</th>
                    <th width="15%">Harga (Rp)</th>
                    <th width="15%">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" style="text-align:right">TOTAL PEMBELIAN :</th>
                    <td style="text-align:right; font-size: 1.1em;">
                        <output id="jtotal" style="text-align:right">0</output>
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-3">
            <button type="button" class="btn-delete delete-row">
                <i class="fas fa-trash"></i> Hapus Item
            </button>
            <button type="button" class="btn-save simpan">
                <i class="fas fa-save"></i> Simpan & Cetak
            </button>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var jTotal = 0;
    
    // Cari pelanggan ketika enter ditekan
    $(".pelanggan_id").keypress(function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13') {
            e.preventDefault();
            $.ajax({
                url: '{{ url("/bacaPelanggan") }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN, 
                    pelanggan_id: $(".pelanggan_id").val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data) {
                        $("#nama_pelanggan").val(data.nama_pelanggan);
                        $("#alamat").val(data.alamat);
                        $("#telp_hp").val(data.telp_hp);
                    } else {
                        alert('Pelanggan tidak ditemukan!');
                        $("#nama_pelanggan").val('');
                        $("#alamat").val('');
                        $("#telp_hp").val('');
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                }
            });
        }
    });
    
    // Proses simpan pelanggan dan tampilkan form detail
    $(".proses").click(function(){
        if(!$(".pelanggan_id").val()) {
            alert('Silakan masukkan ID pelanggan terlebih dahulu!');
            return;
        }
        
        if(!$("#nama_pelanggan").val()) {
            alert('Data pelanggan belum dimuat! Tekan Enter pada ID Pelanggan.');
            return;
        }
        
        $.ajax({
            url: '{{ url("/jual/store") }}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: $(".id").val(),
                pelanggan_id: $(".pelanggan_id").val()
            },
            success: function(response) {
                // Sembunyikan form pelanggan, tampilkan form detail
                $("#section-pelanggan").hide();
                $("#section-detail").show();
                
                // Set info header
                $("#info-kasir").text($(".username").val());
                $("#info-tanggal").text($(".tanggal").val());
                $("#info-no").text($(".id").val());
                
                // Focus ke input kode barang
                $(".barang_id").focus();
            },
            error: function(xhr, status, error) {
                alert('Error menyimpan data!');
            }
        });
    });
    
    // === BAGIAN DETAIL BELANJA ===
    
    // Kode barang ditekan enter
    $(".barang_id").keypress(function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13') {
            e.preventDefault();
            if ($('.barang_id').val() == "") {
                alert("Kode barang tidak boleh kosong");
                return false;
            }
            
            $.ajax({
                url: '{{ url("/bacaBarang") }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: $(".barang_id").val()},
                dataType: 'JSON',
                success: function (data) {
                    console.log('Response:', data); // Debug
                    if(data === null || data === undefined || data.nama_barang === undefined) {
                        alert("Barang Tidak Ada dengan ID: " + $(".barang_id").val());
                        $(".barang_id").val('');
                        $(".barang_id").focus();
                        return false;
                    }
                    $("#nama_barang").val(data.nama_barang);
                    $("#harga").val(data.harga);
                    $("#satuan").val(data.satuan);
                    $("#qty").val(1);
                    $("#total").val(data.harga);
                    $("#qty").focus();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', xhr.responseText); // Debug
                    alert("Error: Barang tidak ditemukan!");
                    $(".barang_id").val('');
                    $(".barang_id").focus();
                }
            });
        }
    });
    
    // Jumlah barang ditekan enter
    $("#qty").keypress(function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13') {
            e.preventDefault();
            var qty = parseInt(e.target.value);
            var harga = parseInt($("#harga").val());
            var total = qty * harga;
            $("#total").val(total);
            $(".add-row").focus();
        }
    });
    
    // Menambahkan ke keranjang belanja
    $(".add-row").click(function() {
        var barang_id = $(".barang_id").val();
        var qty = $("#qty").val();
        var nama_barang = $("#nama_barang").val();
        var satuan = $("#satuan").val();
        var harga = $("#harga").val();
        var total = $("#total").val();
        
        if(!barang_id || !qty || qty <= 0) {
            alert("Lengkapi data barang!");
            return false;
        }
        
        if(!nama_barang) {
            alert("Silakan masukkan kode barang dan tekan Enter terlebih dahulu!");
            return false;
        }
        
        jTotal += parseInt(total);
        
        var html = "<tr><td style='text-align:center'>" +
            "<input type='checkbox' name='record'></td><td>" +
            barang_id + "</td><td>" +
            nama_barang + "</td><td style='text-align:right'>" +
            qty + "</td><td>" +
            satuan + "</td><td style='text-align:right'>" +
            parseInt(harga).toLocaleString('id-ID') + "</td><td style='text-align:right'>" +
            parseInt(total).toLocaleString('id-ID') + "</td></tr>";
        
        $("#table1").find('tbody').append(html);
        $("#jtotal").text(jTotal.toLocaleString('id-ID'));
        
        // Kosongkan isian
        $(".barang_id").val('');
        $(".barang_id").focus();
        $("#nama_barang").val('');
        $("#qty").val(0);
        $("#satuan").val('');
        $("#harga").val(0);
        $("#total").val(0);
    });
    
    // Menghapus jika isian salah
    $(".delete-row").click(function() {
        var jtotal = jTotal;
        var hasChecked = false;
        
        $("table tbody").find('input[name="record"]').each(function() {
            if($(this).is(":checked")) {
                hasChecked = true;
                var currow = $(this).closest('tr');
                var isicol6 = currow.find('td:eq(6)').text().replace(/\./g, '');
                jtotal -= parseInt(isicol6);
                $(this).parents("tr").remove();
            }
        });
        
        if(!hasChecked) {
            alert("Pilih item yang akan dihapus!");
            return false;
        }
        
        jTotal = jtotal;
        $("#jtotal").text(jTotal.toLocaleString('id-ID'));
    });
    
    // Kirim ke server, simpan rekaman
    $(".simpan").click(function() {
        let dataBarang = [];
        var hasData = false;
        
        $("table#table1 tbody tr").each(function() {
            hasData = true;
            var currow = $(this);
            dataBarang.push({
                'barang_id': currow.find('td:eq(1)').text(),
                'qty': currow.find('td:eq(3)').text().replace(/\./g, ''),
                'harga_sekarang': currow.find('td:eq(5)').text().replace(/\./g, ''),
                'jual_id': $(".id").val()
            });
        });
        
        if(!hasData) {
            alert("Keranjang belanja masih kosong!");
            return false;
        }
        
        if(!confirm("Simpan transaksi ini?")) {
            return false;
        }
        
        console.log('Data yang akan dikirim:', {
            idJual: $(".id").val(),
            dataBarang: dataBarang
        });
        
        // Kirim ke server untuk disimpan
        $.ajax({
            url: '{{ url("/jual/simpan") }}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                idJual: $(".id").val(),
                dataBarang: dataBarang
            },
            dataType: 'json'
        })
        .done(function (response) {
            console.log('Response:', response);
            if (response.berhasil) {
                alert('Transaksi berhasil disimpan!');
                window.location.href = response.urlCetak;
            } else {
                alert('Gagal menyimpan transaksi: ' + (response.error || 'Unknown error'));
            }
        })
        .fail(function (xhr, status, error) {
            console.error('Error details:', xhr.responseText);
            var errorMsg = 'Gagal menyimpan transaksi!';
            try {
                var response = JSON.parse(xhr.responseText);
                if(response.error) {
                    errorMsg += '\nDetail: ' + response.error;
                }
            } catch(e) {
                errorMsg += '\nStatus: ' + xhr.status + ' - ' + error;
            }
            alert(errorMsg);
        });
    });
});
</script>
@stop
