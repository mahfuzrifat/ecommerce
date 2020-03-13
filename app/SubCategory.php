<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
     protected $fillable = [
        'sub_category_name','s_slug','s_status','category_id', 
    ];

    public function category(){
    	return $this->belongsTo('App\Category')->withTimestamps();
    }
}
