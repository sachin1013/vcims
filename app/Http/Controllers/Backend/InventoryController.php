<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Vendor;
use App\Model\Invoice;
use App\Model\Address;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use App\Model\Country;
use App\Model\Prescription;
use App\Model\Stock;
use APP\Model\Repurchase;
use Auth;
use DB;
use PDF;

class InventoryController extends Controller
{
	public function overview (Request $request)
    {   
        $products = Stock::groupBy('product_id')
                            ->selectRaw('count(*) as total, product_id')
                            ->get();
        $product_count = count($products);
        
        $product_quantity = DB::table('stocks')
                            ->where('status', '=', 1)
                            ->sum('quantity');


        $product_reorder = DB::table('stocks')
                            ->where('quantity', '<=', 0)
                            ->get();
                            
        if(count($product_reorder) > 0)  {
            $reorder_count = count($product_reorder);
        }
        else {
            $reorder_count = 0;   
        }

        $inventory_val =Stock::all()->sum(function($t){ 
                                                        return $t->quantity * $t->unit_price; 
                                                    }); 

    	return view('backend.inventory.overview', compact('product_count', 'product_quantity', 'reorder_count', 'inventory_val'));
    }

    public function stocks (Request $request)
    {   
        $stocks = Stock::all();
        return view('backend.inventory.stocksqih', compact('stocks'));
    }

    public function porders (Request $request)
    {   
        $porders = DB::table('repurchases')->get();
        return view('backend.inventory.porders', compact('porders'));
    }

    public function reports (Request $request)
    {   
        $invoices = DB::table('invoices')->get();
       
        return view('backend.inventory.reports', compact('invoices'));
    }
}