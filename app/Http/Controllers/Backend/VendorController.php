<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use Auth;

class VendorController extends Controller
{
    //view suppliers method
    public function view ()
    {
        $vendordata = Vendor::all();
        return view('backend.vendor.view-vendor',compact('vendordata'));
    }
    //add suppliers interface method
    public function add()
    {
        $data['countries'] = Country::get(["name","id"]);
        return view('backend.vendor.add-vendor', $data);
    }
    //store supplier method
    public function store(Request $request)
    {
        $vendor = new Vendor();
        $vendor->company_name = $request->company_name;
        $vendor->company_url = $request->company_url;
        $vendor->address_line_1 = $request->address_line_1;
        $vendor->address_line_2 = $request->address_line_2;
        $vendor->country = $request->country;
        $vendor->state = $request->state;
        $vendor->city = $request->city;
        $vendor->landmark = $request->landmark;
        $vendor->pincode = $request->pincode;
        $vendor->email = $request->email;
        $vendor->phone_no = $request->phone_no;
        $vendor->contact_person = $request->contact_person;
        $vendor->mobile_no = $request->mobile_no;
        $vendor->gstin = $request->gstin;
        $vendor->payment_method = $request->payment_method;
        $vendor->bank_name = $request->bank_name;
        $vendor->account_no = $request->account_no;
        $vendor->branch_name = $request->branch_name;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->discount_type = $request->discount_type;
        $vendor->notes = $request->notes;
        $vendor->created_by = Auth::user()->id;
        $created = $vendor->save();
        if($created){
            $notification=array(
                'message'=>'Vendor Added Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('vendors.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('vendors.view')->with($notification);
        }
    }
    //edit suppliyer method
    public function edit($id)
    {
        $editData = Vendor::find($id);
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('backend.vendor.edit-vendor',compact('editData', 'countries', 'states', 'cities'));
    }
    //update supplier method
    public function update (Request $request,$id)
    {
        $vendor = Vendor::find($id);
        $vendor->company_name = $request->company_name;
        $vendor->company_url = $request->company_url;
        $vendor->address_line_1 = $request->address_line_1;
        $vendor->address_line_2 = $request->address_line_2;
        $vendor->country = $request->country;
        $vendor->state = $request->state;
        $vendor->city = $request->city;
        $vendor->landmark = $request->landmark;
        $vendor->pincode = $request->pincode;
        $vendor->email = $request->email;
        $vendor->phone_no = $request->phone_no;
        $vendor->contact_person = $request->contact_person;
        $vendor->mobile_no = $request->mobile_no;
        $vendor->gstin = $request->gstin;
        $vendor->payment_method = $request->payment_method;
        $vendor->bank_name = $request->bank_name;
        $vendor->account_no = $request->account_no;
        $vendor->branch_name = $request->branch_name;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->discount_type = $request->discount_type;
        $vendor->notes = $request->notes;
        $vendor->updated_by = Auth::user()->id;
        $updated = $vendor->save();
        if($updated){
            $notification=array(
                'message'=>'Vendor Updated Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('vendors.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('vendors.view')->with($notification);
        }
    }
    //delete supplier method
    public function delete($id)
    {
        $vendor = Vendor::find($id);
        $del = $vendor->delete(); 
        if($del){
            $notification=array(
                'message'=>'Vendor deleted Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->back()->with($notification);
        }
    }
}
