<?php

namespace App\Services\Products;

use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductService implements Service{

    public function getAll(): ProductCollection{
        $products = Product::where('status',1)
            ->orderBy('id','DESC')
            ->paginate(25);
        return new ProductCollection($products);
    }

    public function getOne($id): ProductResource{
        $product = Product::where(function ($result) use ($id){
            if($id){
                return $result->where('id', $id);
            }else{
                error_log('Some message here.');
            }
        })->first();

        return new ProductResource($product);
    }

    public function store($request): \Illuminate\Http\JsonResponse{
        $request['slug'] = $this->generateSlug($request['name']);
        $request['image_url'] = url('').'/images/'.$this->uploadImage($request['image']);
        Product::create($request);
        return response()->json('Product saved successfully',Response::HTTP_CREATED);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse{
        $request['slug'] = $this->generateSlug($request['name']);
        $product = Product::where('id',$id)->first();
        $product->update($request);
        return response()->json('Product updated successfully',Response::HTTP_OK);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse{
        $product = Product::where('id',$id)->first();
        $product->update(['status'=>0]);
        return response()->json('Product deleted successfully',Response::HTTP_OK);
    }

    private function uploadImage($image): string{
        $imageUrl = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageUrl);
        return $imageUrl;
    }

    private function generateSlug($name): string{
        $slug = Str::slug($name);
        $newSlug = $slug;
        $next = 2;
        while (Product::IssetSlug($newSlug)){
            $newSlug = $slug . '-' . $next;
            $next++;
        }
        return $newSlug;
    }
}