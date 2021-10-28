<?php

namespace App\Services\Categories;

use App\Http\Resources\Categories\CategoriesCollection;
use App\Http\Resources\Categories\CategoriesResource;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Services\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoriesService implements Service{

    public function getAll(): CategoriesCollection{
        $categories = Category::orderBy('id','ASC')->paginate(25);
        return new CategoriesCollection($categories);
    }

    public function getOne($request): CategoriesCollection{
       // 
    }

    public function store($request): CategoriesCollection{
       // 
    }

    public function update($request, $id): CategoriesCollection{
       // 
    }

    public function destroy($id): CategoriesCollection{
       // 
    }

    
}