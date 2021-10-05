<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use Auth;

class BrandController extends Controller
{
    //view categories method
    public function view ()
    {
        $alldata = Brand::all();
        return view('backend.brands.view-brands',compact('alldata'));
    }

     //add categories interface method
    public function add()
    {
        return view('backend.brands.add-brands');
    }

    public function store(Request $request)
    {
    	$brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = '1';
        $brand->created_by = Auth::user()->id;
        $add_brand = $brand->save();
        if($add_brand){
            $notification=array(
                'message'=>'Brand details added Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('brands.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('brands.view')->with($notification);
        }
    }

    public function edit($id)
    {
        $editData = Brand::find($id);
        return view('backend.brands.edit-brands',compact('editData'));
    }

    //update categories method
    public function update (Request $request,$id)
    {

    	$brand = Brand::find($id);
    	$brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = '1';
        $brand->created_by = Auth::user()->id;
        $update_brand = $brand->save();
        if($update_brand){
            $notification=array(
                'message'=>'Brand details updated Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('brands.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('brands.view')->with($notification);
        }
    }
}