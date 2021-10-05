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
use App\Model\Repurchase;
use Auth;
use DB;
use PDF;

class InvoiceController extends Controller
{
    //view Invoice method
    public function view (Request $request)
    {
        $user_id = Auth::user()->id;
        if($user_id == '5')
        {
            $alldata = Db::table('invoices')->orderBy('created_at', 'desc')->get();
        }
        else{
        $alldata = Db::table('invoices')->where('store_id', '=', $user_id)->orderBy('created_at', 'desc')->get();
        }
        return view('backend.invoice.view-invoice',compact('alldata'));
    }
    //add Invoice interface method
    public function add()
    {   
        $data['vendor'] = Vendor::all();
        $data['product'] = Product::all();
        $data['category'] = Categories::all();
        $data['vendors'] = Vendor::all();
        $data['categ'] = Categories::all();
        $data['countries'] = Country::get(["name","id"]);
        $data['origins'] = Country::get(["name","id"]);
        $data['date'] = date('Y-m-d');
        $data['category'] = Categories::all();
        $data['customer'] = Customer::orderBy('id', 'DESC')->get();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if($invoice_data == null){
            $firstReg = '0';
            $data['sales_invoice_no']= $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->pluck('sales_invoice_no')->first();            
            $data['sales_invoice_no']= $invoice_data+1;
        }
        
        return view('backend.invoice.add-invoice',$data);
        }
        
    

