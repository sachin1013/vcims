@extends('backend.layouts.master')
@section('content')
  
<div id="layoutSidenav_content">
  <main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Sales </span>
                    <small class="d-sm-block"><a href="{{ route('invoice.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Sales List</a></small>
                </div>
                <div class="card-body">
                     <form action="{{ route('invoice.update', $invoice->id) }}" method="post" id="Product_form">
                        @csrf 
                        <div class="form-row">
                          
                          <div class="form-group col-md-4">
                              <label>Customer Name</label><!--<button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openCustomerModal" id="open"> Add new Customer</button>--> <br/>
                              <select name="customer_id" id="customer_id" class="form-control col-md-12">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                  <option value="{{ $customer->id }}" @if($invoice->customer_id == $customer->id) selected="selected" @endif>{{ $customer->first_name}} {{ $customer->last_name}} ({{ $customer->contact_no}} - {{$customer->family_code }})</option>
                                @endforeach
                                
                              </select>
                            



                            </div>
                            
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                
                               
                                  
                                  
                              </div>
                            </div>

                            <input type="hidden" value="" name="prescription_id" id="prescription_id" class="form-control form-control text-right prescription_id">
                            <input type="hidden" value="" name="prescription_status" id="prescription_status" class="form-control form-control text-right prescription_status">
                          
                            <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="invoice_no">Invoice No</label>
                                <input type="text" value="{{ $invoice->sales_invoice_no }}" class="form-control" name="sales_invoice_no" id="sales_invoice_no" readonly>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="date">Date</label>
                              <input type="date" class="form-control datepicker" name="sales_invoice_date" id="sales_invoice_date" value="{{ $invoice->sales_invoice_date }}">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="category_id">Choose Category</label>
                                <select class="form-control" id="category_id" value="">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                            
                            <!--<div class="form-group col-md-4">
                              <label for="product_id">Product Name </label>OR  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openProductModal" id="open">Add new Product</button> 
                              <select class="form-control select2" name="product_id" id="product_id" value="">
                                  <option value="">Select Category First</option>
                              </select>

                              
                            </div>

                            <div class="form-group col-md-2">
                                <label for="stock">Stock (pcs) </label>
                                <input type="text" class="form-control pur" name="stock" id="stock" readonly>
                            </div>
                            -->
                            <div class="form-group col-md-2 col align-self-center">
                              <input type="hidden" value="true" name="tax_status" id="tax_status" class="form-control text-right tax_status">
                                
                            </div>

                            <div class="form-group col-md-2" id="taxation_check" style="display:none">
                              <input type="hidden" value="Inclusive Taxes" name="taxation_type" id="taxation_type" class="form-control text-right taxation_type">
                            </div>

                            <div class="form-group col-md-2" style="padding-top: 30px">
                              <a class=" text-white btn btn-success addeventmore"><i class="fas fa-plus-circle mr-1"></i>Add Product</a>
                            </div>
                        </div>
                    
                </div>
                <div class="card-body">
                    
                      <table class="table-sm table-bordered" width="100%">
                              <thead>
                                <tr>
                                  <th>Category</th>
                                  <th>Barcode</th>
                                  <th>Product Name</th>
                                  <th>Qty.</th>
                                  <th>Unit Price</th> 
                                  <th>Discount Type</th>
                                  <th>Discount Amt.</th>                                   
                                  <th>Sub. Total</th>                         
                                  <th>CGST Rate</th>
                                  <th>CGST Amt.</th>
                                  <th>SGST Rate</th>
                                  <th>SGST Amt.</th>                                 
                                  <th>Total Price</th>
                                  <th width="10%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $details = DB::table('invoice_details')->where('sales_invoice_id', $invoice->sales_invoice_no)->get();?>
                                  
                                  @if(count($details) >= 1)
                                      @foreach($details as $detail)
                                        <tr>
                                            <?php $category = DB::table('categories')->where('id', $detail->category_id)->first(); ?>
                                              <td>{{ $category->name }}</td>
                                              <td>{{ $detail->barcode }}</td>
                                              <td>{{ $detail->product_name }}</td>
                                              <td>{{ $detail->sell_qty }}</td>
                                              <td>{{ $detail->unit_price }}</td> 
                                              <td>{{ $detail->discount_type }} - {{ $detail->discount_rate }}</td>
                                              <td>{{ $detail->discount_amt }}</td>                                   
                                              <td>{{ $detail->sub_total }}</td>                         
                                              <td>{{ $detail->cgst_perc }}</td>
                                              <td>{{ $detail->cgst_amt }}</td>
                                              <td>{{ $detail->sgst_perc }}</td>
                                              <td>{{ $detail->cgst_amt }}</td>                                 
                                              <td>{{ $detail->total_product }}</td>
                                              <td>
                                                  <a class="btn btn-primary btn-sm rounded-7" data-toggle="modal" data-target="#editprodModal-{{$detail->id}}" id="open"><i class="fa fa-edit"></i></a>&nbsp;
