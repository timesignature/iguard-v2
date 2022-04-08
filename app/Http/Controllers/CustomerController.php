<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:clients',
            'email'=>'required|unique:clients',
            'phone'=>'required',
        ]);



        $d=new Customer();
        $d->name=$request->name;
        $d->email=$request->email;
        $d->phone=$request->phone;
//        $d->api_token=Str::random(60);
//        $d->company_id=Auth::user()->company_id;
        $d->save();
        return $d;

    }

    public function get(){
        return Customer::all();
    }
}