    public function ajaxaddcustomer(Request $request) {

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->user_type = $request->user_type;
        $customer->organization_name = $request->organization_name;
        $customer->designation = $request->designation;
        $customer->gst_no = $request->gst_no;
        $customer->contact_no = $request->contact_no;
        $customer->alt_contact_no = $request->alt_contact_no;
        $customer->dob = date('y-m-d',strtotime($request->dob));
        $customer->gender = $request->gender;
        $customer->referred_by = $request->referred_by;
        $customer->customer_code = $request->customer_code;
        $customer->family_code = $request->family_code;
        $customer->password = $request->password;
        $customer->email_verified_at = $request->email_verified_at;
        $customer->notes = $request->notes;
        $customer->age = $request->age;
        $customer->family_group_code = $request->family_group_code;
        $customer->address = $request->address;
        $customer->city_id = $request->city_id;
        $customer->state_id = $request->state_id;
        $customer->country_id = $request->country_id;
        $customer->reference_by = $request->reference_by;
        $customer->remarks = $request->remarks;
        $customer->created_by = Auth::user()->id;

        DB::transaction(function () use($request,$customer) {
                    if($customer->save()){
                        $address = new Address();
                        $address->cust_id = $customer->id;
                        $address->first_name = $customer->first_name;
                        $address->last_name = $customer->last_name;
                        $address->contact_no = $customer->contact_no;
                        $address->address_line_1 = $request->address_line_1;
                        $address->address_line_2 = $request->address_line_2;
                        $address->country = $request->country;
                        $address->state = $request->state;
                        $address->city = $request->city;
                        $address->landmark = $request->landmark;
                        $address->pincode = $request->pincode;
                        $address->address_type = $request->address_type;
                        $address->created_by = Auth::user()->id;
                        $address->save();   
                    } 
                });         
        return response()->json(['success' => 'Customer details added successfully.']);
    }
    public function ajaxaddprescription(Request $request)
    {
         $prescription = new Prescription();
            $prescription->customer_id = $request->customer_id;
            $prescription->patient_name = $request->patient_name;
            $prescription->left_eye_sph = $request->left_eye_sph;
            $prescription->left_eye_cyl = $request->left_eye_cyl;
            $prescription->left_eye_axis = $request->left_eye_axis;
            $prescription->left_eye_add = $request->left_eye_add;
            $prescription->left_eye_va_dist = $request->left_eye_va_dist;
            $prescription->left_eye_va_near = $request->left_eye_va_near;
            $prescription->left_eye_pd = $request->left_eye_pd;
            $prescription->right_eye_sph = $request->right_eye_sph;
            $prescription->right_eye_cyl = $request->right_eye_cyl;
            $prescription->right_eye_axis = $request->right_eye_axis;
            $prescription->right_eye_add = $request->right_eye_add;
            $prescription->right_eye_va_dist = $request->right_eye_va_dist;
            $prescription->right_eye_va_near = $request->right_eye_va_near;
            $prescription->right_eye_pd = $request->right_eye_pd;
            $prescription->doctor_name = $request->doctor_name;
            $prescription->prescription_condition   = $request->prescription_condition;
            $prescription->status   = $request->status;
            $prescription->remarks   = $request->remarks;            
            $prescription->created_by = Auth::user()->id;
            $add_prescription = $prescription->save();

            if($add_prescription){
                return response()->json(['success' => 'Prescription added successfully.']);
            }
    }
    public function ajaxaddpayment(Request $request)
    {                       
                            $date =  date('Y-m-d'); 
                        $payment = new Payment();
                        $payment->sales_invoice_no = $request->sales_invoice_no;
                        $payment->customer_id = $request->customer_id;
                        $payment->payment_date =  date('Y-m-d', strtotime($date));
                        $payment->payment_type = $request->payment_type;
                        $payment->payment_modes = $request->payment_modes;
                        $payment->transaction_id = $request->transaction_id;
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount = $request->due_amount;
                        $payment->total_amount = $request->total_amount;
                        $payment->created_by = Auth::user()->id;
                        $payment->save();
                        if($payment->save()){
                return response()->json(['success' => 'Payment recorded successfully.']);
            }
    }
    public function ajaxupdateproduct(Request $request, $id)
    {
                $invoice_detail = InvoiceDetail::find($id);
                $invoice_detail->invoice_date = date('Y-m-d', strtotime($request->invoice_date));
                            $invoice_detail->sales_invoice_id = $request->sales_invoice_id;
                            $invoice_detail->category_id = $request->category_id;
                            $invoice_detail->barcode = $request->barcode;
                            $invoice_detail->product_name = $request->product_name;
                            $invoice_detail->unit_price = $request->unit_price;
                            $invoice_detail->sell_qty = $request->sell_qty;
                            $invoice_detail->price = $request->price;
                            $invoice_detail->cgst_perc = $request->cgst_perc;
                            $invoice_detail->cgst_amt = $request->cgst_amt;
                            $invoice_detail->sgst_perc = $request->sgst_perc;
                            $invoice_detail->sgst_amt = $request->sgst_amt;
                            $invoice_detail->price_excgst = $request->price_excgst;
                            $invoice_detail->discount_type = $request->discount_type;
                            $invoice_detail->discount_rate = $request->discount_rate;
                            $invoice_detail->discount_amt = $request->discount_amt;
                            $invoice_detail->sub_total = $request->sub_total;
                            $invoice_detail->total_product = $request->total_product;
                            $invoice_detail->du_date = $request->du_date;
                            $invoice_detail->status = '0';
                            $invoice_detail->created_by = $request->created_by;
                            $invoice_detail->save();

                            $notification=array(
                                    'message'=>'Invoice details Updated Successfully.',
                                    'alert-type'=>'success'
                                );

    }
    //store Invoice method
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
                $invoice = new Invoice();
                $invoice->store_id = Auth::user()->id;
                $invoice->sales_invoice_no = $request->sales_invoice_no;
                $invoice->sales_invoice_date = date('Y-m-d', strtotime($request->sales_invoice_date));
                $invoice->customer_id = $request->customer_id;
                $invoice->prescription_id = $request->prescription_id;
                $invoice->prescription_status = $request->prescription_status;
                $invoice->tax_status = $request->has('tax_status');
                $invoice->taxation_type = $request->taxation_type;
                $invoice->cgst_total = $request->cgst_total;
                $invoice->sgst_total = $request->sgst_total;
                $invoice->discount_total = $request->discount_total;
                $invoice->total_qty = $request->total_qty;
                $invoice->grand_total = $request->grand_total;
                $invoice->due_date = $request->due_date;
                $invoice->delivery_type = $request->delivery_type;
                $invoice->address_id = $request->address_id;
                $invoice->notes = $request->notes;
                $invoice->sales_invoice_status = $request->sales_invoice_status;
                $invoice->created_by = Auth::user()->id;
                

