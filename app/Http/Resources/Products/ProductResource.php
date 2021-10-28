<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'price'=>$this->price,
            'description'=>$this->description,
            'category_id'=>$this->category_id,
            'image'=>$this->image,
            'routes'=>[
                'self'=>route('products.show',$this->slug)
            ]
        ];
    }
}
