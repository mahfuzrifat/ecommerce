<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name','b_slug','b_status','brand_logo',
    ];

    public function products(){
    	return $this->hasMany('App\Product');
    }

    public function scopeActive($query){
    	return $query->where('b_status',1);
    }
}