                DB::transaction(function () use($request,$invoice) {
                        if($invoice->save()) {
                            $count_category = count($request->category_id);
                        for($i=0; $i < $count_category; $i++)   {                    
                            $invoice_detail = new InvoiceDetail();
                            $invoice_detail->invoice_date = date('Y-m-d', strtotime($request->invoice_date[$i]));
                            $invoice_detail->sales_invoice_id = $request->sales_invoice_id[$i];
                            $invoice_detail->category_id = $request->category_id[$i];
                            $invoice_detail->barcode = $request->barcode[$i];
                            $invoice_detail->product_name = $request->product_name[$i];
                            $invoice_detail->unit_price = $request->unit_price[$i];
                            $invoice_detail->sell_qty = $request->sell_qty[$i];
                            $invoice_detail->price = $request->price[$i];
                            $invoice_detail->cgst_perc = $request->cgst_perc[$i];
                            $invoice_detail->cgst_amt = $request->cgst_amt[$i];
                            $invoice_detail->sgst_perc = $request->sgst_perc[$i];
                            $invoice_detail->sgst_amt = $request->sgst_amt[$i];
                            $invoice_detail->price_excgst = $request->price_excgst[$i];
                            $invoice_detail->discount_type = $request->discount_type[$i];
                            $invoice_detail->discount_rate = $request->discount_rate[$i];
                            $invoice_detail->discount_amt = $request->discount_amt[$i];
                            $invoice_detail->sub_total = $request->sub_total[$i];
                            $invoice_detail->total_product = $request->total_product[$i];
                            $invoice_detail->du_date = $request->du_date[$i];
                            $invoice_detail->status = '0';
                            $invoice_detail->created_by = $request->created_by[$i];
                            $product_req = DB::table('products')->where('product_model_no', '=',$invoice_detail->product_name)->first();
                            
                            if(!empty($product_req)){                    
                            $invstock = DB::table('stocks')
                                                ->where('product_id', '=', $product_req->id)
                                                ->where('quantity', '>', $invoice_detail->sell_qty)
                                                ->where('unit_price', '=', $invoice_detail->unit_price)
                                                ->first();                                               
                            if ($invstock) {
                                    $sales_qyt = $invoice_detail->sell_qty;
                                    $final_qty = $invstock->quantity - $sales_qyt;
                                    \DB::table('stocks')
                                                ->where('product_id', '=', $product_req->id)
                                                ->where('unit_price', '=', $invoice_detail->unit_price)
                                                ->update(['quantity' => $final_qty]);
                                    }
                             else {
                                    $rpurchase = new Repurchase();
                                    $rpurchase->product_name = $request->product_name[$i];
                                    $rpurchase->category_id = $request->category_id[$i];
                                    $rpurchase->quantity = $request->sell_qty[$i];
                                    $rpurchase->unit_price = $request->unit_price[$i];
                                    $rpurchase->status = '99';
                                    $rpurchase->created_by = Auth::user()->id;
                                    $rpurchase->save();
                                }
                            }
                            else
                            {
                                    $rpurchase = new Repurchase();
                                    $rpurchase->product_name = $request->product_name[$i];
                                    $rpurchase->category_id = $request->category_id[$i];
                                    $rpurchase->quantity = $request->sell_qty[$i];
                                    $rpurchase->unit_price = $request->unit_price[$i];
                                    $rpurchase->status = '99';
                                    $rpurchase->created_by = Auth::user()->id;
                                    $rpurchase->save();
                            }
                            $invoice_detail->save();
                        }
                        $payment = new Payment();
                        $payment->sales_invoice_no = $invoice->sales_invoice_no;
                        $payment->customer_id = $invoice->customer_id;
                        $payment->payment_date = $invoice->sales_invoice_date;
                        $payment->payment_type = $request->payment_type;
                        $payment->payment_modes = $request->payment_modes;
                        $payment->transaction_id = $request->transaction_id;
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount = $request->due_amount;
                        $payment->total_amount = $request->total_amount;
                        $payment->created_by = Auth::user()->id;
                        $payment->save();                        
                  
                   }
               });
        }
        
            
         $notification=array(
                'message'=>'Sales Invoice Added Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('invoice.view')->with($notification);
    }  
    
    public function edit($id)
    {
        $data['vendor'] = Vendor::all();
        $data['product'] = Product::all();
        $data['category'] = Categories::all();
        $data['vendors'] = Vendor::all();
        $data['categ'] = Categories::all();
        $data['countries'] = Country::get(["name","id"]);
        $data['origins'] = Country::get(["name","id"]);
        $data['category'] = Categories::all();
        $data['customers'] = Customer::orderBy('id', 'DESC')->get();
        $data['invoice'] = Invoice::find($id);


        return view('backend.invoice.edit-invoice',$data);
    }
    
    public function update(Request $request, $id)
    {
        
                $invoice = Invoice::find($id);
                $invoice->store_id = Auth::user()->id;
                $invoice->sales_invoice_no = $request->sales_invoice_no;
                $invoice->sales_invoice_date = date('Y-m-d', strtotime($request->sales_invoice_date));
                $invoice->customer_id = $request->customer_id;
                $invoice->prescription_id = $request->prescription_id;
                $invoice->prescription_status = $request->prescription_status;
                $invoice->tax_status = $request->has('tax_status');
                $invoice->taxation_type = $request->taxation_type;
                $invoice->cgst_total = $request->cgst_total;
                $invoice->sgst_total = $request->sgst_total;
                $invoice->discount_total = $request->discount_total;
                $invoice->total_qty = $request->total_qty;
                $invoice->grand_total = $request->grand_total;
                $invoice->due_date = $request->due_date;
                $invoice->delivery_type = $request->delivery_type;
                $invoice->address_id = $request->address_id;
                $invoice->notes = $request->notes;
                $invoice->sales_invoice_status = $request->sales_invoice_status;
                $invoice->created_by = Auth::user()->id;
                $invoice->save();
            
         $notification=array(
                'message'=>'Sales Invoice Updated Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('invoice.view')->with($notification);
    
    }
    //pending Invoice method
    public function PendingList()
    {
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.view-pending-list',compact('alldata'));
    }
    //approve Invoice method
    public function approve($id)
    {
        $invoice = Invoice::with(['invoice_details'])->find($id);
        return view('backend.invoice.invoice-approve',compact('invoice'));
    }
    public function approval_store(Request $request,$id)
    {
        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                $notification=array(
                    'message'=>'Sorry! The Requested Product is Out of Stock!',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function () use($request,$invoice,$id) {
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        $notification=array(
            'message'=>'Successfully Approved Invoice!',
            'alert-type'=>'success'
        );
        return redirect()->route('invoice.view')->with($notification);
    }
    //delete Invoice method
    public function delete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete(); 
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        
        $notification=array(
            'message'=>'Successfully Delete Invoice.',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function delete_approve($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete(); 
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        
        $notification=array(
            'message'=>'Successfully Cencle Invoice.',
            'alert-type'=>'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
    }
    //print invoice method
    public function printInvoice($id) {
        $data['invoice'] = Invoice::find($id);
        $customPaper = array(0,0,720,1440);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data,['format' => 'A5']);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Invoice.pdf');
    }

    public function printAdvanceReceipt($id) {
        $data['invoice'] = Invoice::find($id);
        $customPaper = array(0,0,720,1440);
        $pdf = PDF::loadView('backend.pdf.advance-receipt', $data,['format' => 'A5']);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Advacne-Receipt.pdf');
    }
    //print daily invoice report
    public function dailyReport()
    {
        return view('backend.invoice.daily-invoice-report');
    }
    //daily report pdf genared
    public function dailyReportPdf(Request $request)
    {
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['alldata'] = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));

        $pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('dailyInvoice.pdf');
    }
}
