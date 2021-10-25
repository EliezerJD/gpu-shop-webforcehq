
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model{
	use HasFactory;

	protected $table = 'products';
  protected $primaryKey = 'id';
  protected $fillable = ['name','price','description','category_id','slug','image', 'status'];
}