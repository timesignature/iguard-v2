<?php

namespace App\Http\Controllers;

use App\Mail\EmployeeCreatedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'email'=>'required|unique:users|email',
            'image'=>'required|mimes:jpg,jpeg,bmp,png,webp',
            'rights'=>'required'
        ]);

        $u=new User();
        $u->name=$request->name;
        $u->email=$request->email;
        $u->phone=$request->phone;
        $u->address=$request->address;
        $u->hasRights=$request->rights;
        $u->api_token=Str::random(60);
        $u->image=$this->image_upload($request,'employees');
        $u->save();

//        Mail::to($u->email)->send(new EmployeeCreatedMail($u));
        return $u;
    }

    public function get(){
        return User::orderBy('id','desc')->get();
    }


    public function image_upload($request,$destination){
        $x=20;
        if($request->hasFile('image')){
            $image=$request->file('image');
            $fileName=time().'_'.$image->getClientOriginalName();
            $img=Image::make($image);
            $img->save(public_path('app/'.$destination.'/'.$fileName),$x);
            return 'app/'.$destination.'/'.$fileName;
        }
    }
}
