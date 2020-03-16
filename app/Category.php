<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $fillable = [
        'category_name','c_slug','c_status', 
    ];

    public function subcategories(){
    	return $this->hasMany('App\SubCategory');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

      public function scopeActive($query)
    {
        return $query->where('c_status', 1);
    }
}
