<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\letter;
class AllController extends Controller
{
    public function store(Request $request){
    	 $request->validate([
           'email' => 'required|unique:letters|email',  
       ]); 

    	$email = new letter();
    	$email->email = $request->email;
    	$email->save();
    	if ($email) {
        $notification=array(
                 'messege'=>'Thanks to subscribe !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->back()->with($notification);
         }else{
         	 $notification=array(
                 'messege'=>'Something went wrong !!',
                 'alert-type'=>'error'
                  );
            return Redirect()->back()->with($notification);
         }  
    }
}
