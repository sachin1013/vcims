<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Address;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use Auth;
use DB;
use PDF;

class CustomerController extends Controller
{
    //view customer method
    public function view ()
    {
        $alldate = DB::table('customers')->paginate(10);
        return view('backend.customer.view-customer',compact('alldate'));
    }

    public function viewProfile ($id)
    {
        $data['customer'] = Customer::find($id);
        $data['precscriptions'] = DB::table('prescriptions')->where('customer_id', $id)->get();
        $data['invoices'] = DB::table('invoices')->where('customer_id', $id)->get();
        return view('backend.customer.customer-profile', $data);
    }


    //add customer interface method
    public function add()
    {   
        $data['countries'] = Country::get(["name","id"]);
        return view('backend.customer.add-customer', $data);
    }

    public function getState(Request $request)
    {
        $dataStates['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($dataStates);
    }
    public function getCity(Request $request)
    {
        $dataCities['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($dataCities);
    }

    //store customer method
    public function store(Request $request)
    {
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
        $customer->notes = $request->notes;
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

            $notification=array(
                'message'=>'Customer details added successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.view')->with($notification);
        
    }
    //edit customer method
    public function edit($id)
    {
        $data['customer'] = Customer::find($id);
        $data['countries'] = Country::get(["name","id"]);
        return view('backend.customer.edit-customer', $data);
    }
    //update customer method
    public function update (Request $request,$id)
    {
        $customer = Customer::find($id);       
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
        $customer->notes = $request->notes;
        $customer->updated_by = Auth::user()->id;
        DB::transaction(function () use($request,$customer) {
            
                    if($customer->save()){   
                        $address = Address::where('cust_id', $customer->id)->first();  
                        if(!empty($address)) {
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
                        $address->updated_by = Auth::user()->id;
                        $address->save();   
                        }
                    } 
                });     
  
            
                $notification=array(
                        'message'=>'Customer details updated successfully.',
                        'alert-type'=>'success'
                    );
                    return redirect()->route('customers.view')->with($notification);
                
/*
                else{
                    $notification=array(
                        'message'=>'Something went worng!',
                        'alert-type'=>'error'
                    );
                    //return Redirect()->back()->with($notification);
                    return redirect()->route('customers.view')->with($notification);
                }


         $notification=array(
                'message'=>'Customer details updated successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.view')->with($notification);
        */
        }

    //delete customer method
    public function delete($id)
    {
        $customer = Customer::find($id);
        $del = $customer->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Customer',
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
    //view credit cutomer
    public function creditCustomer()
    {
        $alldate = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        return view('backend.customer.credit-customer',compact('alldate'));
    }
    public function creditCustomerpdf()
    {
        $data['alldata'] = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        $pdf = PDF::loadView('backend.pdf.credit-customer-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('CreditCustomer.pdf');
    }
    //edit invoice method
    public function editinvoice($invoice_id)
    {
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $data['date'] = date('Y-m-d');
        return view('backend.customer.edit-invoice',$data);
    }
    //update invoice method
    public function updateinvoice(Request $request,$invoice_id)
    {
        if($request->new_paid_amount < $request->paid_amount){
            $notification=array(
                'message'=>'Sorry! Paid Amount is Greater Then Due Amount!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->back()->with($notification);
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date)) ;
            $payment_details->save();
            $notification=array(
                'message'=>'Successfully Update Invoice!',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.paid')->with($notification);

        }
    }
    //invoice details invoice method
    public function detailsInvoice($invoice_id)
    {
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Details_invoice.pdf');
    }
    //paid customer list
    public function paidCustomer()
    {
        $alldate = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.customer.paid-customer',compact('alldate'));
    }
    public function paidCustomerpdf()
    {
        $data['alldata'] = Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.pdf.paid-customer-pdf', $data); 
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('PaidCustomer.pdf');
    }

}
