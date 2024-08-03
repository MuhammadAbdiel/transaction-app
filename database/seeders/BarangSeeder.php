<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = [
            [
                'kode' => 'A001',
                'nama' => 'Barang A',
                'harga' => 200000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'C025',
                'nama' => 'Barang B',
                'harga' => 350000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'A102',
                'nama' => 'Barang C',
                'harga' => 125000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'A301',
                'nama' => 'Barang D',
                'harga' => 300000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'B221',
                'nama' => 'Barang E',
                'harga' => 300000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Barang::insert($barang);
    }
}
