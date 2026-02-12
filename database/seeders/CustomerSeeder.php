<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'gender' => 'male',
                'birth_date' => '1990-05-15',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '081234567891',
                'address' => 'Jl. Sudirman No. 456, Jakarta Selatan',
                'gender' => 'female',
                'birth_date' => '1992-08-20',
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@gmail.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 789, Bandung',
                'gender' => 'male',
                'birth_date' => '1988-03-10',
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'phone' => '081234567893',
                'address' => 'Jl. Ahmad Yani No. 321, Surabaya',
                'gender' => 'female',
                'birth_date' => '1995-11-25',
                'is_active' => true,
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@gmail.com',
                'phone' => '081234567894',
                'address' => 'Jl. Diponegoro No. 654, Yogyakarta',
                'gender' => 'male',
                'birth_date' => '1993-07-18',
                'is_active' => true,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
