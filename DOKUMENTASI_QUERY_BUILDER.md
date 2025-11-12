# Dokumentasi Praktik & Latihan Query Builder Laravel

## 📚 PRAKTIK 1: Database Query Builder

### Fitur yang Telah Dibuat:
1. **DbController** - Controller untuk praktik Query Builder
2. **Tabel Kota** dengan data dummy
3. **Query Builder Methods**:
   - `bacaDb1()` - Membaca semua data kota
   - `bacaDb2()` - Membaca satu baris data (Bantul)
   - `aggregate()` - Fungsi aggregate (max, min, avg, sum)
   - `selectData()` - Berbagai contoh SELECT query
   - `insertData()` - Insert data barang
   - `updateData()` - Update data barang
   - `deleteData()` - Delete data barang

### URL untuk Testing:
- http://localhost:8000/db/bacaDb1
- http://localhost:8000/db/bacaDb2
- http://localhost:8000/db/aggregate
- http://localhost:8000/db/selectData
- http://localhost:8000/db/insertData
- http://localhost:8000/db/updateData
- http://localhost:8000/db/deleteData

---

## 📖 LATIHAN 1: Sistem Katalog Buku

### Struktur Database:

#### Tabel `pengarang`:
- id (PK)
- nama_pengarang
- bio
- negara
- timestamps

#### Tabel `buku`:
- id (PK)
- judul
- pengarang_id (FK → pengarang.id)
- isbn (unique)
- tahun_terbit
- jumlah_halaman
- penerbit
- harga
- stok
- timestamps

### Fitur CRUD dengan Query Builder:
✅ **Create** - Tambah buku baru (insert)
✅ **Read** - Tampilkan daftar buku dengan JOIN ke pengarang
✅ **Update** - Edit data buku
✅ **Delete** - Hapus data buku

### BukuController Methods:
```php
- index()    → Menampilkan daftar buku dengan JOIN pengarang
- create()   → Form tambah buku
- store()    → Simpan buku baru (INSERT)
- edit()     → Form edit buku
- update()   → Update data buku (UPDATE)
- destroy()  → Hapus buku (DELETE)
- show()     → Detail buku dengan JOIN pengarang
```

### URL untuk Katalog Buku:
- http://localhost:8000/buku (Daftar buku)
- http://localhost:8000/buku/create (Tambah buku)
- http://localhost:8000/buku/{id} (Detail buku)
- http://localhost:8000/buku/{id}/edit (Edit buku)

### Data Dummy:
- 5 Pengarang Indonesia terkenal
- 8 Buku populer dengan relasi ke pengarang

---

## 🛒 TUGAS: Sistem Penjualan Online

### Struktur Database:

#### Tabel `jual`:
- id (PK)
- no_transaksi (unique)
- tanggal
- nama_pembeli
- alamat
- telepon
- total
- status (pending/proses/selesai/batal)
- timestamps

#### Tabel `detail_jual`:
- id (PK)
- jual_id (FK → jual.id)
- barang_id (FK → barang.id)
- jumlah
- harga
- subtotal
- timestamps

### Fitur Utama:
✅ **Transaksi Penjualan** dengan multiple items
✅ **Pengurangan Stok Otomatis** saat barang dijual
✅ **Validasi Stok** - cek stok sebelum transaksi
✅ **Transaction DB** - Rollback jika ada error
✅ **Generate Nomor Transaksi** otomatis (TRX-YYYYMMDD-0001)

### PenjualanController Methods:
```php
- index()    → Daftar transaksi penjualan
- create()   → Form transaksi baru (multi item)
- store()    → Proses transaksi + kurangi stok
- show()     → Detail transaksi dengan JOIN barang
```

### Proses Transaksi:
1. **Input Data Pembeli** (nama, alamat, telepon, tanggal)
2. **Pilih Barang** (bisa multiple items)
3. **Input Jumlah** per barang
4. **Validasi Stok** - Cek apakah stok mencukupi
5. **Simpan Transaksi**:
   - Insert ke tabel `jual`
   - Insert detail ke tabel `detail_jual`
   - **Kurangi stok** di tabel `barang` (PENTING!)
   - Update total transaksi
6. **Tampilkan Struk** transaksi

### URL untuk Penjualan:
- http://localhost:8000/penjualan (Daftar transaksi)
- http://localhost:8000/penjualan/create (Transaksi baru)
- http://localhost:8000/penjualan/{id} (Detail transaksi)

### Contoh Kode Pengurangan Stok:
```php
// Di PenjualanController::store()
DB::beginTransaction();
try {
    // 1. Insert transaksi ke tabel jual
    $jualId = DB::table('jual')->insertGetId([...]);
    
    // 2. Loop detail barang
    foreach ($request->barang_id as $index => $barangId) {
        // Cek stok
        $barang = DB::table('barang')->where('id', $barangId)->first();
        if ($barang->stok < $jumlah) {
            throw new Exception("Stok tidak mencukupi!");
        }
        
        // Insert detail
        DB::table('detail_jual')->insert([...]);
        
        // 3. KURANGI STOK (KEY FEATURE!)
        DB::table('barang')
            ->where('id', $barangId)
            ->decrement('stok', $jumlah);
    }
    
    DB::commit();
} catch (Exception $e) {
    DB::rollBack();
}
```

