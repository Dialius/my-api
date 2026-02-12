<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Str;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        Seller::create([
            'uuid' => Str::uuid(),
            'name' => 'Juan',
            'address' => 'Pasar Manis',
            'phone' => '10101010',
            'email' => 'juangntng@gmail.com',
            'store' => 'juan store',
        ]);
    }
}
