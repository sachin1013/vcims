<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Vendor;
use App\Model\Country;
use App\Model\Brand;
use Auth;

class ProductController extends Controller
{
    //view product method
    public function view ()
    {
        $alldata = Product::all();
        return view('backend.product.view-product', compact('alldata'));
    }
    //add product interface method
    public function add()
    {
        $data['vendor'] = Vendor::all();
        $data['category'] = Categories::all();
        $data['brands'] = Brand::all();
        $data['countries'] = Country::get(["name","id"]);
        return view('backend.product.add-product',$data);
    }
    //store product method
    public function store(Request $request)
    {
        $product = new Product();
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_model_no = $request->product_model_no;
        $product->product_collection = $request->product_collection;
        $product->country_origin = $request->country_origin;
        $product->brand = $request->brand;
        $product->frame_type = $request->frame_type;
        $product->frame_shape = $request->frame_shape;
        $product->frame_size = $request->frame_size;
        $product->frame_dimension = $request->frame_dimension;
        $product->temple_length = $request->temple_length;
        $product->bridge_width = $request->bridge_width;
        $product->lens_width = $request->lens_width;
        $product->sunglass_color = $request->sunglass_color;
        $product->sunglass_lens_material = $request->sunglass_lens_material;
        $product->sunglass_lens_technology = $request->sunglass_lens_technology;
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
        $product->contact_lens_type = $request->contact_lens_type;
        $product->base_curve = $request->base_curve;
        $product->contact_lens_color = $request->contact_lens_color;
        $product->contact_lens_diameter = $request->contact_lens_diameter;
        $product->water_content = $request->water_content;
        $product->contact_lens_material = $request->contact_lens_material;
        $product->contact_lens_packaging = $request->contact_lens_packaging;
        $product->usage_duration = $request->usage_duration;
        $product->contact_lens_solution_qty = $request->contact_lens_solution_qty;
        $product->created_by = Auth::user()->id;
        $add_product = $product->save();
        if($add_product){
            $notification=array(
                'message'=>'Product details added successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('products.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('products.view')->with($notification);
        }
    }
    //edit product method
    public function edit($id)
    {  
        $data['editData'] = Product::find($id); 
        $data['vendor'] = Vendor::all();
        $data['category'] = Categories::all();
        $data['brands'] = Brand::all();
        $data['countries'] = Country::all();
        return view('backend.product.edit-product',$data);
    }
    //update product method
    public function update (Request $request,$id)
    {
        $product =Product::find($id);
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_model_no = $request->product_model_no;
        $product->product_collection = $request->product_collection;
        $product->country_origin = $request->country_origin;
        $product->brand = $request->brand;
        $product->frame_type = $request->frame_type;
        $product->frame_shape = $request->frame_shape;
        $product->frame_size = $request->frame_size;
        $product->frame_dimension = $request->frame_dimension;
        $product->temple_length = $request->temple_length;
        $product->bridge_width = $request->bridge_width;
        $product->lens_width = $request->lens_width;
        $product->sunglass_color = $request->sunglass_color;
        $product->sunglass_lens_material = $request->sunglass_lens_material;
        $product->sunglass_lens_technology = $request->sunglass_lens_technology;
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
        $product->contact_lens_type = $request->contact_lens_type;
        $product->base_curve = $request->base_curve;
        $product->contact_lens_color = $request->contact_lens_color;
        $product->contact_lens_diameter = $request->contact_lens_diameter;
        $product->water_content = $request->water_content;
        $product->contact_lens_material = $request->contact_lens_material;
        $product->contact_lens_packaging = $request->contact_lens_packaging;
        $product->usage_duration = $request->usage_duration;
        $product->contact_lens_solution_qty = $request->contact_lens_solution_qty;
        $product->updated_by = Auth::user()->id;
        $up_product = $product->save();
        if($up_product){
            $notification=array(
                'message'=>'Product updated successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('products.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('products.view')->with($notification);
        }
    }
    //delete product method
    public function delete($id)
    {
        $product = Product::find($id);
        $del = $product->delete(); 
        if($del){
            $notification=array(
                'message'=>'Product deleted successfully',
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
