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
        $product->description = 'Tarjeta de video de 32 gb';
        $product->category_id = 1;
        $product->slug = 'evga-rtx-3090';
        $product->image = 'images/rtx-3090-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'EVGA RTX 3080';
        $product->price = 2200;
        $product->description = 'Tarjeta de video de 16 gb';
        $product->category_id = 1;
        $product->slug = 'evga-rtx-3080';
        $product->image = 'images/rtx-3080-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'GYGABYTE GTX 1660S';
        $product->price = 500;
        $product->description = 'Tarjeta de video de 6 gb';
        $product->category_id = 2;
        $product->slug = 'gygabyte-gtx-1660s';
        $product->image = 'images/Gtx-1660S-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'GYGABYTE GTX 1070';
        $product->price = 350;
        $product->description = 'Tarjeta de video de 8 gb';
        $product->category_id = 2;
        $product->slug = 'gygabyte-gtx-1070';
        $product->image = 'images/Gtx-1070-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'NVIDIA Quadro 4000';
        $product->price = 700;
        $product->description = 'Tarjeta de video de 8 gb';
        $product->category_id = 3;
        $product->slug = 'nvidia-quadro-4000';
        $product->image = 'images/quadro-4000-500.jpg';
        $product->save();

        $product = new Product();
        $product->name = 'NVIDIA Quadro 8000';
        $product->price = 1700;
        $product->description = 'Tarjeta de video de 8 gb';
        $product->category_id = 3;
        $product->slug = 'nvidia-quadro-8000';
        $product->image = 'images/quadro-8000-500.png';
        $product->save();

    }
}