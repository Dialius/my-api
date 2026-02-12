<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada category dan seller
        $elektronik = Category::where('name', 'Elektronik')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $makanan = Category::where('name', 'Makanan & Minuman')->first();
        
        $seller = Seller::first();

        if (!$seller) {
            echo "Tidak ada seller! Jalankan SellerSeeder terlebih dahulu.\n";
            return;
        }

        $products = [
            // Elektronik
            [
                'category_id' => $elektronik?->id ?? 1,
                'seller_id' => $seller->id,
                'name' => 'Samsung Galaxy S23',
                'description' => 'Smartphone flagship Samsung dengan layar AMOLED 6.1 inch',
                'price' => 12999000,
                'stock' => 50,
                'weight' => 168,
                'is_active' => true,
            ],
            [
                'category_id' => $elektronik?->id ?? 1,
                'seller_id' => $seller->id,
                'name' => 'Laptop ASUS ROG Strix G15',
                'description' => 'Gaming laptop dengan RTX 3060 dan Ryzen 7',
                'price' => 18500000,
                'stock' => 25,
                'weight' => 2300,
                'is_active' => true,
            ],
            [
                'category_id' => $elektronik?->id ?? 1,
                'seller_id' => $seller->id,
                'name' => 'Sony WH-1000XM5',
                'description' => 'Headphone wireless dengan noise cancelling terbaik',
                'price' => 5499000,
                'stock' => 100,
                'weight' => 250,
                'is_active' => true,
            ],
            
            // Fashion
            [
                'category_id' => $fashion?->id ?? 2,
                'seller_id' => $seller->id,
                'name' => 'Kemeja Batik Pria Premium',
                'description' => 'Kemeja batik motif parang dengan bahan katun halus',
                'price' => 350000,
                'stock' => 75,
                'weight' => 300,
                'is_active' => true,
            ],
            [
                'category_id' => $fashion?->id ?? 2,
                'seller_id' => $seller->id,
                'name' => 'Sepatu Nike Air Max 270',
                'description' => 'Sepatu olahraga dengan teknologi Air Max',
                'price' => 1899000,
                'stock' => 40,
                'weight' => 800,
                'is_active' => true,
            ],
            [
                'category_id' => $fashion?->id ?? 2,
                'seller_id' => $seller->id,
                'name' => 'Tas Ransel Eiger Original',
                'description' => 'Tas ransel outdoor dengan kapasitas 25L',
                'price' => 450000,
                'stock' => 60,
                'weight' => 600,
                'is_active' => true,
            ],
            
            // Makanan & Minuman
            [
                'category_id' => $makanan?->id ?? 3,
                'seller_id' => $seller->id,
                'name' => 'Kopi Arabica Gayo 500gr',
                'description' => 'Kopi arabica premium dari dataran tinggi Gayo',
                'price' => 125000,
                'stock' => 200,
                'weight' => 500,
                'is_active' => true,
            ],
            [
                'category_id' => $makanan?->id ?? 3,
                'seller_id' => $seller->id,
                'name' => 'Madu Hutan Asli 1kg',
                'description' => 'Madu murni dari hutan Indonesia',
                'price' => 250000,
                'stock' => 150,
                'weight' => 1000,
                'is_active' => true,
            ],
            [
                'category_id' => $makanan?->id ?? 3,
                'seller_id' => $seller->id,
                'name' => 'Cokelat Silverqueen 65gr',
                'description' => 'Cokelat premium rasa cashew',
                'price' => 15000,
                'stock' => 500,
                'weight' => 65,
                'is_active' => true,
            ],
            [
                'category_id' => $makanan?->id ?? 3,
                'seller_id' => $seller->id,
                'name' => 'Teh Pucuk Harum 350ml',
                'description' => 'Minuman teh dalam kemasan botol',
                'price' => 5000,
                'stock' => 1000,
                'weight' => 350,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
