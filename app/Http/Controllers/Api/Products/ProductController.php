<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller{

    public function index(ProductService $productService): \App\Http\Resources\Products\ProductCollection{
        return $productService->getAll();
    }

    public function store(ProductStoreRequest $request,ProductService $productService): \Illuminate\Http\JsonResponse{
        $validatedData = $request->validated();
        return $productService->store($validatedData);
    }

    public function show(ProductService $productService, $id): \App\Http\Resources\Products\ProductResource{
        return $productService->getOne($id);
    }

    public function update(ProductUpdate $request,ProductService $productService,$id): \Illuminate\Http\JsonResponse{
        $validatedData  = $request->validated();
        return $productService->update($validatedData,$id);
    }

    public function destroy(ProductService $productService,$id): \Illuminate\Http\JsonResponse{
        return $productService->destroy($id);
    }

}