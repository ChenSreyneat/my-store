<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@elitepc.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create Store & Owner
        $store = Store::create([
            'name' => 'Elite Hardware Hub',
            'email' => 'contact@hardwarehub.com',
            'phone' => '012 345 678',
            'address' => 'Phnom Penh, Cambodia',
        ]);

        User::create([
            'name' => 'John Owner',
            'email' => 'owner@elitepc.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'store_id' => $store->id,
        ]);

        // 3. Create Categories
        $cats = [
            ['name' => 'Graphics Cards', 'slug' => 'gpu', 'icon' => 'gpu'],
            ['name' => 'Processors', 'slug' => 'cpu', 'icon' => 'cpu'],
            ['name' => 'Motherboards', 'slug' => 'mobo', 'icon' => 'mobo'],
            ['name' => 'Memory (RAM)', 'slug' => 'ram', 'icon' => 'ram'],
            ['name' => 'Storage', 'slug' => 'ssd', 'icon' => 'ssd'],
            ['name' => 'Case & Cooling', 'slug' => 'cooling', 'icon' => 'fan'],
        ];

        foreach ($cats as $c) {
            Category::create([
                'name' => $c['name'],
                'slug' => $c['slug'],
                'description' => 'Premium ' . $c['name'] . ' for enthusiasts.',
            ]);
        }

        // 4. Create Brands
        $brands = ['ASUS', 'MSI', 'Gigabyte', 'NVIDIA', 'AMD', 'Intel', 'Corsair', 'Samsung'];
        foreach ($brands as $b) {
            Brand::create(['name' => $b]);
        }

        // 5. Create Sample Products
        $products = [
            [
                'name' => 'ASUS ROG Strix GeForce RTX 4090',
                'price' => 1999.99,
                'category' => 'gpu',
                'brand' => 'ASUS',
                'image' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=800',
                'featured' => true
            ],
            [
                'name' => 'Intel Core i9-14900K Processor',
                'price' => 589.00,
                'category' => 'cpu',
                'brand' => 'Intel',
                'image' => 'https://images.unsplash.com/photo-1591405351990-4726e331f141?auto=format&fit=crop&q=80&w=800',
                'featured' => true
            ],
            [
                'name' => 'MSI MPG Z790 Carbon WiFi',
                'price' => 349.99,
                'category' => 'mobo',
                'brand' => 'MSI',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=800',
                'featured' => false
            ],
            [
                'name' => 'Corsair Vengeance RGB 64GB DDR5',
                'price' => 219.99,
                'category' => 'ram',
                'brand' => 'Corsair',
                'image' => 'https://images.unsplash.com/photo-1562976540-1502c2145186?auto=format&fit=crop&q=80&w=800',
                'featured' => true
            ],
            [
                'name' => 'Samsung 990 Pro 2TB NVMe SSD',
                'price' => 179.99,
                'category' => 'ssd',
                'brand' => 'Samsung',
                'image' => 'https://images.unsplash.com/photo-1597872200370-419ced261c07?auto=format&fit=crop&q=80&w=800',
                'featured' => true
            ],
            [
                'name' => 'ASUS ROG Ryujin III 360 ARGB',
                'price' => 329.99,
                'category' => 'cooling',
                'brand' => 'ASUS',
                'image' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&q=80&w=800',
                'featured' => true
            ],
        ];

        foreach ($products as $p) {
            $product = Product::create([
                'name' => $p['name'],
                'description' => 'The ' . $p['name'] . ' provides industry-leading performance and reliability for your custom PC build.',
                'price' => $p['price'],
                'stock' => rand(5, 50),
                'image_url' => $p['image'],
                'category_id' => Category::where('slug', $p['category'])->first()->id,
                'brand_id' => Brand::where('name', $p['brand'])->first()->id,
                'store_id' => $store->id,
                'is_featured' => $p['featured'],
                'is_active' => true,
            ]);

            // Create primary image record
            \App\Models\ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $p['image'], // Using image_url to match migration
                'is_primary' => true,
            ]);
        }

        // 6. Payment Infrastructure
        $this->call(PaymentStatusSeeder::class);

        // Create Default Payment Account for Admin
        \App\Models\PaymentAccount::create([
            'user_id' => 1,
            'account_id' => 'elitepc@bakong',
            'account_name' => 'ELITE PC CO., LTD',
            'currency' => 'USD',
            'is_active' => true,
        ]);
    }
}
