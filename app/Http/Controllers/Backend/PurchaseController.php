<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\PurchasePayment;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Address;
use App\Model\Vendor;
use App\Model\Country;
use App\Model\Stock;
use Auth;
use DB;

class PurchaseController extends Controller
{
    //view parchase method
    public function view ()
    {
        $alldata = Purchase::orderBy('purchase_date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.view-purchase',compact('alldata'));
    }
    //add parchase interface method
    public function add()
    {
        $data['vendor'] = Vendor::all();
        $data['product'] = Product::all();
        $data['category'] = Categories::all();
        $data['vendors'] = Vendor::all();
        $data['categ'] = Categories::all();
        $data['countries'] = Country::get(["name","id"]);
        $data['origins'] = Country::get(["name","id"]);
        $data['purchase_date'] = date('Y-m-d');
        return view('backend.purchase.add-purchase',$data);
    }
    public function ajaxaddvendor(Request $request)
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
        $vendor->discount_type = $request->discount_type;
        $vendor->notes = $request->notes;
        $vendor->created_by = Auth::user()->id;
        $add_vendor = $vendor->save();
        if($add_vendor){
          
            return response()->json(['success' => 'Vendor details added successfully.']);
            
        }
    }

    public function ajaxaddcategory(Request $request)
        {
        $Category = new Categories();
        $Category->name = $request->name;
        $Category->description = $request->description;
        $Category->cgst_perc = $request->cgst_perc;
        $Category->sgst_perc = $request->sgst_perc;
        $Category->created_by = Auth::user()->id;
        $add_category = $Category->save();
        if($add_category){
           
            return response()->json(['success' => 'Product category added Successfully.']);
            }

        
        }

        public function ajaxaddproduct(Request $request)
        {
            $product = new Product();
                    $product->vendor_id = $request->vendor_id;
                    $product->category_id = $request->category_id;
                    $product->product_modelno = $request->product_modelno;
                    $product->product_collection = $request->product_collection;
                    $product->country_origin = $request->country_origin;
                    $product->brand = $request->brand;
                    $product->frame_type = $request->frame_type;
                    $product->frame_shape = $request->frame_shape;
                    $product->frame_size = $request->frame_size;
                    $product->frame_width = $request->frame_width;
                    $product->frame_dimension = $request->frame_dimension;
                    $product->height = $request->height;
                    $product->frame_color = $request->frame_color;
                    $product->temple_color = $request->temple_color;
                    $product->frame_weight = $request->frame_weight;
                    $product->frame_material = $request->frame_material;
                    $product->temple_material = $request->temple_material;
                    $product->prescription_type = $request->prescription_type;
                    $product->frame_style = $request->frame_style;
                    $product->frame_style_secondary = $request->frame_style_secondary;
                    $product->gender = $request->gender;
                    $product->product_condition = $request->product_condition;
                    $product->product_warranty = $request->product_warranty;
                    $product->base_curve = $request->base_curve;
                    $product->lens_diameter = $request->lens_diameter;
                    $product->water_content = $request->water_content;
                    $product->lens_material = $request->lens_material;
                    $product->packaging = $request->packaging;
                    $product->usage_duration = $request->usage_duration;
                    $product->solution_qty = $request->solution_qty;
                    $product->created_by = Auth::user()->id;
                    $add_product = $product->save();
                    if($add_product){
                        return response()->json(['success' => 'Product details added successfully.']);
                    }
            }

            public function getTaxes(Request $request) {
                $category_id = $request->category_id;
                $tax_status = $request->tax_status;
                if($tax_status == 'true'){
                 $category_taxes  = Categories::where('id', $category_id)->first();
                 return response()->json($category_taxes);
                }
                else {
                    return response()->json();
                }
            
            }
    //store purchase method
    public function store(Request $request)
    {   
        if($request->category_id == null){
            $notification=array(
                'message'=>'Nothing For Purchase!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
        
                    $purchase = new Purchase();
                    $purchase->purchase_date =date('Y-m-d',strtotime($request->purchase_date));
                    $purchase->purchase_invoice_no = $request->purchase_invoice_no;
                    $purchase->vendor_id = $request->vendor_id;
                    $purchase->tax_status = $request->has('tax_status');
                    $purchase->taxation_type = $request->taxation_type;
                    $purchase->total_discount = $request->total_discount;
                    $purchase->cgst_total = $request->cgst_total;
                    $purchase->sgst_total = $request->sgst_total;
                    $purchase->total_qty = $request->total_qty;
                    $purchase->grand_total = $request->grand_total;
                    $purchase->description = $request->description;
                    $purchase->status = '0';
                    $purchase->created_by = Auth::user()->id;

                    DB::transaction(function () use($request,$purchase) {
                        if($purchase->save()){
                        $count_category = count($request->category_id);
                        for($i=0; $i < $count_category; $i++)   {
                                $purchase_detail = new PurchaseDetail();
                                $purchase_detail->date = date('Y-m-d', strtotime($request->date[$i]));
                                $purchase_detail->invoice_no = $request->invoice_no[$i];
                                $purchase_detail->category_id = $request->category_id[$i];
                                $purchase_detail->product_id = $request->product_id[$i];
                                $purchase_detail->hsn_sac = $request->hsn_sac[$i];
                                $purchase_detail->unit_price = $request->unit_price[$i];
                                $purchase_detail->buying_qty = $request->buying_qty[$i];
                                $purchase_detail->cgst_perc = $request->cgst_perc[$i];
                                $purchase_detail->cgst_amt = $request->cgst_amt[$i];
                                $purchase_detail->sgst_perc = $request->sgst_perc[$i];
                                $purchase_detail->sgst_amt = $request->sgst_amt[$i];
                                $purchase_detail->discount_type = $request->discount_type[$i];
                                $purchase_detail->discount_rate = $request->discount_rate[$i];
                                $purchase_detail->discount_amt = $request->discount_amt[$i];
                                $purchase_detail->selling_price = $request->selling_price[$i];
                                $purchase_detail->sub_total = $request->sub_total[$i];
                                $purchase_detail->notes = $request->notes[$i];
                                $purchase_detail->status = '0';
                                $purchase_detail->created_by = $request->created_by[$i];
                                $vendor_id = $purchase->vendor_id;
                                $stock = DB::table('stocks')
                                                ->where('product_id', '=', $purchase_detail->product_id)
                                                ->where('vendor_id', '=', $vendor_id)
                                                ->where('unit_price', '=', $purchase_detail->unit_price)
                                                ->first();
                                if ($stock) {
                                    $purchase_qyt = $purchase_detail->buying_qty;
                                    $final_qty = $stock->quantity + $purchase_qyt;
                                    \DB::table('stocks')
                                                ->where('product_id', '=', $purchase_detail->product_id)
                                                ->where('vendor_id', '=', $vendor_id)
                                                ->where('unit_price', '=', $purchase_detail->unit_price)
                                                ->update(['quantity' => $final_qty]);
                                    }

                                 else {
                                    $stock = new Stock();
                                    $vendor_id = $purchase->vendor_id;
                                    $stock->product_id = $request->product_id[$i];
                                    $stock->category_id = $request->category_id[$i];
                                    $stock->vendor_id = $vendor_id;
                                    $stock->quantity = $request->buying_qty[$i];
                                    $stock->unit_price = $request->unit_price[$i];
                                    $stock->status = '1';
                                    $stock->created_by = Auth::user()->id;
                                    $stock->save();
                                }
                                    
                                $purchase_detail->save();
                            }
                            $purchase_payment = new PurchasePayment();
                            $purchase_payment->purchase_invoice_no = $purchase->purchase_invoice_no;
                            $purchase_payment->vendor_id = $purchase->vendor_id;
                            $purchase_payment->payment_date = date('Y-m-d',strtotime($purchase->purchase_date));
                            $purchase_payment->payment_type = $request->payment_type;
                            $purchase_payment->payment_modes = $request->payment_modes;
                            $purchase_payment->transaction_id = $request->transaction_id;
                            $purchase_payment->paid_amount = $request->paid_amount;
                            $purchase_payment->due_amount = $request->due_amount;
                            $purchase_payment->total_amount = $purchase_detail->grand_total;
                            $purchase_payment->created_by = Auth::user()->id;
                            $purchase_payment->save();
                        }
                    });
            }       
            $notification=array(
                'message'=>'Purchase Added Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('purchase.view')->with($notification);        
    }
    public function edit($id)
    {
        $data['vendor'] = Vendor::all();
        $data['product'] = Product::all();
        $data['categories'] = Categories::all();
        $data['vendors'] = Vendor::all();
        $data['categ'] = Categories::all();
        $data['countries'] = Country::get(["name","id"]);
        $data['origins'] = Country::get(["name","id"]);
        $data['purchase_date'] = date('Y-m-d');
        $data['purchase'] = Purchase::find($id);

        return view('backend.purchase.edit-purchase',$data);
        
    }

    public function update($id, Request $request)
    {
                $purchase = Purchase::find($id);
                        $purchase->purchase_date =date('Y-m-d',strtotime($request->purchase_date));
                        $purchase->purchase_invoice_no = $request->purchase_invoice_no;
                        $purchase->vendor_id = $request->vendor_id;
                        $purchase->tax_status = $request->has('tax_status');
                        $purchase->taxation_type = $request->taxation_type;
                        $purchase->total_discount = $request->total_discount;
                        $purchase->cgst_total = $request->cgst_total;
                        $purchase->sgst_total = $request->sgst_total;
                        $purchase->total_qty = $request->total_qty;
                        $purchase->grand_total = $request->grand_total;
                        $purchase->description = $request->description;
                        $purchase->status = '0';
                        $purchase->created_by = Auth::user()->id;
                        
                        DB::transaction(function () use($request,$purchase) {
                        if($purchase->save()){
                        $count_category = count($request->category_id);
                        for($i=0; $i < $count_category; $i++)   {
                                $purchase_detail = new PurchaseDetail();
                                $purchase_detail->date = date('Y-m-d', strtotime($request->date[$i]));
                                $purchase_detail->invoice_no = $request->invoice_no[$i];
                                $purchase_detail->category_id = $request->category_id[$i];
                                $purchase_detail->product_id = $request->product_id[$i];
                                $purchase_detail->hsn_sac = $request->hsn_sac[$i];
                                $purchase_detail->unit_price = $request->unit_price[$i];
                                $purchase_detail->buying_qty = $request->buying_qty[$i];
                                $purchase_detail->cgst_perc = $request->cgst_perc[$i];
                                $purchase_detail->cgst_amt = $request->cgst_amt[$i];
                                $purchase_detail->sgst_perc = $request->sgst_perc[$i];
                                $purchase_detail->sgst_amt = $request->sgst_amt[$i];
                                $purchase_detail->discount_type = $request->discount_type[$i];
                                $purchase_detail->discount_rate = $request->discount_rate[$i];
                                $purchase_detail->discount_amt = $request->discount_amt[$i];
                                $purchase_detail->selling_price = $request->selling_price[$i];
                                $purchase_detail->sub_total = $request->sub_total[$i];
                                $purchase_detail->notes = $request->notes[$i];
                                $purchase_detail->status = '0';
                                $purchase_detail->created_by = $request->created_by[$i];
                                $purchase_detail->save();
                            }
                        }
                        });
                    
                        $notification=array(
                        'message'=>'Purchase Invoice Updated Successfully.',
                        'alert-type'=>'success'
                    );
                    return redirect()->route('purchase.view')->with($notification);

    }
    //pending purchase method
    public function PendingList()
    {
        $alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.view-pending',compact('alldata'));
    }
    //approve purchase method
    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::Where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')->where('id', $id)->update(['status'=>1]);
        }
        
        $notification=array(
            'message'=>'Successfully Approve Purchase',
            'alert-type'=>'success'
        );
        return redirect()->route('purchase.view')->with($notification);
       
    }
    //delete purchase method
    public function delete($id)
    {
        $Purchase = Purchase::find($id);
        $del = $Purchase->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Data',
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
