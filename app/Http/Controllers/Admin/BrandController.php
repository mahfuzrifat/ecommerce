<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Brand;

class BrandController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        public function index(){
            $data = Brand::latest()->get();
            return view('admin.brand.index',compact('data'));
        }
     

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'brand_name' => 'required|min:4|max:30|unique:brands',  
        ]);

        $image = $request->file('brand_logo'); 
        $slug = str_slug($request->brand_name);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('brands'))
            {
                Storage::disk('public')->makeDirectory('brands');
            }

            $postImage = Image::make($image)->resize(315,215)->encode();
            Storage::disk('public')->put('brands/'.$imageName,$postImage);
        }else{
            $imageName = 'default.png';
        }

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->b_slug = $slug;
        $brand->brand_logo = $imageName;
        $brand->b_status = true;
        $brand->save();
         if ($brand) {
        $notification=array(
                 'messege'=>'Brand Added Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.brand.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'brand_name' => 'required|min:4|max:30', 
         ]); 
        
        $brand = Brand::findOrFail($id);
        $image = $request->file('brand_logo');
        $slug = str_slug($request->brand_name);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('brands'))
            {
                Storage::disk('public')->makeDirectory('brands');
            }

            if (Storage::disk('public')->exists('brands/'.$brand->brand_logo)) {
            Storage::disk('public')->delete('brands/'.$brand->brand_logo);
             }

            $postImage = Image::make($image)->resize(315,215)->encode();
            Storage::disk('public')->put('brands/'.$imageName,$postImage);

        }else{
            $imageName = $brand->brand_logo;
        }
        $brand['brand_name'] = $request->brand_name;
        $brand['b_slug'] = $slug; 
        $brand['brand_logo'] = $imageName ; 
        $brand['b_status'] = $brand->b_status ; 
        $brand->save();
        if ($brand) {
        $notification=array(
                 'messege'=>'Brand Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.brand.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $del=Brand::findOrFail($id);
         if (Storage::disk('public')->exists('brands/'.$del->brand_logo))
        {
            Storage::disk('public')->delete('brands/'.$del->brand_logo);
        }
        $del->delete(); 
         if ($del) {
          $notification=array(
                 'messege'=>'Brand Deleted Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.brand.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         } 
    }

        public function status($id){
        $info = Brand::findOrFail($id)->b_status;  
        if ($info == 1) {
            $cat = Brand::find($id);
            $cat->b_status = 0;
            $cat->save(); 
             if ($cat) {
            $notification=array(
                 'messege'=>'Brand-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.brand.index')->with($notification);
          }
        } else {
            $cat = Brand::find($id);
            $cat->b_status = 1;
            $cat->save();  
             if ($cat) {
            $notification=array(
                 'messege'=>'Brand-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.brand.index')->with($notification);
        }
      }   
    } 
}
