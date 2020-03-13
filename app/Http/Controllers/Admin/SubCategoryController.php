<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
class SubCategoryController extends Controller
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

        $cat = Category::where('c_status',1)->get();
        $data = SubCategory::latest()->get(); 
        return view('admin.subcategory.index',compact('cat','data'));
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
            'sub_category_name' => 'required|min:4|max:25|unique:sub_categories',
            'category_id' => 'required',
        ]);

        $sub = new SubCategory();
        $sub->sub_category_name = $request->sub_category_name;
        $sub->s_slug = str_slug($request->sub_category_name);
        $sub->s_status = true;
        $sub->category_id = $request->category_id;
        $sub->save();
         if ($sub) {
          $notification=array(
                 'messege'=>'New Sub-Category Added Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.subcategory.index')->with($notification);
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
        $cat =Category::all();
        $data = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit',compact('data','cat'));
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
            'sub_category_name' => 'required|min:4|max:25',
            'category_id' => 'required',
        ]);
        $status = SubCategory::findOrFail($id)->s_status;
        $sub = SubCategory::find($id);
        $sub->sub_category_name = $request->sub_category_name;
        $sub->s_slug = str_slug($request->sub_category_name);
        $sub->s_status = $status;
        $sub->category_id = $request->category_id;
        $sub->save();
         if ($sub) {
          $notification=array(
                 'messege'=>'New Sub-Category Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.subcategory.index')->with($notification);
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
        $data = SubCategory::findOrFail($id);
        $dlt = $data->delete();
          if ($dlt) {
          $notification=array(
                 'messege'=>'New Sub-Category Deleted Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.subcategory.index')->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         }

    }
      public function status($id){
        $info = SubCategory::findOrFail($id)->s_status;  
        if ($info == 1) {
            $cat = SubCategory::find($id);
            $cat->s_status = 0;
            $cat->save(); 
             if ($cat) {
            $notification=array(
                 'messege'=>'SubCategory-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.subcategory.index')->with($notification);
          }
        } else {
            $cat = SubCategory::find($id);
            $cat->s_status = 1;
            $cat->save();  
             if ($cat) {
            $notification=array(
                 'messege'=>'SubCategory-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.subcategory.index')->with($notification);
        }
      }   
    }
}
