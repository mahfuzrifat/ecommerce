<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\letter;
class CouponController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){
    	$data = Coupon::latest()->get();
    	return view('admin.coupon.index',compact('data'));
    }

    public function store(Request $request){ 
    	$request->validate([
           'coupon_code' => 'required|unique:coupons|min:3|max:25',
           'type' => 'required',  
       ]);
    	$type = $request->type;
    	$value = $request->value;
    	$percent = $request->percent_off;
    	if ($type == 'fixed' && $value == NULL) {
    		$notification=array(
                 'messege'=>'Fixed value can not empty,when you select coupon type Fixed !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} elseif ($type == 'percent' && $percent == NULL) {
    		$notification=array(
                 'messege'=>'Percent-Off can not empty,when you select coupon type Percent !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} elseif ($value == !NULL && $percent == !NULL) {
    		$notification=array(
                 'messege'=>'Follow the instraction carefully :) !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} else{
    		$cup = new Coupon();
    		$cup->coupon_code = $request->coupon_code;
    		$cup->type = $type;
    		$cup->value = $value;
    		$cup->percent_off = $percent;
    		$cup->p_status = true ;
    		$cup->save();
    		if ($cup) {
    			$notification=array(
                 'messege'=>'New Coupon Added Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.coupon.index')->with($notification);
    		} else {
           return Redirect()->back()->with($notification); 
    		} 
    	}  
    	
    }

        public function status($id)
    {
        $info = Coupon::findOrFail($id)->p_status;  
        if ($info == 1) {
            $cup = Coupon::find($id);
            $cup->p_status = 0;
            $cup->save(); 
             if ($cup) {
            $notification=array(
                 'messege'=>'Coupon-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.coupon.index')->with($notification);
       }
    
        } else {
            $cup = Coupon::find($id);
            $cup->p_status = 1;
            $cup->save();  
             if ($cup) {
            $notification=array(
                 'messege'=>'Coupon-Status Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.coupon.index')->with($notification);
        }
    }
}

public function edit($id){ 
	$data = Coupon::findOrFail($id);
	return view('admin.coupon.edit',compact('data'));
}
public function update(Request $request,$id){
	$request->validate([
           'coupon_code' => 'required|min:3|max:25',
           'type' => 'required',  
       ]);
    	$type = $request->type;
    	$value = $request->value;
    	$percent = $request->percent_off;
    	$status = Coupon::findOrFail($id)->p_status;
    	if ($type == 'fixed' && $value == NULL) {
    		$notification=array(
                 'messege'=>'Fixed value can not empty,when you select coupon type Fixed !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} elseif ($type == 'percent' && $percent == NULL) {
    		$notification=array(
                 'messege'=>'Percent-Off can not empty,when you select coupon type Percent !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} elseif ($value == !NULL && $percent == !NULL) {
    		$notification=array(
                 'messege'=>'Follow the instraction carefully :) !!',
                 'alert-type'=>'error'
                  );
           return Redirect()->back()->with($notification);
    	} else{
    		$cup = Coupon::find($id);
    		$cup->coupon_code = $request->coupon_code;
    		$cup->type = $type;
    		$cup->value = $value;
    		$cup->percent_off = $percent;
    		$cup->p_status = $status ;
    		$cup->save();
    		if ($cup) {
    			$notification=array(
                 'messege'=>'Coupon Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->route('admin.coupon.index')->with($notification);
    		} else {
           return Redirect()->back()->with($notification); 
    		} 
    	}  
}

public function destroy($id){
	$data = Coupon::findOrFail($id);
	$data->delete();
	if ($data) {
		$notification=array(
         'messege'=>'Coupon Deleted Successfully !!',
         'alert-type'=>'success'
          );
		   return Redirect()->route('admin.coupon.index')->with($notification);
			} else {
		   return Redirect()->back()->with($notification); 
			}
}

public function letter(){
  $data = letter::latest()->get();
  return view('admin.letter.index',compact('data'));
}
public function delete($id){
  $dlt = letter::findOrFail($id);
  $dlt->delete();
  if ($dlt) {
    $notification=array(
         'messege'=>'Subscriber Deleted Successfully !!',
         'alert-type'=>'success'
          );
       return Redirect()->route('admin.letter.index')->with($notification);
      } else {
       return Redirect()->back()->with($notification); 
      }
}
}
