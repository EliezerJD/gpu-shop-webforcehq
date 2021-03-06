<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(array $array, array $array1)
 */
class ItemCart extends Model{
    use HasFactory;

    protected $table = 'item_carts';
    protected $primaryKey = 'id';

    protected $fillable = ['product_id','cart_id','amount','price','subtotal'];
}
