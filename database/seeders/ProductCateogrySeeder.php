<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductCategory;

class ProductCateogrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electrónicos',
            'Ropa',
            'Calzado',
            'Linea Blanca',
        ];        

        foreach ($categories as $category) {
            ProductCategory::create([
                'name' => $category,
            ]);
        }
    }
}