---

## 🚀 Cara Menjalankan Aplikasi:

### 1. Setup Database:
```bash
# Jalankan migration
php artisan migrate

# Jalankan seeder
php artisan db:seed --class=KotaSeeder
php artisan db:seed --class=PengarangSeeder
php artisan db:seed --class=BukuSeeder
php artisan db:seed --class=BarangSeeder
php artisan db:seed --class=JenisBarangSeeder
```

### 2. Jalankan Server:
```bash
php artisan serve
```

### 3. Akses Aplikasi:
```
http://localhost:8000
```

---

## 📊 Fitur Query Builder yang Digunakan:

### 1. SELECT Queries:
```php
// Semua data
DB::table('buku')->get();

// Dengan kondisi WHERE
DB::table('buku')->where('stok', '>', 0)->get();

// Dengan JOIN
DB::table('buku')
    ->join('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
    ->select('buku.*', 'pengarang.nama_pengarang')
    ->get();

// Satu baris
DB::table('kota')->where('nama_kota', 'Bantul')->first();
```

### 2. Aggregate Functions:
```php
DB::table('barang')->max('harga');
DB::table('barang')->min('harga');
DB::table('barang')->avg('harga');
DB::table('barang')->sum('stok');
DB::table('barang')->count();
```

### 3. INSERT:
```php
DB::table('buku')->insert([
    'judul' => 'Laskar Pelangi',
    'pengarang_id' => 1,
    'created_at' => now(),
]);

// Insert dan dapat ID
$id = DB::table('jual')->insertGetId([...]);
```

### 4. UPDATE:
```php
DB::table('buku')
    ->where('id', 1)
    ->update(['stok' => 100]);

// Decrement (kurangi)
DB::table('barang')
    ->where('id', 1)
    ->decrement('stok', 5);
```

### 5. DELETE:
```php
DB::table('buku')->where('id', 1)->delete();
```

### 6. Transaction:
```php
DB::beginTransaction();
try {
    // Query 1
    // Query 2
    DB::commit();
} catch (Exception $e) {
    DB::rollBack();
}
```

---

## ✅ Checklist Tugas:

### Latihan 1 - Katalog Buku:
- ✅ Tabel pengarang dan buku
- ✅ CRUD dengan Query Builder (insert, update, delete)
- ✅ Menampilkan daftar buku + pengarang (JOIN)
- ✅ Form tambah, edit, hapus buku
- ✅ Seeder untuk data dummy

### Tugas - Sistem Penjualan:
- ✅ Tabel jual dan detail_jual
- ✅ Form transaksi penjualan (multi item)
- ✅ **Pengurangan stok otomatis saat barang dijual** ⭐
- ✅ Validasi stok sebelum transaksi
- ✅ Tampilan detail transaksi dengan JOIN
- ✅ Generate nomor transaksi otomatis
- ✅ Database Transaction (rollback on error)

---

## 🎯 Fitur Unggulan:

1. **Pengurangan Stok Otomatis** - Stok berkurang otomatis saat transaksi
2. **Multi-Item Transaction** - Bisa beli banyak barang dalam 1 transaksi
3. **Real-time Validation** - Cek stok tersedia dengan JavaScript
4. **Transaction Safety** - Rollback otomatis jika ada error
5. **JOIN Queries** - Menampilkan data dari multiple tabel
6. **Responsive UI** - Bootstrap 5 dengan design modern

---

## 📝 Catatan Penting:

⚠️ **PENGURANGAN STOK**:
Stok barang akan otomatis berkurang saat transaksi berhasil disimpan. Implementasi menggunakan:
```php
DB::table('barang')
    ->where('id', $barangId)
    ->decrement('stok', $jumlah);
```

⚠️ **VALIDASI STOK**:
Sebelum transaksi, sistem akan cek apakah stok mencukupi:
```php
if ($barang->stok < $jumlah) {
    throw new Exception("Stok tidak mencukupi!");
}
```

⚠️ **DATABASE TRANSACTION**:
Menggunakan DB Transaction untuk memastikan data konsisten. Jika ada error, semua perubahan akan di-rollback.

---

## 🎓 Pembelajaran:

1. **Query Builder** vs Eloquent ORM
2. **JOIN** untuk relasi antar tabel
3. **Transaction** untuk operasi multiple queries
4. **Aggregate Functions** (sum, avg, max, min, count)
5. **Form Validation** dengan Laravel
6. **CRUD Operations** dengan DB Facade
7. **Business Logic** - Pengurangan stok, validasi, dll

---

**Dibuat oleh:** GitHub Copilot
**Tanggal:** 12 November 2025
**Laravel Version:** 11.x
**Database:** MySQL (via XAMPP)
