<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        Perusahaan::create([
            'nama' => 'FruitsMart',
            'deskripsi' => 'Perusahaan yang menyediakan solusi pengelolaan toko dan transaksi penjualan.',
            'alamat' => 'Jakarta, Indonesia',
            'telepon' => '081234567890',
            'email' => 'info@fruitsmart.test',
        ]);
    }
}