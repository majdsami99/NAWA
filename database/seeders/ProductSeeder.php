<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            'name' => 'Product Name',
            'price' => 10.99,
            'description' => 'Product Description',
            'slug' => 'aaa',
            'compare_price' => '123',
            'quantity' => '0',
            'status' => 'active',
            'category_id' => '1',
            'created_at' => now(),


        ]);
    }
}
