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
                	<form action="{{ route('invoice.store') }}" method="post" id="Product_form">
                        @csrf 
                        <div class="form-row">
                          <div class="form-group col-md-4">
                              <label>Customer Name</label><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openCustomerModal" id="open"> Add new Customer</button> <br/>
                              <select name="customer_id" id="customer_id" class="form-control select2 col-md-12">
                                <option value="">Select Customer</option>
                               
                                @foreach ($customer as $customer)
                                  <option value="{{ $customer->id }}">{{ $customer->first_name}} {{ $customer->last_name}} ({{ $customer->contact_no}})</option>
                                @endforeach
                              </select>
                            



                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-8">
                                
                                <div class="form-group" id="prescriptions">
                                  
                                  
                                </div>
                              </div>
                            </div>

                            <input type="hidden" value="" name="prescription_id" id="prescription_id" class="form-control form-control text-right prescription_id">
                            <input type="hidden" value="" name="prescription_status" id="prescription_status" class="form-control form-control text-right prescription_status">
                            <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="invoice_no">Invoice No</label>
                                <input type="text" value="{{ $invoice_no }}" class="form-control" name="sales_invoice_no" id="sales_invoice_no" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="date">Date</label>
                              <input type="text" class="form-control datepicker" name="sales_invoice_date" id="sales_invoice_date" value="{{ $date }}" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="category_id">Category Name</label>
                                <select class="form-control select2" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="product_id">Product Name</label>
                              <select class="form-control select2" name="product_id" id="product_id">
                                  <option value="">Select Category First</option>
                              </select>
                            </div>
                            <!--<div class="form-group col-md-2">
                                <label for="stock">Stock (pcs) </label>
                                <input type="text" class="form-control pur" name="stock" id="stock" readonly>
                            </div>
                            -->
                            <div class="form-group col-md-4 col align-self-center">
                                <div class="custom-control custom-switch">
                                  <br/><br/>                                 
                                  &nbsp;&nbsp;<input type="checkbox" name="tax_status" class="custom-control-input tax_status" id="tax_status" value="">
                                  <label class="custom-control-label" for="tax_status">Tax Enabled</label>
                                </div>
                            </div>

                            <div class="form-group col-md-2" id="taxation_check" style="display:none">
                              <label for="taxation_check">Taxation Type </label>
                              <select class="form-control taxation_type" value="" name="taxation_type" id="taxation_type">
                                <option value="None">None</option>
                                  <option value="Inclusive Taxes">Inclusive Taxes</option>
                                  <option value="Exclusive Taxes">Exclusive Taxes</option>
                                </select>
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
                                  <th>Product Name</th>
                                  <th>Qty.</th>
                                  <th>Unit Price</th>                           
                                  <th>CGST Rate</th>
                                  <th>CGST Amt.</th>
                                  <th>SGST Rate</th>
                                  <th>SGST Amt.</th>
                                  <th>Sub. Total</th>
                                  <th>Discount Type</th>
                                  <th>Discount Amt.</th>
                                  <th>Total Price</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody id="addRow" class="addRow">

                              </tbody>
                              <tbody>
                                <tr>
                                  <td colspan="10"></td>
                                  <td>Total Discount</td>
                                  <td>
                                    <input type="text" name="discount_total" value="" id="discount_total" class="form-control form-control-sm text-right discount_total">
                                    <input type="hidden" name="cgst_total" value="" id="cgst_total" class="form-control form-control-sm text-right cgst_total">
                                    <input type="hidden" name="sgst_total" value="" id="sgst_total" class="form-control form-control-sm text-right sgst_total">
                                    <input type="hidden" name="total_qty" value="" id="total_qty" class="form-control form-control-sm text-right total_qty">
                                  </td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="10"></td>
                                  <td>Grand Total</td>
                                  <td>
                                    <input type="text" name="grand_total" value="0" id="grand_total" class="form-control form-control-sm text-right grand_total" readonly>
                                  </td>
                                  <td></td>
                                </tr>
                              </tbody>
                          </table>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <textarea name="description" class="form-control mt-2" id="description" placeholder="Description Write Here.."></textarea>
                        </div>
                      </div>
                      <div class="form-row">
                            <div class="form-group col-md-2">
                              
                              <label for="payment_type">Paid Status</label>
                              <select name="payment_type" id="payment_type" class="form-control">
                                  <option value="">Select Status</option>
                                  <option value="Full Paid">Full Paid</option>
                                  <option value="Full Due">Full Due</option>
                                  <option value="Partial Paid">Partial Paid</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
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
                            
                            <div class="form-group col-md-2">
                              <label for="paid_amount">Amount To be Paid</label>
                              <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control text-right paid_amount">
                            </div>
                            <div class="form-group col-md-3" id ="transact_div" style="display:none">
                              <label for="transaction_id">Transaction Id</label>
                              <input type="text" name="transaction_id" id="transaction_id" class="form-control form-control-sm text-right transaction_id" >
                            </div>
                            <input type="hidden" name="due_amount" id="due_amount" class="form-control form-control text-right due_amount">
                            <div class="form-group col-md-2">
                                                  <label for="due_date">Due Date</label>
                                                  <input type="text" class="form-control datepicker" name="due_date" id="due_date" placeholder="yyyy-mm-dd" readonly>
                                       </div> 
                          </div>
                          <div class="form-row">
                            
                              <!--<div class="form-group col-md-2">
                              
                                  <label for="delivery_type">Delivery Options</label>
                                  <select name="delivery_type" id="delivery_type" class="form-control">
                                      <option value="">Select Option</option>
                                      <option value="Home Delivery">Home Delivery</option>
                                      <option value="In store">In store</option>
                                  </select>
                              </div>
                              -->
                          </div>


                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Save Invoice</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection