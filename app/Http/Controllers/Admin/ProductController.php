<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Product;
use App\Brand;
use App\Category;
use App\SubCategory;
use DB;
class ProductController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){
        $data = Product::with('category','brand')->get();
    	return view('admin.product.index',compact('data'));
    }
     public function create(){
     	$brand = Brand::active()->get();
     	$cat = Category::active()->get();
    	return view('admin.product.create',compact('cat','brand'));
    }
    public function get($category_id){
        $data = SubCategory::where('category_id',$category_id)->get();
        return json_encode($data);
    }
    public function store(Request $request){
        $request->validate([
           'product_name' => 'required|unique:products|min:3|max:50',  
           'product_code' => 'required|unique:products|min:3|max:50',  
           'category_id' => 'required',  
           'subcategory_id' => 'required',  
           'brand_id' => 'required',  
           'qty' => 'required|integer',  
           'buy_price' => 'required',  
           'sell_price' => 'required',  
           'product_color' => 'required',  
           'product_details' => 'required|min:20|max:5000',  
           'photo_one' => 'required|image',      
       ]);
        $image_one = $request->file('photo_one'); 
        $image_two = $request->file('photo_two'); 
        $image_three = $request->file('photo_three'); 
        $slug = str_slug($request->product_name);
        if(isset($image_one))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_one  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_one->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }

            $postImage_one = Image::make($image_one)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_one,$postImage_one);
        }else{
            $imageName_one = 'default_one.png';
        }

         if(isset($image_two))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_two  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_two->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }

            $postImage_two = Image::make($image_two)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_two,$postImage_two);
        }else{
            $imageName_two = 'default_two.png';
        }

         if(isset($image_three))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_three  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_three->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }

            $postImage_three = Image::make($image_three)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_three,$postImage_three);
        }else{
            $imageName_three = 'default_three.png';
        }

            $data = new Product();
            $data['category_id'] = $request->category_id;
            $data['subcategory_id'] = $request->subcategory_id;
            $data['brand_id'] = $request->brand_id;
            $data['product_name'] = $request->product_name;
            $data['slug'] = $slug;
            $data['product_code'] = $request->product_code;
            $data['product_color'] = $request->product_color;
            $data['product_size'] = $request->product_size;
            $data['qty'] = $request->qty;
            $data['new_arrival'] = $request->new_arrival == null ? '0':'1';
            $data['best_deals'] = $request->best_deals == null ? '0':'1';
            $data['best_seller'] = $request->best_seller == null ? '0':'1';
            $data['featured_items'] = $request->featured_items == null ? '0':'1';
            $data['buyone_getone'] = $request->buyone_getone == null ? '0':'1';
            $data['buy_price'] = $request->buy_price;
            $data['sell_price'] = $request->sell_price;
            $data['video_link'] = $request->video_link;
            $data['discount_price'] = $request->discount_price;
            $data['photo_one'] = $imageName_one;
            $data['photo_two'] = $imageName_two;
            $data['photo_three'] = $imageName_three;
            $data['product_details'] = $request->product_details;
         
        $save = $data->save();
    
      if ($save) {
        $notification=array(
                 'messege'=>'New Product Added Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.product.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         }
}

      public function status($id){
        $info = Product::findOrFail($id)->product_status;  
        if ($info == 1) {
            $cat = Product::find($id);
            $cat->product_status = 0;
            $cat->save(); 
             if ($cat) {
            $notification=array(
                 'messege'=>'Product-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.product.index')->with($notification);
          }
        } else {
            $cat = Product::find($id);
            $cat->product_status = 1;
            $cat->save();  
             if ($cat) {
            $notification=array(
                 'messege'=>'Product-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.product.index')->with($notification);
        }
      }   
    } 
    public function edit($id){
        $cat = Category::all();
        $brand = Brand::all();
        $data = Product::findOrFail($id)->with('category','brand','subcategory')->first(); 
        return view('admin.product.edit',compact('data','cat','brand'));
    }

        public function update(Request $request,$id){
        $request->validate([
           'product_name' => 'required|min:3|max:50',  
           'product_code' => 'required|min:3|max:50',  
           'category_id' => 'required',  
           'subcategory_id' => 'required',  
           'brand_id' => 'required',  
           'qty' => 'required|integer',  
           'buy_price' => 'required',  
           'sell_price' => 'required',  
           'product_color' => 'required',  
           'product_details' => 'required|min:20|max:5000',   
       ]);
        $product = Product::findOrFail($id);
        $image_one = $request->file('photo_one'); 
        $image_two = $request->file('photo_two'); 
        $image_three = $request->file('photo_three'); 
        $slug = str_slug($request->product_name);
        if(isset($image_one))
        {
           // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_one  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_one->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }
            if (Storage::disk('public')->exists('products/'.$product->photo_one)) {
            Storage::disk('public')->delete('products/'.$product->photo_one);
             }

            $postImage_one = Image::make($image_one)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_one,$postImage_one);
        }else{
            $imageName_one = $product->photo_one;
        }

         if(isset($image_two))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_two  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_two->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }

             if (Storage::disk('public')->exists('products/'.$product->photo_two)) {
            Storage::disk('public')->delete('products/'.$product->photo_two);
             }

            $postImage_two = Image::make($image_two)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_two,$postImage_two);
        }else{
            $imageName_two = $product->photo_two;
        }

         if(isset($image_three))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName_three  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image_three->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('products'))
            {
                Storage::disk('public')->makeDirectory('products');
            }

             if (Storage::disk('public')->exists('products/'.$product->photo_three)) {
            Storage::disk('public')->delete('products/'.$product->photo_three);
             }

            $postImage_three = Image::make($image_three)->resize(270,320)->encode();
            Storage::disk('public')->put('products/'.$imageName_three,$postImage_three);
        }else{
            $imageName_three = $product->photo_three;
        }

            $data = Product::find($id);
            $data['category_id'] = $request->category_id;
            $data['subcategory_id'] = $request->subcategory_id;
            $data['brand_id'] = $request->brand_id;
            $data['product_name'] = $request->product_name;
            $data['slug'] = $slug;
            $data['product_code'] = $request->product_code;
            $data['product_color'] = $request->product_color;
            $data['product_size'] = $request->product_size;
            $data['qty'] = $request->qty;
            $data['new_arrival'] = $request->new_arrival == null ? '0':'1';
            $data['best_deals'] = $request->best_deals == null ? '0':'1';
            $data['best_seller'] = $request->best_seller == null ? '0':'1';
            $data['featured_items'] = $request->featured_items == null ? '0':'1';
            $data['buyone_getone'] = $request->buyone_getone == null ? '0':'1';
            $data['buy_price'] = $request->buy_price;
            $data['sell_price'] = $request->sell_price;
            $data['video_link'] = $request->video_link;
            $data['discount_price'] = $request->discount_price;
            $data['photo_one'] = $imageName_one;
            $data['photo_two'] = $imageName_two;
            $data['photo_three'] = $imageName_three;
            $data['product_details'] = $request->product_details;
            $save = $data->save();
    
      if ($save){
        $notification=array(
                 'messege'=>'New Product Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.product.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         }
       }
    public function show($id){
        $data = Product::findOrFail($id)->with('category','brand','subcategory')->first();
        return view('admin.product.show',compact('data'));
    }

        public function delete($id)
    {
       $del=Product::findOrFail($id);

         if (Storage::disk('public')->exists('products/'.$del->photo_one))
        {
            Storage::disk('public')->delete('products/'.$del->photo_one);
        }

        if (Storage::disk('public')->exists('products/'.$del->photo_two))
        {
            Storage::disk('public')->delete('products/'.$del->photo_two);
        }

        if (Storage::disk('public')->exists('products/'.$del->photo_three))
        {
            Storage::disk('public')->delete('products/'.$del->photo_three);
        }
        
        $del->delete();

         if ($del) {
          $notification=array(
                 'messege'=>'Product Deleted Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.product.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         } 
    }
}