<form method="post" action="/ajaxupdateproduct/{{$detail->id}}" id="ajaxupdateproduct">
                                                           @csrf

                                      <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="editprodModal-{{$detail->id}}">
                                                          <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                              <div class="alert alert-danger" style="display:none"></div>
                                                              <div class="modal-header">
                                                                 <h5 class="modal-title">Edit Product Detail</h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <div class="form-row">    
    <table>
      <tr>
      <th>Category</th>
      <th>Barcode</th>
      <th>Product Name</th>
      <th>Qty</th>
      <th>Unit Price</th>
      <th>Discount</th>
      <th>Discount Amt.</th>
      <th>Sub Total</th>
      <th>CGST Perc.</th>
      <th>CGST Amt.</th>
      <th>SGST Perc.</th>
      <th>SGST Amt.</th>
      <th>Total</th>
    </tr>
      <tr>
        <input type="hidden" name="invoice_date" id="invoice_date" value="{{ $detail->invoice_date }}">
    <input type="hidden" name="sales_invoice_id" id="sales_invoice_id" value="{{ $detail->sales_invoice_id }}">

    <td>
      <input type="hidden" name="category_id" id="category_id" value="{{ $detail->category_id }}">
      <?php $category = Db::table('categories')->where('id', $detail->category_id)->first()?>
      {{ $category->name }}
    </td>
    <td>
      <input type="text" class="form-control form-control-sm barcode" id="barcode" name="barcode" value="{{ $detail->barcode }}">      
    </td>
    <td>
      <input type="text" class="form-control form-control-sm product_name" id="product_name" name="product_name" value="{{ $detail->product_name }}">      
    </td>
   
    <td>
      <input type="text" class="form-control form-control-sm text-right sell_qty" id="sell_qty" name="sell_qty" value="{{ $detail->sell_qty }}">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right unit_price" id="unit_price" name="unit_price" value="{{ $detail->unit_price }}">
    </td>
    <input type="hidden" name="price" id="price" class="price" value="">
   <td>
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <input type="text" class="form-control form-control-sm text-right discount_rate" id="discount_rate" name="discount_rate" value="{{ $detail->discount_rate }}">
        <div class="btn-group" role="group">
          <select class="form-control" id="discount_type" id="discount_type" name="discount_type" style="padding:0px 3px; font-size:12px;">
              <option value="None">Choose</option>
              <option value="None" @if($detail->discount_type == "None") selected="selected" @endif>None</option>
              <option value="Fixed Amount" @if($detail->discount_type == "Fixed Amount") selected="selected" @endif>Fixed</option>
              <option value="Percentage Discount" @if($detail->discount_type == "Percentage Discount") selected="selected" @endif>Percentage</option>
            </select>

        </div>
      </div>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right discount_amt" id="discount_amt" name="discount_amt" value="{{ $detail->discount_amt }}">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sub_total" id="sub_total" name="sub_total" readonly value="{{ $detail->sub_total }}">
    </td>
    <td>
      <input type="hidden"  class="tax_status" id="tax_status" value="{{ $invoice->tax_status }}">
      <input type="hidden"  class="taxation_type" id="taxation_type" value="{{ $invoice->taxation_type }}">
      <input type="hidden"  class="price_excgst" id="price_excgst" name="price_excgst" value="{{ $detail->price_excgst }}">
      <input type="text" class="form-control form-control-sm text-right cgst_perc" id="cgst_perc" name="cgst_perc" value="{{ $detail->cgst_perc }}" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right cgst_amt" id="cgst_amt" name="cgst_amt" readonly value="{{ $detail->cgst_amt }}">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sgst_perc" id="sgst_perc" name="sgst_perc" value="{{ $detail->sgst_perc }}" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sgst_amt" id="sgst_amt" name="sgst_amt" value="{{ $detail->sgst_amt }}" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right total_product" id="total_product" name="total_product" value="{{ $detail->total_product }}" readonly>
      <input  name="created_by" type="hidden" value="{{ Auth::user()->id }}" id="created_by" class="form-control form-control-sm text-right created_by">
      <input type="hidden" class="form-control datepicker" name="du_date" id="du_date" placeholder="yyyy-mm-dd">
    </td>
      
      </tr>
    </table>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button  class="btn btn-primary" id="ajaxCustomerSubmit" type="submit">Save changes</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
 </form>

                                                  <a class="btn btn-danger btn-sm rounded-7"><i class="fa fa-trash"></i></a>
                                            </td>
                                            </tr>
                                        @endforeach
                                  @endif
                              </tbody>
                              <tbody id="addRow" class="addRow">

                              </tbody>
                              <tbody>
                                <tr>
                                  <td colspan="11"></td>
                                  <td>Total Discount</td>
                                  <td>
                                    <input type="text" name="discount_total" value="{{$invoice->discount_total}}" id="discount_total" class="form-control form-control-sm text-right discount_total">
                                    <input type="hidden" name="cgst_total" value="{{$invoice->cgst_total}}" id="cgst_total" class="form-control form-control-sm text-right cgst_total">
                                    <input type="hidden" name="sgst_total" value="{{$invoice->sgst_total}}" id="sgst_total" class="form-control form-control-sm text-right sgst_total">
                                    <input type="hidden" name="total_qty" value="{{$invoice->total_qty}}" id="total_qty" class="form-control form-control-sm text-right total_qty">
                                    <input type="hidden" name="store_id" value="{{ Auth::user()->id }}" id="store_id" class="form-control form-control-sm text-right store_id">
                                  </td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="11"></td>
                                  <td>Grand Total</td>
                                  <td>
                                    <input type="text" name="grand_total" value="{{$invoice->grand_total}}" id="grand_total" class="form-control form-control-sm text-right grand_total" readonly>
                                  </td>
                                  <td></td>
                                </tr>
                              </tbody>
                          </table>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <textarea name="description" class="form-control mt-2" id="description" placeholder="Description Write Here..">{{ $invoice->description }}</textarea>
                        </div>
                      </div>
                        <div class="form-row">
                            <h5 style="width:100%;">Payment Summery</h5>
                            <?php $payments = DB::table('payments')->where('sales_invoice_no', $invoice->sales_invoice_no)->get(); 
                                $total = 0;
                                $pending_amt = 0;
                            ?>
                            @if(empty($payments))
                            <div class="alert alert-warning" >
                              No payments found !!!
                            </div>
                            @else
                                
                                <table class="table-sm table-bordered" width="100%">
                                  <thead>
                                    <tr>
                                        <th>Invoice No.</th>
                                      <th>Date</th>
                                      <th>Payment mode</th>
                                      <th>Paid Amt.</th>
                                      <th>Transaction id</th> 
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($payments as $payment)
                                    <tr>
                                      <td>{{ $payment->sales_invoice_no }}</td>
                                      <td>{{ $payment->payment_date }}</td>
                                      <td>{{ $payment->payment_modes }}</td>
                                      <td>{{ $payment->paid_amount }}</td>
                                      <td>{{ $payment->transaction_id }}</td> 
                                      <!--<td>
                                          <button class="btn btn-primary btn-sm rounded-0 editeventmore"><i class="fa fa-edit"></i></button>&nbsp;
                                          <button class="btn btn-danger btn-sm rounded-0 removeeventmore"><i class="fa fa-trash"></i></button>
                                      </td>-->
                                    </tr>
                                    <?php 
                                  $paid_amt =  $payment->paid_amount;
                                  $total = $total + $paid_amt;
                                  $g_total  = $invoice->grand_total;
                                  if($g_total >= $total)
                                  {  $pending_amt = $g_total - $total; }
                                ?>
                                @endforeach
                                </tbody>
                                </table>
                                
                            @endif

                        </div><br>
                        <div class="form-row">
                          
                             @if($pending_amt > 0)                

                             <h5>Amount to be Paid : {{ $pending_amt }}</h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#openPaymentModal" id="open"> Add/Record New Payment</button>

                            
                            @else
                            <div class="alert alert-info">
                              <strong>This invoice is fully paid.</strong>
                            </div>

                            @endif
                            
                        </div><br><br>
                        <!--<div class="form-row">
                            <div class="form-group col-md-2">
                              <?php $payment = DB::table('payments')->where('sales_invoice_no', $invoice->sales_invoice_no)->first(); ?>
                              
                              <label for="payment_type">Paid Status</label>
                              <select name="payment_type" id="payment_type" class="form-control">
                                  <option value="Full Paid" @if($payment->payment_type == "Full Paid") selected="selected" @endif>Full Paid</option>
                                  <option value="Full Due" @if($payment->payment_type == "Full Due") selected="selected" @endif>Full Due</option>
                                  <option value="Partial Paid" @if($payment->payment_type == "Partial Paid") selected="selected" @endif>Partial Paid</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="payment_modes">Payment Modes</label>
                              <select name="payment_modes" id="payment_modes" class="form-control">
                                  <option value="Debit/Credit Card" @if($payment->payment_modes == "Debit/Credit Card") selected="selected" @endif>Debit/Credit Card</option>
                                  <option value="UPI" @if($payment->payment_modes == "UPI") selected="selected" @endif>UPI</option>
                                  <option value="Net Banking" @if($payment->payment_modes == "Net Banking") selected="selected" @endif>Net banking</option>
                                  <option value="Cash" @if($payment->payment_modes == "Cash") selected="selected" @endif>Cash</option>
                                  <option value="Pay On Delivery" @if($payment->payment_modes == "Pay On Delivery") selected="selected" @endif>Pay On Delivery</option>
                              </select>
                            </div>
                            
                            <div class="form-group col-md-2">
                              <label for="paid_amount">Amount To be Paid</label>
                              <input type="text" name="paid_amount" id="paid_amount" value= "{{ $payment->paid_amount }}" class="form-control form-control text-right paid_amount">
                            </div>
                            <div class="form-group col-md-3" id ="transact_div" style="display:none">
                              <label for="transaction_id">Transaction Id</label>
                              <input type="text" name="transaction_id" id="transaction_id" value= "{{ $payment->transaction_id }}" class="form-control form-control transaction_id" >
                            </div>
                            <input type="hidden" name="due_amount" id="due_amount" class="form-control form-control text-right due_amount">
                            
                            <div class="form-group col-md-2">
                                        <label for="due_date">Due Date</label>
                                        <input type="text" class="form-control datepicker" value= "{{ $invoice->due_date }}" name="due_date" id="due_date">
                                       </div> 
                        </div>-->
                          <div class="form-row">
                            
                              <div class="form-group col-md-2">
                                  <label for="sales_invoice_status">Invoice Status</label>
                                  <select name="sales_invoice_status" id="sales_invoice_status" class="form-control">
                                      
                                      <option value="1" @if($invoice->sales_invoice_status == "1") selected="selected" @endif>Active</option>
                                      <option value="0" @if($invoice->sales_invoice_status == "0") selected="selected" @endif>Draft</option>
                                      <option value="2" @if($invoice->sales_invoice_status == "2") selected="selected" @endif>Delivered</option>
                                      <option value="3" @if($invoice->sales_invoice_status == "3") selected="selected" @endif>Cancelled / Deleted (Soft) </option>
                                      <option value="4" @if($invoice->sales_invoice_status == "4") selected="selected" @endif>Returned</option>

                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="due_date">Delivery Date</label>
                                  <input type="date" class="form-control datepicker" value="{{ $invoice->due_date }}" name="due_date" id="due_date">
                              </div>
                          </div>


                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Update Sales Invoice</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        

        <form method="post" action="{{ route('invoice.ajaxaddprescription') }}" id="ajaxaddprescription">
                                     @csrf

                                <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openPrescriptionModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-header">
                                           <h5 class="modal-title">Add New Prescription</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                              <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="customer">Customer Name</label>

                                                    <input type="text" class="form-control" name="customer_id" id="customer" readonly>
                                                   
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="patient_name">Prescribed For</label>
                                                    <input type="text" class="form-control" name="patient_name" id="patient_name">
                                                </div>
                                            </div>
                                           <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="12%"></th>
                                    <th width="12%">Sph.</th>
                                    <th width="12%">Cyl.</th>
                                    <th width="12%">Axis</th>
                                    <th width="12%">Add.</th>
                                    <th width="12%">Distance Vision</th>
                                    <th width="12%">Near Vision</th>
                                    <th width="12%">PD</th>
                                </tr>

                                <tr>
                                    <td><strong>Right Eye</strong></td>
                                    <td><input type="text" class="form-control" name="right_eye_sph" id="right_eye_sph"></td>
                                    <td><input type="text" class="form-control" name="right_eye_cyl" id="right_eye_cyl"></td>
                                    <td><select class="form-control" name="right_eye_axis" id="right_eye_axis">
                                                <option value=""></option>
                                                @for ($i = 1; $i <= 180; $i++){
                                                <option value="{{ $i }}">{{ $i }}</option>}
                                                @endfor
                                            </select>
                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_add" id="right_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_dist" id="right_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60">6/60</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/18P">6/18P</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/12P">6/12P</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/9P">6/9P</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/6P">6/6P</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/5">6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_near" id="right_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N10P">N10P</option>
                                            <option value="N8">N8</option>
                                            <option value="N8P">N8P</option>
                                            <option value="N6">N6</option>
                                            <option value="N6P">N6P</option>
                                            <option value="N5">N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_pd" id="right_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Left Eye</strong></td>
                                    <td><input type="text" class="form-control" name="left_eye_sph" id="left_eye_sph"></td>
                                    <td><input type="text" class="form-control" name="left_eye_cyl" id="left_eye_cyl"></td>
                                    <td><select class="form-control col-md-12" name="left_eye_axis" id="left_eye_axis">
                                            <option value=""></option>
                                            @for ($i = 1; $i <= 180; $i++){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_add" id="left_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_dist" id="left_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60">6/60</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/18P">6/18P</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/12P">6/12P</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/9P">6/9P</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/6P">6/6P</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/5">6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_near" id="left_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N10P">N10P</option>
                                            <option value="N8">N8</option>
                                            <option value="N8P">N8P</option>
                                            <option value="N6">N6</option>
                                            <option value="N6P">N6P</option>
                                            <option value="N5">N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_pd" id="left_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    
                                </tr>
                            </thead>
                        </table>

                                             
                                            <br>    
                                            <h5><strong>Other information</strong></h5><br>
                                            <div class="form-row">
                                                
                                                 <div class="form-group col-md-4">
                                                    <label for="doctor_name">Prescribed By</label>
                                                    <input type="text" class="form-control" name="doctor_name" id="doctor_name">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="prescription_condition">Prescription Condition</label>
                                                    <select class="form-control" name="prescription_condition" id="prescription_condition">
                                                        <option value="">Select Prescription Condition</option>
                                                        <option value="normal">Normal</option>
                                                        <option value="severe">Severe</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="status">Prescription Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Select Prescription Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="expired">expired</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                 <div class="form-group col-md-12">
                                                    <label for="remarks">Remarks</label>
                                                   <textarea rows = "3" class="form-control" name="remarks" id="remarks"> </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button  class="btn btn-primary" id="ajaxVendorSubmit" type="submit">Save changes</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </form>


                            <form method="post" action="{{ route('invoice.ajaxaddcustomer') }}" id="ajaxaddcustomer">
                                     @csrf

                                <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openCustomerModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-header">
                                           <h5 class="modal-title">Add New Customer</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                     
                           <div class="form-group col-md-4">
                                  <label for="first_name">First Name</label>
                                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="">
                                </div>
                                <div class=" form-group col-md-4">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user_type">Customer Type</label><br>
                                    <select class="form-control form-control-sm" name="user_type" id="user_type">
                                        <option value="B2C">B2C</option>
                                        <option value="B2B">B2B</option>                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="organization_name">Organization </label>
                                    <input type="text" class="form-control" name="organization_name" id="organization_name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="designation">Designation </label>
                                    <input type="text" class="form-control" name="designation" id="designation">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gst_no">GSTIN (if applicable) </label>
                                    <input type="text" class="form-control" name="gst_no" id="gst_no">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="contact_no">Mobile No. </label>
                                  <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="alt_contact_no">Alternate Contact No. </label>
                                  <input type="text" class="form-control" name="alt_contact_no" id="alt_contact_no" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control datepicker" name="dob" id="dob">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="gender">Gender</label><br>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                              <div class="form-group col-md-4">
                                   <label for="customer_code">Customer Code </label><br>
                                    <select class="form-control" name="customer_code" id="customer_code">
                                        <option value="Bronze">Bronze [Upto &#x20B9;1200]</option>
                                        <option value="Silver">Silver [&#x20B9;1200 - &#x20B9;2499]</option>
                                        <option value="Gold">Gold [&#x20B9;2500 - &#x20B9;4000]</option>
                                        <option value="Platinum">Platinum[Above &#x20B9;4000]</option>
                                        <option value="VVIP">VVIP</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                   <label for="referred_by">Referred By </label>
                                  <input type="text" class="form-control" name="referred_by" id="referred_by" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                   <label for="family_code">Family Code </label>
                                  <input type="text" class="form-control" name="family_code" id="family_code" placeholder="">
                                </div>
                                  <input type="hidden" class="form-control" name="password" id="password" value="$2y$10$FhosaSZi/OUXWK2hVVVfKuLo3aF5bvIXVgzHoqpW/1S/XOCiak7c2" placeholder="">
                                <div class="form-group col-md-4">
                                   <label for="notes">Notes </label>
                                   <textarea rows = "3" class="form-control" name="notes" id="notes"> </textarea>
                                </div>

                              </div>
                              <div class="form-row" id="addressBlock">
                                <h3>Address</h3>
                                  <div class="form-row">                                     
                                         <div class="form-group col-md-6">
                                            <label for="address_line_1">Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Apartment No., Floor, Building Name">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="address_line_2">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Street name, Locality">
                                          </div>
                                          
                                          <div class="form-group col-md-4">
                                               <label for="country">Country</label><br>                                         
                                              <select class="form-control" name="country" id="country-dropdown">
                                                 <option value="">Select Country</option>
                                                 @foreach ($countries as $country) 
                                                  <option value="{{$country->id}}">
                                                  {{$country->name}}
                                                </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          
                                          <div class="form-group col-md-4">
                                               <label for="state">State</label><br>
                                                <select class="form-control" name="state" id="state-dropdown">
                                              </select>                                            
                                            </div>
                                           
                                           <div class="form-group col-md-4">
                                               <label for="city">City</label><br>
                                              <select class="form-control" name="city" id="city-dropdown">
                                              </select>
                                          </div>
                                        

                                           <div class="form-group col-md-4">
                                               <label for="landmark">Landmark</label>
                                              <input type="text" class="form-control" name="landmark" id="landmark">
                                          </div>
                                           <div class="form-group col-md-4">
                                               <label for="pincode">Pincode</label>
                                              <input type="text" class="form-control" name="pincode" id="pincode">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="address_type">Address Type</label><br>
                                              <select class="form-control" name="address_type" id="address_type">
                                                  <option value="Home">Home </option>
                                                  <option value="Office/Commercial">Office / Commercial </option>                 
                                              </select>
                                          </div>
                                  </div>
                              </div>

                             <!-- <div class="form-group">
                                <button type="button" name="add" id="addAddress" class="btn btn-success">Add More Addresses</button>
                              </div>
                        -->
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button  class="btn btn-primary" id="ajaxCustomerSubmit" type="submit">Save changes</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
  </form>

  <form method="post" action="{{ route('invoice.ajaxaddpayment') }}" id="ajaxaddpayment">
                                                         @csrf

                                                    <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openPaymentModal">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                          <div class="modal-content">
                                                            <div class="alert alert-danger" style="display:none"></div>
                                                            <div class="modal-header">
                                                               <h5 class="modal-title">Add / Record New Payment</h5>
                                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                           <div class="modal-body">
                                                            
                                                              <h5>Amount to be Paid : <span id="pend_total">{{ $pending_amt }}</span></h5>
                                                               <br>
                                                               <div class="form-row">
                                                                   <div class="form-group col-lg-8">
                                                                        <input type="hidden" name="sales_invoice_no" value="{{ $invoice->sales_invoice_no }}" id="sales_invoice_no" class="form-control form-control-sm text-right sales_invoice_no">

                                                                         <input type="hidden" name="customer_id" value="{{ $invoice->customer_id }}" id="customer_id" class="form-control form-control-sm text-right customer_id">

                                                                        <label for="payment_type">Paid Status</label>
                                                                        <select name="payment_type" id="payment_type" class="form-control">
                                                                            <option value="">Select Status</option>
                                                                            <option value="Full Paid">Full Paid</option>
                                                                            <option value="Partial Paid">Partial Paid</option>
                                                                        </select>
                                                                      </div>
                                                                      <div class="form-group col-lg-8">
                                                                        <label for="payment_modes">Payment Modes</label>
                                                                        <select name="payment_modes" id="payment_modes" class="form-control">
                                                                            <option value="">Select Status</option>
                                                                            <option value="Debit/Credit Card">Debit/Credit Card</option>
                                                                            <option value="UPI">UPI</option>
                                                                            <option value="Net Banking">Net banking</option>
                                                                            <option value="Cash">Cash</option>
                                                                            <option value="Pay On Delivery">Pay On Delivery</option>
                                                                        </select>
                                                                      </div>
                                                                      
                                                                      <div class="form-group col-md-8">
                                                                        <label for="paid_amount">Amount To be Paid</label>
                                                                        <input type="text"  name="paid_amount" id="paid_amount" class="form-control form-control text-right paid_amount">
                                                                      </div>
                                                                      <div class="form-group col-md-8" id ="transact_div" style="display:none">
                                                                        <label for="transaction_id">Transaction Id</label>
                                                                        <input type="text" name="transaction_id" id="transaction_id" class="form-control form-control transaction_id" >
                                                                      </div>

                                                               </div>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                              <button  class="btn btn-primary" id="ajaxpaymentSubmit" type="submit">Save changes</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                            </form>
    </main>
  <footer class="py-4 bg-light mt-auto">
    <!--<div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; Your Website 2019</div>
        <div>
          <a href="#">Privacy Policy</a>
          &middot;
          <a href="#">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>-->
  </footer>
</div>
<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
     <input type="hidden" name="invoice_date[]" value="@{{ invoice_date }}">
    <input type="hidden" name="sales_invoice_id[]" value="@{{ sales_invoice_id }}">

    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="text" class="form-control form-control-sm barcode" name="barcode[]">      
    </td>
    <td>
      <input type="text" class="form-control form-control-sm product_name" name="product_name[]">      
    </td>
   
    <td>
      <input type="text" class="form-control form-control-sm text-right sell_qty" name="sell_qty[]">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right unit_price" name="unit_price[]">
    </td>
    <input type="hidden" name="price[]" class="price" value="">
   <td>
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <input type="text" class="form-control form-control-sm text-right discount_rate" name="discount_rate[]">
        <div class="btn-group" role="group">
          <select class="form-control" id="discount_type" name="discount_type[]" style="padding:0px 3px; font-size:12px;">
              <option value="None">Choose</option>
              <option value="None">None</option>
              <option value="Fixed Amount">Fixed</option>
              <option value="Percentage Discount">Percentage</option>
            </select>

        </div>
      </div>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right discount_amt" name="discount_amt[]">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sub_total" name="sub_total[]" readonly>
    </td>
    <td>
      <input type="hidden"  class="tax_status" value="@{{ tax_status }}">
      <input type="hidden"  class="taxation_type" value="@{{ taxation_type }}">
      <input type="hidden"  class="price_excgst" name="price_excgst[]">
      <input type="text" class="form-control form-control-sm text-right cgst_perc" name="cgst_perc[]" value="@{{ cgst_perc }}" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right cgst_amt" name="cgst_amt[]" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sgst_perc" name="sgst_perc[]" value="@{{ sgst_perc }}" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right sgst_amt" name="sgst_amt[]" readonly>
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right total_product" name="total_product[]" readonly>
      <input  name="created_by[]" type="hidden" value="{{ Auth::user()->id }}" class="form-control form-control-sm text-right created_by">
      <input type="hidden" class="form-control datepicker" name="du_date[]" id="du_date" placeholder="yyyy-mm-dd">
    </td>
      
    <td><button class="btn btn-danger btn-sm rounded-0 removeeventmore"><i class="fa fa-trash"></i></button></td>
  </tr>
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#customer_id').select2();
      $('#category_id').select2();
      $('#taxation_type').select2({ width:"100%",});
      $('#payment_type').select2();
      $('#payment_modes').select2();
      $('#right_eye_axis').select2({ width:"100%",});
      $('#right_eye_add').select2({ width:"100%",});
      $('#right_eye_va_dist').select2({ width:"100%",});
      $('#right_eye_va_near').select2({ width:"100%",});
      $('#right_eye_pd').select2({ width:"100%",});
      $('#left_eye_axis').select2({ width:"100%",});
      $('#left_eye_add').select2({ width:"100%",});
      $('#left_eye_va_dist').select2({ width:"100%",});
      $('#left_eye_va_near').select2({ width:"100%",});
      $('#left_eye_pd').select2({ width:"100%",});
      $('#prescription_condition').select2({ width:"100%",});
      $('#status').select2({ width:"100%",});
      $('#user_type').select2({ width:"100%",});
      $('#gender').select2({ width:"100%",});
      $('#customer_code').select2({ width:"100%",});
      $('#country-dropdown').select2({ width:"100%",});
      $('#state-dropdown').select2({ width:"100%",});
      $('#city-dropdown').select2({ width:"100%",});
      $('#address_type').select2({ width:"100%",});
      $('#sales_invoice_status').select2({ width:"100%",});
      
    $(document).on("click",".addeventmore",function(){
      
      var invoice_date = $('#sales_invoice_date').val();
      var sales_invoice_id = $('#sales_invoice_no').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var tax_status = $('#tax_status').val();
      var taxation_type = $('#taxation_type').val();
      
      var cgst_perc,sgst_perc;
      
      //alert(category_name);
      if(invoice_date==''){
        //$.notify("Date is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Sales date is Required");
        return false;
      }
      if(sales_invoice_id==''){
        // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Sales Invoice No. is Required");
        return false;
      }
      if(category_id==''){
        //$.notify("Category Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Category Name is Required");
        return false;
      }
      if(tax_status==''){
        //$.notify("Product Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Tax status is Required");
        return false;
      }


          $.ajax({
          url:"{{url('get-taxes-by-category')}}",
          type: "POST",
          data: {
          category_id: category_id,
          tax_status:tax_status,
          _token: '{{csrf_token()}}' 
          },
          dataType : 'json',
          success: function(result){

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
              invoice_date:invoice_date,
              sales_invoice_id:sales_invoice_id,
              category_id:category_id,
              category_name:category_name,
              tax_status:tax_status,
              taxation_type:taxation_type,
              cgst_perc:result.cgst_perc,
              sgst_perc:result.sgst_perc
            };
            var html = template(data);
            $("#addRow").append(html);          

          }
        });
      
    });
    $(document).on("click",".removeeventmore",function(){
      $(this).closest(".delete_add_more_item").remove();
      totalamountPrice();
    });
    $(document).on("keyup click",".unit_price,.sell_qty",function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var sell_qty = $(this).closest("tr").find("input.sell_qty").val();
      
      var total = unit_price * sell_qty;
      $(this).closest("tr").find("input.price").val(total);
      var price = $(this).closest("tr").find("input.price").val();
             
    });

         $(document).on("keyup click",".discount_rate",function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var sell_qty = $(this).closest("tr").find("input.sell_qty").val();
            if(sell_qty==''){
              // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
              toastr.error("Selling Quantity is Required");
              return false;
            }

                if(unit_price==''){
              //$.notify("Date is Required",{globalPosition:'top right',className: 'error'});
              toastr.error("Price per unit is Required");
              return false;
            }
            
         });
        $(document).on('change','#discount_type',function(){
            var discount_rate = $(this).closest("tr").find("input.discount_rate").val();
            if(discount_rate==''){
              // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
              toastr.error("Discount Rate is Required.");
              return false;
            }
            else{
            var opt = $(this).val();
            var predisctotal =  parseFloat($(this).closest("tr").find("input.price").val());
          // console.log(predisctotal);
            if(opt == "Fixed Amount" && discount_rate <= predisctotal) {                
                var discount_rate = $(this).closest("tr").find("input.discount_rate").val();
                var selling_price = parseFloat(predisctotal) - parseFloat(discount_rate);
                var disc = parseFloat(predisctotal) - parseFloat(selling_price);
                var disc_final = disc.toFixed(0);
                var sub_total = selling_price.toFixed(0);
                $(this).closest("tr").find("input.sub_total").val(sub_total);
                $(this).closest("tr").find("input.discount_amt").val(disc_final);
            }
            else
              if(opt == "Fixed Amount" && discount_rate > predisctotal) {
                toastr.error("Discount should be less than Sub total.");                
                return false;
              }

            else
              if(opt == "Percentage Discount" && discount_rate < 99) {
                var discount_rate =  $(this).closest("tr").find("input.discount_rate").val();
                var selling_price = parseFloat(predisctotal) - [(predisctotal*discount_rate)/100];
                var disc = parseFloat(predisctotal) - parseFloat(selling_price);
                var disc_final = disc.toFixed(0);
                var sub_total = selling_price.toFixed(0);
                $(this).closest("tr").find("input.sub_total").val(sub_total);
                $(this).closest("tr").find("input.discount_amt").val(disc_final);
              }
              else
              if(opt == "Percentage Discount" && discount_rate > 99) {
                toastr.error("Discount should be less than 99%.");
                return false;
              }
              else {
                var disc = 0.00;
                $(this).closest("tr").find("input.sub_total").val(predisctotal);
                $(this).closest("tr").find("input.discount_amt").val(disc);
              }
              

            }
        });

        $(document).on('keyup click','.sub_total',function(){
          var taxation_type = $(this).closest("tr").find("input.taxation_type").val();
          var tax_status = $(this).closest("tr").find("input.tax_status").val();
          var price = $(this).closest("tr").find("input.sub_total").val();
          var cgst_perc = $(this).closest("tr").find("input.cgst_perc").val();
          var sgst_perc = $(this).closest("tr").find("input.sgst_perc").val();

         
          if(tax_status == "true" && taxation_type == "Inclusive Taxes")  
            {        
              var cgst_temp = parseFloat(cgst_perc)+100;
              var sgst_temp = parseFloat(sgst_perc);
              var gst_val = price - [(price*100)/(cgst_temp+sgst_temp)];
              var cgst_val = gst_val/2;
              var sgst_val = gst_val/2;
              var cgst_final = cgst_val.toFixed(2);
              var sgst_final = sgst_val.toFixed(2);
               $(this).closest("tr").find("input.cgst_amt").val(cgst_final);
               $(this).closest("tr").find("input.sgst_amt").val(sgst_final);
               $(this).closest("tr").find("input.total_product").val(price);
            }
            else
              if(tax_status == "true" && taxation_type == "Exclusive Taxes")
              {
                cgst_val = (price*cgst_perc)/100;
                sgst_val = (price*sgst_perc)/100;
                cgst_final = cgst_val.toFixed(2);
                sgst_final = sgst_val.toFixed(2);
                var post_price = parseFloat(price) + parseFloat(cgst_final) + parseFloat(sgst_final);
                $(this).closest("tr").find("input.cgst_amt").val(cgst_final);
                $(this).closest("tr").find("input.sgst_amt").val(sgst_final);
                $(this).closest("tr").find("input.total_product").val(post_price);
                    } 
              else {
                cgst_val = 0.00;
                sgst_val = 0.00;
                cgst_perc = 0;
                sgst_perc = 0;
                cgst_final = cgst_val.toFixed(2);
                sgst_final = sgst_val.toFixed(2);
                $(this).closest("tr").find("input.cgst_perc").val(cgst_perc);
                $(this).closest("tr").find("input.sgst_perc").val(sgst_perc);
                $(this).closest("tr").find("input.cgst_amt").val(cgst_final);
                $(this).closest("tr").find("input.sgst_amt").val(sgst_final);
                $(this).closest("tr").find("input.sub_total").val(price);
              }
              totalamountPrice();
        });

    function totalamountPrice(){
      var sum = 0;
      var totdiscount = 0;
      var total_cgst = 0;
      var total_sgst = 0;
      var total_qty = 0;
      $(".total_product").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
          sum = Math.round(sum);
        }
      });
      $(".discount_amt").each(function(){
        var valuedisc = $(this).val();
        if(!isNaN(valuedisc) && valuedisc.length != 0){
          totdiscount += parseFloat(valuedisc);
        }
      });

      $(".cgst_amt").each(function(){
        var valuecgst = $(this).val();
        if(!isNaN(valuecgst) && valuecgst.length != 0){
          total_cgst += parseFloat(valuecgst);
        }
      });
      $(".sgst_amt").each(function(){
        var valuesgst = $(this).val();
        if(!isNaN(valuesgst) && valuesgst.length != 0){
          total_sgst += parseFloat(valuesgst);
        }
      });
      $(".sell_qty").each(function(){
        var valueqty = $(this).val();
        if(!isNaN(valueqty) && valueqty.length != 0){
          total_qty += parseFloat(valueqty);
        }
      });

      $("#cgst_total").val(total_cgst);
      $("#sgst_total").val(total_sgst);
      $("#total_qty").val(total_qty);
      $("#discount_total").val(totdiscount);
      $("#grand_total").val(sum);
      //console.log(total_cgst, total_sgst, total_qty);

    }
     
    $(document).on('change','#payment_type',function(){
          var pay_type = $(this).val();
          var total = $("#pend_total").html();
          console.log(total);
          if(pay_type == "Full Paid") {
              $("#paid_amount").val(total);
              $('#paid_amount').attr('readonly', true); 
          }
          else
          if(pay_type == "Full Due") {
            $('#paid_amount').val("");
            $('#paid_amount').attr('readonly', true); 
          }
          else
           {
            $('#paid_amount').attr('readonly', false);
            $('#paid_amount').val("");
          }
          

      });
      $(document).on('change','#payment_modes',function(){
            var pay_type = $('#payment_type').val();
            var pay_mode = $(this).val();
            if(pay_type == ""){
            toastr.error("Paid Status is required");
                return false;
            }
            if(pay_mode == "Debit/Credit Card" || pay_mode == "UPI" || pay_mode == "Net Banking") {
            $("#transact_div").show(500);
            }
            if(pay_mode == "Pay On Delivery" || pay_mode == "Cash") {
            $("#transact_div").hide(500);
            }
      });
      
      $(document).on("keyup click","#paid_amount",function(){
          var paid_amount = $(this).val();
          var total = $("#pend_total").html();
          console.log(total);
          if(paid_amount > total) {
            $("#ajaxpaymentSubmit").attr('disabled', 'disabled');
               toastr.error("Amount should be less than Pending Amount.");
               
              return false;
          }
          else {
            $("#ajaxpaymentSubmit").removeAttr('disabled');
          }

      });

      $(document).on('change','#prescr_id',function(){
          var prescription_id = $(this).val();
          var prescription_status = $('#status').text();
          
          $("#prescription_id").val(prescription_id);
          $("#prescription_status").val(prescription_status);
      });
  });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#delivery_type',function(){
          var delivery_type = $(this).val();
          if(delivery_type == "Home Delivery"){
              $("#getaddressesDiv").show(500);
          }else
          {
              $("#getaddressesDiv").hide(500);
          }
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#tax_status').change(function(){
        if($(this).val() == 1){
           $('#taxation_check').toggle("slow");
        }else{
             $('#taxation_check').toggle("slow");
        }
       });

    });
