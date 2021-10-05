<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Vendor;
use App\Model\Prescription;
use DB;
use Auth;
class DefaultController extends Controller
{
    /*throw supplier id get category
    public function getCategory(Request $request)
    {
        $vendor_id = $request->vendor_id;
        // dd($supplier_id);
        $allcategory  = Product::with(['category'])->select('category_id')->where('vendor_id',$vendor_id)->groupBy('category_id')->get();
        // dd($allcategory->toArray());
        return response()->json($allcategory);
    }*/
    //throw category id get product
    public function getProduct(Request $request)
    {
        $category_id = $request->category_id;
        $vendor_id = $request->vendor_id;
        $allproduct  = Product::where('vendor_id', $vendor_id)->where('category_id',$category_id)->get();
        return response()->json($allproduct);
    }
    /*public function getProductinvoice(Request $request)
    {
        $category_id = $request->category_id;
        
        //$allproduct  = Product::where('category_id',$category_id)->get();
        return response()->json($category_id);
    }*/
    public function getStock(Request $request){
        $product_id = $request->product_id;
        $stock = DB::table('purchase_details')->where('product_id',$product_id)->get();
        //dd($stock);
        return response()->json($stock);
    }

    public function getprescriptions(Request $request) {
           $customer_id = $request->customer_id;
           $prescriptions = Prescription::where('customer_id', $customer_id)->get();
           return response()->json($prescriptions);
    }

}
