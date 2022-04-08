<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'address'=>'required|unique:sites',
            'lat'=>'required',
            'lng'=>'required',
            'customer'=>'required',
        ]);

        $d=new Site();
        $d->address=$request->address;
        $d->customer_id=$request->customer;
        $d->lat=$request->lat;
        $d->lng=$request->lng;
        $d->save();
        return $d;
    }

    public function get(){
        return Site::orderBy('id','desc')->get();
    }
}
