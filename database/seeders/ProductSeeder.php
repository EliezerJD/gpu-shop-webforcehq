<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $product = new Product();
        $product->name = 'EVGA RTX 3090';
        $product->price = 3000;
        $product->description = 'Tarjeta de video de 32gb';
        $product->category_id = 1;
        $product->slug = 'evga-rtx-3090';
        $product->image = 'images/rtx-3090-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'EVGA RTX 3080';
        $product->price = 2200;
        $product->description = 'Tarjeta de video de 16gb';
        $product->category_id = 1;
        $product->slug = 'evga-rtx-3080';
        $product->image = 'images/rtx-3080-500.jpg';
        $product->save();

    }
}