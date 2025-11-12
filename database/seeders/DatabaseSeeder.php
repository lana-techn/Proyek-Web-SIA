<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed Users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin Panuntun',
            'email' => 'admin@panuntun.com',
        ]);

        // Seed Jenis Barang dan Barang
        $this->call([
            JenisBarangSeeder::class,
            BarangSeeder::class,
            PelangganSeeder::class,
        ]);

        // Seed Kota
        DB::table('kota')->insert([
            ['nama_kota' => 'Jakarta', 'propinsi_id' => 1],
            ['nama_kota' => 'Bandung', 'propinsi_id' => 1],
            ['nama_kota' => 'Surabaya', 'propinsi_id' => 2],
            ['nama_kota' => 'Yogyakarta', 'propinsi_id' => 3],
            ['nama_kota' => 'Malang', 'propinsi_id' => 2],
        ]);

        // Seed Pengarang
        DB::table('pengarang')->insert([
            ['nama_pengarang' => 'Andrea Hirata', 'negara' => 'Indonesia', 'bio' => 'Penulis Laskar Pelangi'],
            ['nama_pengarang' => 'Tere Liye', 'negara' => 'Indonesia', 'bio' => 'Penulis Novel Bumi Series'],
            ['nama_pengarang' => 'Dee Lestari', 'negara' => 'Indonesia', 'bio' => 'Penulis Supernova & Perahu Kertas'],
            ['nama_pengarang' => 'Raditya Dika', 'negara' => 'Indonesia', 'bio' => 'Penulis Komedi'],
            ['nama_pengarang' => 'Pidi Baiq', 'negara' => 'Indonesia', 'bio' => 'Penulis Dilan Series'],
        ]);

        // Seed Buku
        DB::table('buku')->insert([
            [
                'judul' => 'Laskar Pelangi',
                'pengarang_id' => 1,
                'isbn' => '978-979-22-2890-5',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 529,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 75000,
                'stok' => 50
            ],
            [
                'judul' => 'Bumi',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-0213-4',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 440,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 95000,
                'stok' => 40
            ],
            [
                'judul' => 'Bulan',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-1681-0',
                'tahun_terbit' => 2015,
                'jumlah_halaman' => 400,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 98000,
                'stok' => 35
            ],
            [
                'judul' => 'Perahu Kertas',
                'pengarang_id' => 3,
                'isbn' => '978-979-22-4721-0',
                'tahun_terbit' => 2009,
                'jumlah_halaman' => 456,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 85000,
                'stok' => 45
            ],
            [
                'judul' => 'Kambing Jantan',
                'pengarang_id' => 4,
                'isbn' => '978-979-1227-63-2',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 176,
                'penerbit' => 'Gagas Media',
                'harga' => 55000,
                'stok' => 60
            ],
            [
                'judul' => 'Dilan 1990',
                'pengarang_id' => 5,
                'isbn' => '978-602-385-009-8',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 332,
                'penerbit' => 'Pastel Books',
                'harga' => 65000,
                'stok' => 70
            ],
            [
                'judul' => 'Dilan 1991',
                'pengarang_id' => 5,
                'isbn' => '978-602-385-033-3',
                'tahun_terbit' => 2015,
                'jumlah_halaman' => 344,
                'penerbit' => 'Pastel Books',
                'harga' => 68000,
                'stok' => 55
            ],
        ]);
    }
}
