<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Laptop A',
                'price' => 9999.99,
                'category_id' => 1,
                'description' => 'A powerful laptop with 16GB RAM and 512GB SSD.',
                'img' => 'images/products/laptop.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laptop B',
                'price' => 12999.99,
                'category_id' => 1,
                'description' => 'A high-end laptop with 32GB RAM and 1TB SSD.',
                'img' => 'images/products/laptop.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laptop C',
                'price' => 7999.99,
                'category_id' => 1,
                'description' => 'A budget-friendly laptop with 8GB RAM and 256GB SSD.',
                'img' => 'images/products/laptop.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laptop D',
                'price' => 14999.99,
                'category_id' => 1,
                'description' => 'A gaming laptop with 16GB RAM and 1TB SSD, and dedicated GPU.',
                'img' => 'images/products/laptop.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laptop E',
                'price' => 5999.99,
                'category_id' => 1,
                'description' => 'An entry-level laptop with 4GB RAM and 128GB SSD.',
                'img' => 'images/products/laptop.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
