<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{

    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = ['cart_id','total','user_id','shipping_address_id'];

    public function shippingAddress_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo(ShippingAddress::class,'shipping_address_id');
    }

    public function cart_id(){
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function user_id(){
        return $this->belongsTo(User::class,'user_id');
    }
}
