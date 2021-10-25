<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = new Category();
        $category->name = 'RTX';
        $category->save();

        $category = new Category();
        $category->name = 'GTX';
        $category->save();

        $category = new Category();
        $category->name = 'Quadro';
        $category->save();

    }
}