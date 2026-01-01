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
        $fashion = Category::where('name', 'Fashion')->first();

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

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Baju Casual Pria',
            'description' => 'Baju casual pria dengan kualitas tinggi',
            'price' => 175000,
            'image' => 'products/bajucasual.png'
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Kemeja Pria Formal',
            'description' => 'Kemeja pria formal dengan kualitas tinggi',
            'price' => 200000,
            'image' => 'products/kemejapria.png'
        ]);
    }
}
