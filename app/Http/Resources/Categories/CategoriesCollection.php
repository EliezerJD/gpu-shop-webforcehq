<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesCollection extends ResourceCollection{

    public $collection = CategoriesResource::class;
    
    public function toArray($request){
        return [
            'data'=>$this->collection
        ];
    }

}