</script>
<script>
  $(document).ready(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      // alert(supplier_id);
      $.ajax({
        url:"{{route('get-product-invoice')}}",
        type:"GET",
        data:{category_id:category_id},
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'">'+v.product_modelno+'</option>';
          });
          $('#product_id').html(html);
        },
        
      });
    });
  });
</script>
<script type='text/javascript'>
     $(document).ready(function(){

        $(document).on('change','#customer_id',function(){

      var customer_id = $(this).val();
      if(customer_id =="") {
        toastr.error("Please select customer first");
                return false;
      }      
      else {
      $.ajax({
        url:"{{route('check-prescriptions')}}",
        type:"GET",
        data:{customer_id:customer_id},
        success:function(data) {
          var html = ' ';
          if(!$.trim(data)){            
          html += "<br><div class='alert alert-info' role='alert'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+"There are no prescriptions available"+"<button type='button' class='btn btn-link btn-sm' data-toggle='modal' data-customer="+customer_id+" data-target='#openPrescriptionModal' id='open'>"+" Click here to add New Prescription</button></div>";
          $('#prescriptions').html(html);

        } else{
          $.each(data,function(key,p){
            html +=  "<br><br><div class='card-body'><table class='table table-bordered table-condensed'><input class='form-check-input' type='radio' id= 'prescr_id' name='prescr_id'"+" value="+p.id+"><strong> Prescribed By : </strong>"+p.doctor_name+"<br><strong>Prescription Status : </strong>"+"<span id='status'>"+p.status+"</span><br><strong>Prescription condition : </strong>"+p.prescription_condition+"<tr><th>Rx</th><th>Sph.</th><th>Cyl.</th><th>Axis</th><th>Add.</th><th>Va_dist</th><th>Va_near</th><th>pd</th></tr><tr><td>Right</td><td>"+p.right_eye_sph+"</td><td>"+p.right_eye_cyl+"</td><td>"+p.right_eye_axis+"</td><td>"+p.right_eye_add+"</td><td>"+p.right_eye_va_dist+"</td><td>"+p.right_eye_va_near+"</td><td>"+p.right_eye_pd+"</td></tr><tr><td>Left</td><td>"+p.left_eye_sph+"</td><td>"+p.left_eye_cyl+"</td><td>"+p.left_eye_axis+"</td><td>"+p.left_eye_add+"</td><td>"+p.left_eye_va_dist+"</td><td>"+p.left_eye_va_near+"</td><td>"+p.left_eye_pd+"</td></tr></table></div><div class='alert alert-info' role='alert'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+"<button type='button' class='btn btn-link btn-sm' data-toggle='modal' data-customer="+p.customer_id+" data-target='#openPrescriptionModal' id='openPrescriptModal'>"+" Click here to add New Prescription</button></div>";
          });
            $('#prescriptions').html(html);
            
        }
      }
      });
    }
    });
  });
     </script>


  <script>
    $(document).ready(function () {
      $("#openPrescriptionModal").on("show.bs.modal", function (e) {
                    var id = $(e.relatedTarget).data('customer');
                    $('#customer').val(id);
                });
      $('#ajaxaddprescription').validate({
        ignore: [],
        rules: {
          customer_id: {
            required: true,
          },
          right_eye_axis: {
            number: true,
            },
          right_eye_add: {
            number: true,
            
           
          },
          right_eye_pd: {
            number: true,
          },
          left_eye_axis: {
            number: true,
          },
          left_eye_add: {
            number: true,
          },
          left_eye_pd: {
            number: true,
          },
          prescription_condition: {
            required: true,
          }
        },
        messages: {
        //   usertype: {
        //     required: "Please Select User Role",
        //   },
        //   name: {
        //     required: "Please Enter Name",
        //   },
        //   email: {
        //     required: "Please enter a email address",
        //     email: "Please enter a vaild email address"
        //   },
        //   password: {
        //     required: "Please Enter password",
        //     minlength: "Your password must be at least 6 characters long"
        //   },
        //   password2: {
        //     required: "Please Enter Confirm password",
        //     equalTo : "Confirm Password Does not Match"
        //   }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },

        submitHandler: function (form) {
              
               $.ajax({
                  url: "{{ url('/ajaxaddprescription') }}",
                  method: 'post',
                  data: {
                     "_token": "{{ csrf_token() }}",
                     customer_id: jQuery('#customer').val(),
                     patient_name: jQuery('#patient_name').val(),
                     left_eye_sph:jQuery('#left_eye_sph').val(),
                     left_eye_cyl:jQuery('#left_eye_cyl').val(),
                     left_eye_axis:jQuery('#left_eye_axis').val(),
                     left_eye_add:jQuery('#left_eye_add').val(),
                     left_eye_va_dist:jQuery('#left_eye_va_dist').val(),
                     left_eye_va_near:jQuery('#left_eye_va_near').val(),
                     left_eye_pd:jQuery('#left_eye_pd').val(),
                     right_eye_sph:jQuery('#right_eye_sph').val(),
                     right_eye_cyl:jQuery('#right_eye_cyl').val(),
                     right_eye_axis:jQuery('#right_eye_axis').val(),
                     right_eye_add:jQuery('#right_eye_add').val(),
                     right_eye_va_dist:jQuery('#right_eye_va_dist').val(),
                     right_eye_va_near: jQuery('#right_eye_va_near').val(),
                     right_eye_pd: jQuery('#right_eye_pd').val(),
                     doctor_name: jQuery('#doctor_name').val(),
                     prescription_condition: jQuery('#prescription_condition').val(),
                     status: jQuery('#status').val(),
                     remarks: jQuery('#remarks').val(),
                  },
                  success: function(data){
                    
                   $('#openPrescriptionModal').modal('hide');
                      toastr.success(data.success);
                    }
                  });
             }

      });
    });
    </script>
     <script>
      var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#dob').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
          constrainInput: false,
           maxDate: today
      });
  </script>
    
    <script>
      $('#sales_invoice_date').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
      });
  </script>
    
  <script>
      var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#due_date').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
           minDate: today
      });
  </script>

   <script>
    $(document).ready(function () {
      $('#ajaxaddpayment').validate({
        ignore: [],
        rules: {
          payment_type: {
            required: true,
          },
          payment_modes: {
            required: true,            
          },
          paid_amount: {            
            required: true,
          }
        },
        messages: {
        
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },

        submitHandler: function (form) {
              
               $.ajax({
                  url: "{{ url('/ajaxaddpayment') }}",
                  method: 'post',
                  data: {
                     "_token": "{{ csrf_token() }}",
                     sales_invoice_no: jQuery('#sales_invoice_no').val(),
                     customer_id: jQuery('#customer_id').val(),
                     payment_type: jQuery('#payment_type').val(),
                     payment_modes: jQuery('#payment_modes').val(),
                     paid_amount:jQuery('#paid_amount').val(),
                     transaction_id:jQuery('#transaction_id').val(),
                  },
                  success: function(data){
                    
                   $('#openPaymentModal').modal('hide');
                      toastr.success(data.success);
                    }
                  });
             }

      });
    });
    </script>

  <script>
    $(document).ready(function () {
      $('#ajaxaddcustomer').validate({
        ignore: [],
        rules: {
          first_name: {
            required: true,
          },
          last_name: {
            required: true,            
          },
          email: {            
            email: true,
          },
          user_type: {
            required: true,           
          },
          contact_no: {
            required: true,
            minlength:10,
            maxlength:10,
            number: true,
          },          
          gst_no: {
            maxlength:15,
          },
          pincode: {
            number: true,
            maxlength:6,
          },
          gender: {
            required: true,
          }
        },
        messages: {
        //   usertype: {
        //     required: "Please Select User Role",
        //   },
        //   name: {
        //     required: "Please Enter Name",
        //   },
        //   email: {
        //     required: "Please enter a email address",
        //     email: "Please enter a vaild email address"
        //   },
        //   password: {
        //     required: "Please Enter password",
        //     minlength: "Your password must be at least 6 characters long"
        //   },
        //   password2: {
        //     required: "Please Enter Confirm password",
        //     equalTo : "Confirm Password Does not Match"
        //   }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },

        submitHandler: function (form) {
              
               $.ajax({
                  url: "{{ url('/ajaxaddcustomer') }}",
                  method: 'post',
                  data: {
                     "_token": "{{ csrf_token() }}",
                     first_name: jQuery('#first_name').val(),
                     last_name: jQuery('#last_name').val(),
                     email:jQuery('#email').val(),
                     user_type:jQuery('#user_type').val(),
                     organization_name:jQuery('#organization_name').val(),
                     designation:jQuery('#designation').val(),
                     gst_no:jQuery('#gst_no').val(),
                     contact_no:jQuery('#contact_no').val(),
                     alt_contact_no:jQuery('#alt_contact_no').val(),
                     dob:jQuery('#dob').val(),
                     gender:jQuery('#gender').val(),
                     referred_by:jQuery('#referred_by').val(),
                     family_code:jQuery('#family_code').val(),
                     password:jQuery('#password').val(),
                     notes:jQuery('#notes').val(),
                     address_line_1: jQuery('#address_line_1').val(),
                     address_line_2: jQuery('#address_line_2').val(),
                     country: jQuery('#country-dropdown').val(),
                     state: jQuery('#state-dropdown').val(),
                     city: jQuery('#city-dropdown').val(),
                     landmark: jQuery('#landmark').val(),
                     pincode: jQuery('#pincode').val(),
                     address_type: jQuery('#address_type').val(),
                  },
                  success: function(data){
                    
                   $('#openCustomerModal').modal('hide');
                      toastr.success(data.success);
                    }
                  });
             }

      });
    });
    </script>
     <script>
      var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#dob').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
           maxDate: today
      });
  </script>

