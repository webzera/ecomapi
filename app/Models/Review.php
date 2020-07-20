<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Review extends Model
{
	protected $guarded = [];
    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
