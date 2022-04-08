<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'description'=>'required|unique:companies',
            'email'=>'required|unique:companies',
            'address'=>'required',
            'phone'=>'required',
        ]);

        $d=new Company();
        $d->description=$request->description;
        $d->email=$request->email;
        $d->address=$request->address;
        $d->phone=$request->phone;
        $d->end_date=Carbon::now();
        $d->save();
        return $d;

    }

    public function get(){
        return Company::orderBy('id','desc')->get();
    }
}
