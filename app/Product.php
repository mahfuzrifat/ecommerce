<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
        'category_id','subcategory_id','brand_id','product_name','slug','product_code','product_color','product_size','qty','new_arrival','best_deals','best_seller','featured_items','buy_price','sell_price','video_link','discount_price','photo_one','photo_two','photo_three','product_details','product_status', 'buyone_getone',
    ];

    public function brand(){
    	return $this->belongsTo('App\Brand');
    }
      public function category(){
    	return $this->belongsTo('App\Category');
    }
     public function subcategory(){
        return $this->belongsTo('App\SubCategory');
    }
    public function scopeActive($query){
    	return $query->where('product_status',1);
    }
}
