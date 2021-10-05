<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\Customer;
use App\Model\Payment;
use App\Model\Prescription;
use Carbon\Carbon;
use DB;
use Auth;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * $data['count_pur'] = Purchase::all()->count();
        $data['count_cus'] = Customer::all()->count();
        $data['count_sale'] = Invoice::where('status','1')->count();
        $data['count_due'] = Payment::sum('due_amount');
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
      return view('backend.layouts.home');
    }
    public function updateStats(Request $request)
    {
        $duration = $request->get('duration');
        $store = $request->get('store');
        $user_id = Auth::user()->id;
        $today = \Carbon\Carbon::today();
        $weekdate = \Carbon\Carbon::today()->subDays(7);
        $monthdate = \Carbon\Carbon::today()->subDays(30);
        if($user_id == 6 || $user_id == 7) {
                    if ($duration == "today") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $user_id)
                                                        ->get();
                        $customers = Customer::where('created_at', '>=', $today)->where('created_by','=', $user_id)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $today)->where('created_by','=', $user_id)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $user_id)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    } elseif ($duration == "thisweek") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $user_id)->get();
                        $customers = Customer::where('created_at', '>=', $weekdate)->where('created_by','=', $user_id)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $weekdate)->where('created_by','=', $user_id)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $user_id)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                        
                        
                    } else {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $user_id)->get();
                        $customers = Customer::where('created_at', '>=', $monthdate)->where('created_by','=', $user_id)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $monthdate)->where('created_by','=', $user_id)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $user_id)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    }
        
        return Response::json(array('total' => $total,'customers' => $customers,'prescriptions' => $prescriptions,'orders' =>$orders ));
        }
        
        elseif($user_id == 5 && ($store == 6 || $store == 7)) {
                    if ($duration == "today") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $store)
                                                        ->get();
                        $customers = Customer::where('created_at', '>=', $today)->where('created_by','=', $store)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $today)->where('created_by','=', $store)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $store)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    } elseif ($duration == "thisweek") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $store)->get();
                        $customers = Customer::where('created_at', '>=', $weekdate)->where('created_by','=', $store)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $weekdate)->where('created_by','=', $store)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $store)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                        
                        
                    } else {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id', '=', $store)->get();
                        $customers = Customer::where('created_at', '>=', $monthdate)->where('created_by','=', $store)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $monthdate)->where('created_by','=', $store)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->where('store_id','=', $store)->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    }
        
        return Response::json(array('total' => $total,'customers' => $customers,'prescriptions' => $prescriptions,'orders' =>$orders ));
        }
        
        elseif($user_id == 5 && $store == 1) {
                    if ($duration == "today") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])->get();
                        $customers = Customer::where('created_at', '>=', $today)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $today)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    } elseif ($duration == "thisweek") {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->get();
                        $customers = Customer::where('created_at', '>=', $weekdate)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $weekdate)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $weekdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                        
                        
                    } else {
                        $invoices = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->get();
                        $customers = Customer::where('created_at', '>=', $monthdate)->count();
                        $prescriptions = Prescription::where('created_at', '>=', $monthdate)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $monthdate)
                                                        ->whereIn('sales_invoice_status', [1, 2])
                                                        ->count();
                        $total = 0;
            				        foreach($invoices as $invoice)
            				        {
            				            $gtotal = $invoice->grand_total;
            				            $total = $total + $gtotal;
            				        }
                        
                    }
        
        return Response::json(array('total' => $total,'customers' => $customers,'prescriptions' => $prescriptions,'orders' =>$orders ));
        }
    }
}
