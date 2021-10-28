<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Services\Categories\CategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller{

    public function index(CategoriesService $categoriesService){
        return $categoriesService->getAll();
    }
}