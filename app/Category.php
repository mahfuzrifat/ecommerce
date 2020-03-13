<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $fillable = [
        'category_name','c_slug','c_status', 
    ];

    public function subcategories(){
    	return $this->hasMany('App\SubCategory')->withTimestamps();
    }
}
