<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = [
            [
                'kode' => 'C001',
                'nama' => 'Customer A',
                'telp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'C002',
                'nama' => 'Customer B',
                'telp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'C003',
                'nama' => 'Customer C',
                'telp' => '081234567892',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'C004',
                'nama' => 'Customer D',
                'telp' => '081234567893',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Customer::insert($customer);
    }
}
