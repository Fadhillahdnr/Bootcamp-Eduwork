<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $parfum = Category::where('name', 'Parfum')->first();

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'Parfum Kahf Humbling Forest',
            'description' => 'Parfum Kahf hijau dengan aroma hutan yang segar dan tahan lama',
            'price' => 250000,
            'image' => 'products/kahf.jpg'
        ]);

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'Parfum Kahf Revered Oud',
            'description' => 'Aroma oud elegan dan maskulin',
            'price' => 275000,
            'image' => 'products/kahf2.jpg'
        ]);
    }
}
