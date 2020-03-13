<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
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
    public function index()
    {
        $data = Category::latest()->get();
        return view('admin.category.index',compact('data'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
           'category_name' => 'required|unique:categories|min:3|max:50',  
       ]); 
     
    $slug = str_slug($request->category_name);  
    $cat = new Category();
    $cat->category_name = $request->category_name;
    $cat->c_slug =  $slug; 
    $cat->c_status = true;
    $cat->save();
    
     if ($cat) {
        $notification=array(
                 'messege'=>'New Category Added Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.category.index')->with($notification);
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
    public function status($id)
    {
        $info = Category::findOrFail($id)->c_status;  
        if ($info == 1) {
            $cat = Category::find($id);
            $cat->c_status = 0;
            $cat->save(); 
             if ($cat) {
            $notification=array(
                 'messege'=>'Category-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.category.index')->with($notification);
       }
    
        } else {
            $cat = Category::find($id);
            $cat->c_status = 1;
            $cat->save();  
             if ($cat) {
            $notification=array(
                 'messege'=>'Category-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.category.index')->with($notification);
        }
        
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.category.edit',compact('data'));
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
        $status = Category::findOrFail($id)->category_name;
        if ($status === $request->category_name) {
           $notification=array(
                 'messege'=>'Old and New Category name are same !! No need to Update :) ',
                 'alert-type'=>'warning'
                  );
           return Redirect()->route('admin.category.index')->with($notification);

        } else {
              $request->validate([
           'category_name' => 'required|unique:categories|min:3|max:50',
       ]); 
     $status = Category::findOrFail($id)->c_status; 
    $slug = str_slug($request->category_name);  
    $cat = Category::find($id);
    $cat->category_name = $request->category_name;
    $cat->c_slug =  $slug; 
    $cat->c_status = $status;
    $cat->save();
    
     if ($cat) {
        $notification=array(
                 'messege'=>'Category Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.category.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         }
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
         $dlt=Category::findOrFail($id)->delete();
          if ($dlt) {
        $notification=array(
                 'messege'=>'Category Deleted Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.category.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         }
    }
}
