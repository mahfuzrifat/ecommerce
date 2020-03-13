<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
class SettingsController extends Controller
{
      public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){
    	$data = User::where('role_id',1)->first(); 
    	return view('admin.settings.index',compact('data'));
    }

    public function update(Request $request,$id){ 
    	$this->validate($request,[
            'name' => 'required|min:4',
            'phone' => 'required|min:11|max:14',
            'email' => 'required|email', 
            'photo' => 'image', 
         ]); 
    	
        $user = User::findOrFail($id);
        $image = $request->file('photo');
        $slug = str_slug($request->name);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('user'))
            {
                Storage::disk('public')->makeDirectory('user');
            }

            if (Storage::disk('public')->exists('user/'.$user->photo)) {
            Storage::disk('public')->delete('user/'.$user->photo);
             }

            $postImage = Image::make($image)->resize(315,215)->encode();
            Storage::disk('public')->put('user/'.$imageName,$postImage);

        }else{
        	$imageName = $user->photo;
        }
        $user['name'] = $request->name;
        $user['username'] = $slug;
        $user['email'] = $request->email;
        $user['phone'] = $request->phone;
        $user['about'] = $request->about;
        $user['address'] = $request->address;
        $user['photo'] = $imageName ; 
        $user->save();
        if ($user) {
        $notification=array(
                 'messege'=>'User Updated Successfully !!',
                 'alert-type'=>'success'
                  );
           return Redirect()->back()->with($notification);
         }else{
            return Redirect()->back()->with($notification);
         } 
    }


    public function updatePassword(Request $request){
       $this->validate($request,[
           'o_password' => 'required',
           'password' => 'required|confirmed|min:8',
       ]);
       $hasPassword = Auth::user()->password;
       if (Hash::check($request->o_password,$hasPassword)){
           if (!Hash::check($request->password,$hasPassword)){
               $user = User::find(Auth::id());
               $user->password = Hash::make($request->password);
               $user -> save();
               if ($user) {
                   $notification=array(
                       'messege'=>'Password Updated Successfully !!',
                       'alert-type'=>'success'
                   );
                   Auth::logout();
                   return redirect()->back();
               }
           }else{
               $notification=array(
                   'messege'=>'New Password Can not be same as like old password !!',
                   'alert-type'=>'error'
               );
               return Redirect()->route('admin.settings')->with($notification);
           }
       }else{
           $notification=array(
               'messege'=>'Input Your Valid Password !!',
               'alert-type'=>'error'
           );
               return Redirect()->route('admin.settings')->with($notification);

       }
   }

}
