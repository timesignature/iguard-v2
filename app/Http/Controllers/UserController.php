<?php

namespace App\Http\Controllers;

use App\Mail\UserCreateMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function add(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:8',
            'confirmPassword'=>'required|same:password'
        ]);

        $u=new User();
        $u->name=$request->name;
        $u->email=$request->email;
        $u->api_token=Str::random(60);
        $u->password=Hash::make($request->password);
        $u->save();

        Mail::to($u->email)->send(new UserCreateMail($u));
        return $u;
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users',
            'password'=>'required|min:8',
        ]);


        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if($user->email_verified_at==null){
            throw ValidationException::withMessages([
                'email' => ['this email address is not yet verified'],
            ]);
        }




        if($user->isActive==0){
            throw ValidationException::withMessages([
                'email' => ['this email address is not yet activated'],
            ]);
        }


        return $user->api_token;


    }


    public function confirmEmailAddress($id){
        $u=User::find($id);
        $u->email_verified_at=Carbon::now();
        $u->update();
        return Redirect::away('http://localhost:3000/login');
    }

}
