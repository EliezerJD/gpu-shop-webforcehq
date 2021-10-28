<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'items'=>$this->getItems(),
            'user'=>$this->user,
            'total'=>$this->total()
        ];
    }
}
