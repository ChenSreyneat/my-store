<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Desktop', 'Laptop', 'Workstation', 'Handheld', 'Server'];
        foreach ($types as $type) {
            ProductType::updateOrCreate(['name' => $type]);
        }
    }
}
