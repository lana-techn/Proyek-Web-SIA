# 📊 Database Seeding Guide

Panduan lengkap untuk setup database dengan sample data menggunakan Laravel Seeder.

## 🎯 Tujuan

Seeder ini memudahkan Anda untuk:
- ✅ Setup database lengkap di device baru dengan satu command
- ✅ Mengembalikan database ke state awal dengan data sample
- ✅ Migrasi project ke device/server lain dengan cepat

## 📦 Data yang Ter-seed

### 1. **Jenis Barang** (8 kategori)
```
1. Elektronik (ELK)
2. Pakaian (PKN)
3. Makanan & Minuman (FNB)
4. Peralatan Rumah Tangga (HME)
5. Buku & Alat Tulis (BKS)
6. Olahraga & Outdoor (SPT)
7. Kecantikan & Kesehatan (BTY)
8. Otomotif (OTO)
```

### 2. **Barang** (20 produk)
Produk dari berbagai kategori dengan:
- ID unik (1001-8001)
- Harga pokok & jual
- Stock awal
- Satuan
- Relasi ke jenis_barang

**Contoh:**
- Laptop ASUS ROG (Rp 12jt - 15jt) - Stock: 10
- Samsung Galaxy S23 (Rp 8jt - 10jt) - Stock: 25
- Kemeja Batik Pria (Rp 150k - 250k) - Stock: 50

### 3. **Pelanggan** (5 customer)
Data customer dengan informasi:
- Nama lengkap
- Jenis kelamin (L/P)
- Alamat
- No. HP
- Email

**Contoh:**
```
1. Ahmad Rizki (L) - Jakarta Pusat
2. Siti Nurhaliza (P) - Jakarta Selatan
3. Budi Santoso (L) - Jakarta Barat
4. Dewi Lestari (P) - Jakarta Timur
5. Eko Prasetyo (L) - Jakarta Utara
```

### 4. **Kota** (5 kota)
- Jakarta
- Bandung
- Surabaya
- Yogyakarta
- Malang

### 5. **Pengarang** (5 author)
Author buku Indonesia terkenal:
- Andrea Hirata (Laskar Pelangi)
- Tere Liye (Bumi Series)
- Dee Lestari (Supernova)
- Raditya Dika (Komedi)
- Pidi Baiq (Dilan Series)

### 6. **Buku** (7 buku)
Buku-buku dengan detail:
- Laskar Pelangi - 529 hal, Rp 75k
- Bumi - 440 hal, Rp 95k
- Bulan - 400 hal, Rp 98k
- Perahu Kertas - 456 hal, Rp 85k
- Kambing Jantan - 176 hal, Rp 55k
- Dilan 1990 - 332 hal, Rp 65k
- Dilan 1991 - 344 hal, Rp 68k

## 🚀 Quick Start

### Option 1: Fresh Database + Seed (Recommended for New Device)
```bash
php artisan migrate:fresh --seed
```
Ini akan:
1. Drop semua table
2. Run semua migration
3. Run DataSeeder
4. Database siap dengan sample data

### Option 2: Reset & Seed (Keep Database Name)
```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### Option 3: Seed Only (jika migration sudah berjalan)
```bash
php artisan db:seed --class=DataSeeder
```

### Option 4: Seed dengan UserFactory (Include Default Users)
```bash
php artisan migrate:fresh --seed
```
Ini akan include:
- Default test user: `test@example.com`
- Default admin: `admin@panuntun.com`

## 📝 File-file yang Terlibat

```
database/
├── seeders/
│   ├── DataSeeder.php          ← Main seeder dengan semua data
│   ├── DatabaseSeeder.php      ← Master seeder (memanggil DataSeeder)
│   ├── JenisBarangSeeder.php   ← [Deprecated - included di DataSeeder]
│   ├── BarangSeeder.php        ← [Deprecated - included di DataSeeder]
│   └── PelangganSeeder.php     ← [Deprecated - included di DataSeeder]
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 2025_10_15_011906_create_jenis_barang_table.php
│   ├── 2025_10_22_014648_create_barang_table.php
│   ├── 2025_11_12_012434_create_kota_table.php
│   ├── 2025_11_12_012829_create_pengarang_table.php
│   ├── 2025_11_12_012838_create_buku_table.php
│   ├── 2025_11_12_013257_create_jual_table.php
│   ├── 2025_11_12_013323_create_detail_jual_table.php
│   ├── 2025_11_12_032721_create_pelanggan_table.php
│   ├── 2025_11_12_032819_update_jual_table_add_pelanggan.php
│   └── 2025_11_12_032847_update_detail_jual_add_user_id.php
└── database_backup.json        ← Backup data dalam JSON format
```

## 🔄 Migrasi ke Device Baru

Langkah-langkah untuk setup di device baru:

### 1. Clone Repository
```bash
git clone https://github.com/lana-techn/Proyek-Web-SIA.git
cd Proyek-Web-SIA
```

### 2. Setup Environment
```bash
# Copy .env
cp .env.example .env

