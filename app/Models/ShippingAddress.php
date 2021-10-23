<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'shipping_address';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id'];
    protected $fillable = ['address','state', 'country'];
}