<script>
    $(document).ready(function () {
      $('#Product_form').validate({
        rules: {
          name: {
            required: true,
          },
          category_id: {
            required: true,
         }
          
        },
        messages: {
        //   usertype: {
        //     required: "Please Select User Role",
        //   },
        //   name: {
        //     required: "Please Enter Name",
        //   },
        //   email: {
        //     required: "Please enter a email address",
        //     email: "Please enter a vaild email address"
        //   },
        //   password: {
        //     required: "Please Enter password",
        //     minlength: "Your password must be at least 6 characters long"
        //   },
        //   password2: {
        //     required: "Please Enter Confirm password",
        //     equalTo : "Confirm Password Does not Match"
        //   }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
    <script>
      $(document).on('change','#paid_status',function(){
        var paid_status =  $(this).val();
        if(paid_status == 'partial_paid'){
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }
      });
     </script>
    

   

      <script type="text/javascript">
       var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
         $('#dob').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
          maxDate: today
         });
      </script>

      <script type="text/javascript">
          $(document).ready(function() {
          $('#country-dropdown').on('change', function() {
          var country_id = this.value;
          $("#state-dropdown").html('');
          $.ajax({
          url:"{{url('get-states-by-country')}}",
          type: "POST",
          data: {
          country_id: country_id,
          _token: '{{csrf_token()}}' 
          },
          dataType : 'json',
          success: function(result){
          $('#state-dropdown').html('<option value="">Select State</option>'); 
          $.each(result.states,function(key,value){
          $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
          });
          $('#city-dropdown').html('<option value="">Select State First</option>'); 
          }
          });
          });    
          $('#state-dropdown').on('change', function() {
          var state_id = this.value;
          $("#city-dropdown").html('');
          $.ajax({
          url:"{{url('get-cities-by-state')}}",
          type: "POST",
          data: {
          state_id: state_id,
          _token: '{{csrf_token()}}' 
          },
          dataType : 'json',
          success: function(result){
          $('#city-dropdown').html('<option value="">Select City</option>'); 
          $.each(result.cities,function(key,value){
          $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
          });
          }
          });
          });
          });
        </script>
   

<script>
    $(document).ready(function () {
      $('#ajaxupdateproduct').validate({
        ignore: [],
        rules: {
          barcode: {
            required: true,
          },
          product_name: {
            required: true,            
          },
          sell_qty: {            
            email: true,
          },
          unit_price: {
            required: true,           
          }
        },
        messages: {
        //   usertype: {
        //     required: "Please Select User Role",
        //   },
        //   name: {
        //     required: "Please Enter Name",
        //   },
        //   email: {
        //     required: "Please enter a email address",
        //     email: "Please enter a vaild email address"
        //   },
        //   password: {
        //     required: "Please Enter password",
        //     minlength: "Your password must be at least 6 characters long"
        //   },
        //   password2: {
        //     required: "Please Enter Confirm password",
        //     equalTo : "Confirm Password Does not Match"
        //   }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },

        submitHandler: function (form) {
              
               $.ajax({
                  url: "{{ url('/ajaxupdateproduct/{id}') }}",
                  method: 'post',
                  
                  data: {
                     "_token": "{{ csrf_token() }}",
                     invoice_date: jQuery('#invoice_date').val(),
                     sales_invoice_id: jQuery('#sales_invoice_id').val(),
                     category_id: jQuery('#category_id').val(),
                     barcode: jQuery('#barcode').val(),
                     product_name: jQuery('#product_name').val(),
                     unit_price: jQuery('#unit_price').val(),
                     sell_qty: jQuery('#sell_qty').val(),
                     price: jQuery('#price').val(),
                     cgst_perc: jQuery('#cgst_perc').val(),
                     cgst_amt: jQuery('#cgst_amt').val(),
                     sgst_perc: jQuery('#sgst_perc').val(),
                     sgst_amt: jQuery('#sgst_amt').val(),
                     price_excgst: jQuery('#price_excgst').val(),
                     discount_type: jQuery('#discount_type').val(),
                     discount_rate: jQuery('#discount_rate').val(),
                     discount_amt: jQuery('#discount_amt').val(),
                     sub_total: jQuery('#sub_total').val(),
                     total_product: jQuery('#total_product').val(),
                     du_date: jQuery('#du_date').val(),
                     created_by: jQuery('#created_by').val(),

                  },
                  success: function(data){
                    
                   $('#openCustomerModal').modal('hide');
                      toastr.success(data.success);
                    }
                  });
             }

      });
    });
    </script>
     <script>
      var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#dob').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
           maxDate: today
      });
  </script>
@endsection