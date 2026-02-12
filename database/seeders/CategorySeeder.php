<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Produk elektronik seperti HP, Laptop, TV, dll',
                'is_active' => true,
            ],
            [
                'name' => 'Fashion',
                'description' => 'Pakaian, sepatu, tas, dan aksesoris fashion',
                'is_active' => true,
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Produk makanan dan minuman',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'description' => 'Produk kesehatan, vitamin, skincare, makeup',
                'is_active' => true,
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Peralatan dan perlengkapan olahraga',
                'is_active' => true,
            ],
            [
                'name' => 'Buku & Alat Tulis',
                'description' => 'Buku, novel, alat tulis, dan perlengkapan kantor',
                'is_active' => true,
            ],
            [
                'name' => 'Mainan & Hobi',
                'description' => 'Mainan anak, action figure, puzzle, dll',
                'is_active' => true,
            ],
            [
                'name' => 'Rumah Tangga',
                'description' => 'Peralatan rumah tangga dan furniture',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
