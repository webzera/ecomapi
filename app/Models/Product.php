<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\User;

class Product extends Model
{
	protected $guarded = [];

    public function reviews(){
    	return $this->hasMany(Review::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