# Generate key
php artisan key:generate
```

### 3. Configure Database
Edit `.env`:
```env
DB_DATABASE=proyek_web
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Dependencies
```bash
composer install
npm install
```

### 5. Setup Database
```bash
php artisan migrate:fresh --seed
```

### 6. Run Dev Server
```bash
php artisan serve
```

### 7. Login
- Admin: `admin@panuntun.com`
- Test: `test@example.com`

## 🔧 Troubleshooting

### Error: "Database doesn't exist"
```bash
# Create database manually di phpMyAdmin atau MySQL CLI
mysql -u root -e "CREATE DATABASE proyek_web;"

# Atau update DB_DATABASE di .env
```

### Error: "Table doesn't exist"
```bash
# Run migrations
php artisan migrate

# Atau fresh + seed
php artisan migrate:fresh --seed
```

### Error: "Seeder not found"
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Run seeder
php artisan db:seed --class=DataSeeder
```

### Error: "Unique constraint violation"
```bash
# Gunakan fresh untuk reset semua
php artisan migrate:fresh --seed
```

## 📊 Verifikasi Data

Setelah seeding, verifikasi data dengan:

```bash
php artisan tinker
>>> \App\Models\JenisBarang::count()
8
>>> \App\Models\Barang::count()
20
>>> \App\Models\Pelanggan::count()
5
>>> exit
```

Atau cek via database:
```sql
SELECT COUNT(*) FROM jenis_barang;
SELECT COUNT(*) FROM barang;
SELECT COUNT(*) FROM pelanggan;
```

## 💾 Backup & Restore

### Backup Current Database
```bash
# Export ke JSON (sudah tersimpan di database_backup.json)
php artisan tinker
>>> $tables = ['jenis_barang', 'barang', 'pelanggan', 'kota', 'pengarang', 'buku', 'jual', 'detail_jual'];
>>> $data = [];
>>> foreach ($tables as $table) {
...   $data[$table] = DB::table($table)->get()->toArray();
... }
>>> file_put_contents('database_backup.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
>>> exit
```

### Restore dari DataSeeder
Cukup jalankan:
```bash
php artisan migrate:fresh --seed
```

## 📚 Useful Commands

```bash
# List semua seeders
php artisan list

# Run specific seeder
php artisan db:seed --class=DataSeeder

# Show database info
php artisan tinker
>>> DB::connection()->getDatabaseName()
>>> DB::select('SHOW TABLES')

# Check table structure
>>> DB::getSchemaBuilder()->getColumnListing('barang')

# Count records di semua table
>>> foreach (['jenis_barang', 'barang', 'pelanggan', 'kota', 'pengarang', 'buku'] as $table) echo $table . ": " . DB::table($table)->count() . "\n";
```

## 🎓 Pembelajaran

### DataSeeder Structure

```php
class DataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed parent tables first (no foreign keys)
        DB::table('jenis_barang')->insert([...]);
        DB::table('pelanggan')->insert([...]);
        
        // 2. Seed child tables (with foreign keys)
        DB::table('barang')->insert([...]); // references jenis_barang
        DB::table('buku')->insert([...]);   // references pengarang
    }
}
```

### Tips:
- Always seed parent tables before child tables (foreign keys)
- Use ID sequences for consistency (1001-8001 untuk barang)
- Include timestamps (created_at, updated_at)
- Test dengan `php artisan migrate:fresh --seed`

## 📞 Support

Jika ada masalah:
1. Check `.env` configuration
2. Verify MySQL is running
3. Check error message di console
4. Backup existing database
5. Run `php artisan migrate:fresh --seed`

## 📄 License

MIT License - Proyek Web SIA

---

**Last Updated:** December 10, 2025  
**Seeder Version:** 1.0  
**Tested:** ✅ PHP 8.4.10 + Laravel 12.33.0 + MySQL
