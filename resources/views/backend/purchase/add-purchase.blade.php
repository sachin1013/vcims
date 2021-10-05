@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('purchase.view') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Purchase</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Purchase</span>
                    <small class="d-sm-block"><a href="{{ route('purchase.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Purchase List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post" id="Product_form">
                        @csrf 
                        <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="purchase_date">Date</label>
                              <input type="text" class="form-control datepicker" name="purchase_date" value="{{ $purchase_date }}" id="purchase_date" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="purchase_invoice_no">Purchase Invoice No</label>
                              <input type="text" class="form-control" name="purchase_invoice_no" id="purchase_invoice_no" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vendor_id">Vendor Name </label><!--OR <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openVendorModal" id="open"> Add new vendor</button> -->
                                <select class="form-control select2" name="vendor_id" value="" id="vendor_id">
                                   
                                    <option value="">Select Vendor</option>
                                    @foreach ($vendor as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->company_name }}</option>
                                    @endforeach
                             
                                </select>

                                 
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category_id">Category Name </label><!-- OR <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openCategoryModal" id="open">Add new Category</button> -->
                                <select class="form-control select2" id="category_id" value="">
                                    <option value="">Select category</option>
                                    @foreach ($categ as $categ)
                                    <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                    @endforeach
                                </select>
                                
                              

                            </div>
                            <div class="form-group col-md-4">
                              <label for="product_id">Product Name </label><!--OR  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#openProductModal" id="open">Add new Product</button> -->
                              <select class="form-control select2" name="product_id" id="product_id" value="">
                                  <option value="">Select Category First</option>
                              </select>

                              
                            </div>
                            <div class="form-group col-md-4 col align-self-center">
                                <div class="custom-control custom-switch">
                                  <br/><br/>                                 
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="tax_status" class="custom-control-input tax_status" id="tax_status" value="">
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
                            <div class="form-group col-md-4" style="padding-top: 30px">
                              <a class=" text-white btn btn-primary addeventmore"><i class="fas fa-plus-circle mr-1"></i>Add Product</a>
                            </div>
                        </div>
                    
                
                
                          <table class="table-sm table-bordered" width="100%">
                              <thead>
                                <tr>
                                  <th>Category</th>
                                  <th>Product Name</th>
                                  <th>HSN/SAC</th>
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
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody id="addRow" class="addRow">

                              </tbody>
                              <tbody>
                                <tr>
                                  <td colspan="11"></td>
                                  <td>Total Discount</td>
                                  <td>
                                    <input type="text" name="total_discount" value="0" id="total_discount" class="form-control form-control-sm text-right total_discount">
                                    <input type="hidden" name="cgst_total" value="0" id="cgst_total" class="form-control form-control-sm text-right cgst_total">
                                    <input type="hidden" name="sgst_total" value="0" id="sgst_total" class="form-control form-control-sm text-right sgst_total">
                                    <input type="hidden" name="total_qty" value="0" id="total_qty" class="form-control form-control-sm text-right total_qty">
                                  </td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="11"></td>
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
                              <textarea name="description" class="form-control mt-2" id="description_main" placeholder="Description/Notes Write Here.."></textarea>
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
                                  <option value="Cheque">Cheque</option>
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
                          </div>

                          
                          <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Save Purchase Invoice</button>
                      </div>
                    </form>      
                </div>
              
            </div>
        </div>

                            <form method="post" action="{{ route('purchase.ajaxaddvendor') }}" id="ajaxaddvendor">
                                     @csrf

                                <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openVendorModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-header">
                                           <h5 class="modal-title">Add New Vendor</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control" name="company_name" id="company_name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="company_url">Company URL</label>
                                                <input type="text" class="form-control" name="company_url" id="company_url">
                                            </div>
                                            <div class="form-group col-md-6">
                                                 <label for="address_line_1">Address Line 1</label>
                                                <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Apartment no, Floor, Building Name">
                                            </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address_line_2">Address Line 2</label>
                                                <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Street name, Locality">
                                            </div>
                                            <div class="form-group col-md-4">
                                                               <label for="country">Country</label>
                                                              
                                                              <select class="form-control form-control-sm select2" name="country" id="country-dropdown">
                                                                 <option value="">Select Country</option>
                                                                 @foreach ($countries as $country) 
                                                                  <option value="{{$country->id}}">
                                                                  {{$country->name}}
                                                                </option>
                                                                  @endforeach
                                                              </select>
                                                          </div>
                                                          
                                                          <div class="form-group col-md-4">
                                                               <label for="state">State</label>
                                                                <select class="form-control form-control-sm select2" id="state-dropdown">
                                                              </select>                                            
                                                            </div>
                                                           
                                                           <div class="form-group col-md-4">
                                                               <label for="city">City</label>
                                                              <select class="form-control form-control-sm select2" id="city-dropdown">
                                                              </select>
                                                          </div>

                                             <div class="form-group col-md-6">
                                                 <label for="landmark">Landmark</label>
                                                <input type="text" class="form-control" name="landmark" id="landmark">
                                            </div>
                                             <div class="form-group col-md-6">
                                                 <label for="pincode">Pincode</label>
                                                <input type="text" class="form-control" name="pincode" id="pincode">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone_no">Office Phone no.</label>
                                                <input type="text" class="form-control" name="phone_no" id="phone_no">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="contact_person">Contact Person</label>
                                                <input type="text" class="form-control" name="contact_person" id="contact_person">
                                            </div>
                                             
                                            <div class="form-group col-md-6">
                                                <label for="mobile_no">Mobile No.</label>
                                                <input type="text" class="form-control" name="mobile_no" id="mobile_no">
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label for="gstin">GSTIN / Tax no.</label>
                                                <input type="text" class="form-control" name="gstin" id="gstin">
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="payment_method">Payment method</label>
                                                <input type="text" class="form-control" name="payment_method" id="payment_method">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="discount_type">Discount Type</label>
                                                <input type="text" class="form-control" name="discount_type" id="discount_type">
                                            </div>
                                             <div class="form-group col-md-12">
                                                <label for="notes">Notes</label>
                                               <textarea rows = "3" class="form-control" name="notes" id="notes"> </textarea>
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


                            <form method="post" action="{{ route('purchase.ajaxaddproduct') }}" id="ajaxaddproduct">
                                     @csrf

                                <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openProductModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-header">
                                           <h5 class="modal-title">Add New Product</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                           
                                          <div class="form-row">
                                              <div class="form-group col-md-6">
                                                  <label for="vendor_id">Vendor Name</label>
                                                  <select class="form-control select2" name="vendor_id" id="vendor_id_sub">
                                                      <option value="">Select vendor</option>
                                                         @foreach ($vendors as $vendor) 
                                                                      <option value="{{$vendor->id}}">
                                                                          {{$vendor->company_name}}
                                                                      </option>
                                                                    @endforeach
                                                                </select>
                                                      
                                                  </select>
                                              </div>
                                              
                                              <div class="form-group col-md-6">
                                                  <label for="category">Product Category</label>
                                                  <select class="form-control form-control-sm select2" name="category_id" id="category">
                                                      <option value="">Select Product Category</option>
                                                      @foreach ($category as $cate)
                                                      <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                      @endforeach
                                                      
                                                  </select>
                                              </div>
                                              </div>
                                          <div class="form-row">    
                                              <div class="form-group col-md-6">
                                                  <label for="product_modelno">Model No.</label>
                                                  <input type="text" class="form-control" name="product_modelno" id="product_modelno" placeholder="Enter Model no.">
                                              </div>
                                              
                                              <div class="form-group col-md-6">
                                                  <label for="product_collection">Collection</label>
                                                  <input type="text" class="form-control" name="product_collection" id="product_collection" placeholder="Enter Model collection">
                                              </div>

                                              <div class="form-group col-md-4">
                                                  <label for="country_origin">Country Of Origin</label>
                                                  <select class="form-control form-control-sm select2" name="country" id="country">
                                                                   <option value="">Select Country</option>
                                                                   @foreach ($origins as $origin) 
                                                                      <option value="{{$origin->id}}">
                                                                          {{$origin->name}}
                                                                      </option>
                                                                    @endforeach
                                                                </select>
                                              </div>

                                          <div class="form-group col-md-4">
                                                  <label for="brand">Brand Name</label>
                                                  <select class="form-control form-control-sm select2" name="brand" id="brand">
                                                     
                                                      <option value="">Select Brand</option>
                                                      <option value="carrera">Carrera</option>
                                                      <option value="gucci">Gucci</option>
                                                      <option value="vogue">Vogue</option>
                                                      <option value="polaroid">Polaroid</option>
                                                      <option value="Ray-Ban">Ray-Ban</option>
                                                      <option value="Esprit">Esprit</option>
                                                      <option value="velocity">Velocity</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="frame_type">Frame Type</label>
                                                  <select class="form-control form-control-sm select2" name="frame_type" id="frame_type">
                                                      
                                                      <option value="">Select Frame Type</option>
                                                      <option value="full rim">Full Rim</option>
                                                      <option value="half rim">Half Rim</option>
                                                      <option value="rimless">Rimless</option>
                                                      
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-row">
                                              
                                              
                                              <div class="form-group col-md-4">
                                                  <label for="frame_shape">Frame shape</label>
                                                  <select class="form-control form-control-sm select2" name="frame_shape" id="frame_shape">
                                                      
                                                      <option value="">Select Frame shape</option>
                                                      <option value="rectangle">Rectangle</option>
                                                      <option value="round">Round</option>
                                                      <option value="square">Square</option>
                                                      <option value="hexagonal">Hexagonal</option>
                                                      <option value="wayfarer">Wafarer</option>
                                                      <option value="Cat eye">Cat Eye</option>
                                                      <option value="aviator">Aviator</option>
                                                  </select>
                                              </div>

                                              <div class="form-group col-md-4">
                                                  <label for="frame_shape">Frame size</label>
                                                  <select class="form-control form-control-sm select2" name="frame_size" id="frame_size">
                                                     
                                                      <option value="">Select Frame size</option>
                                                      <option value="small">Small (<132mm) </option>
                                                      <option value="medium">Medium (133mm - 138mm)</option>
                                                      <option value="large">Large (>139mm)</option>
                                                      
                                                  </select>
                                              </div>

                                               <div class="form-group col-md-4">
                                                  <label for="frame_shape">Frame width (in mm)</label>
                                                  <input type="text" class="form-control" name="frame_width" id="frame_width" placeholder="">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="frame_dimesion">Frame dimension (in mm)</label>
                                                  <input type="text" class="form-control" name="frame_dimesion" id="frame_dimesion" placeholder="">
                                              </div>

                                              <div class="form-group col-md-4">
                                                  <label for="product_height">Height (in mm)</label>
                                                  <input type="text" class="form-control" name="product_height" id="product_height" placeholder="">
                                              </div>

                                               <div class="form-group col-md-4">
                                                  <label for="frame_color">Frame colour</label>
                                                  <select class="form-control form-control-sm select2" name="frame_color" id="frame_color">
                                                      <option value="">Select Frame colour</option>
                                                      <option value="blue">Blue</option>
                                                      <option value="grey">Grey</option>
                                                      <option value="black">Black</option>
                                                      <option value="brown">Brown</option>
                                                      <option value="yellow">Yellow</option>
                                                      <option value="gold">Gold</option>
                                                      <option value="gunmetal">Gunmetal</option>
                                                      <option value="green">Green</option>
                                                      <option value="pink">Pink</option>
                                                      <option value="red">Red</option>
                                                      <option value="rosemetal">Rose Metal</option>    
                                                      <option value="silver">Silver</option>
                                                  </select>
                                              </div>

                                              <div class="form-group col-md-4">
                                                  <label for="temple_color">Temple colour</label>
                                                  <select class="form-control form-control-sm select2" name="temple_color" id="temple_color">
                                                      <option value="">Select Temple colour</option>
                                                      <option value="blue">Blue</option>
                                                      <option value="grey">Grey</option>
                                                      <option value="black">Black</option>
                                                      <option value="brown">Brown</option>
                                                      <option value="yellow">Yellow</option>
                                                      <option value="gold">Gold</option>
                                                      <option value="gunmetal">Gunmetal</option>
                                                      <option value="green">Green</option>
                                                      <option value="pink">Pink</option>
                                                      <option value="red">Red</option>
                                                      <option value="rosemetal">Rose Metal</option>    
                                                      <option value="silver">Silver</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="frame_weight">Frame Weight</label>
                                                  <select class="form-control form-control-sm select2" name="frame_weight" id="frame_weight">
                                                      <option value="">Select Frame weight</option>
                                                      <option value="feather light">Feather light (less than 10gm)</option>
                                                      <option value="light">Light weight(between 10-20gm)</option>
                                                      <option value="average weight"> Average in weight(between 20-40gm)</option>
                                                      <option value="above average">Above average (More than 40 gm)</option>
                                                  </select>
                                              </div>

                                               <div class="form-group col-md-4">
                                                  <label for="frame_material">Frame Material</label>
                                                  <select class="form-control form-control-sm select2" name="frame_material" id="frame_material">
                                                      <option value="">Select Frame Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate">Acetate</option>
                                                        <option value="HD Acetate">HD Acetate</option>
                                                        <option value="TR-90">TR-90</option>
                                                        <option value="Others">Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy">Alloy</option>
                                                        <option value="Titanium">Titanium</option>
                                                        <option value="Aluminium">Aluminium</option>
                                                        <option value="Stainless steel">Stainless steel</option>
                                                        <option value="Others">Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood">Wood</option>
                                                        <option value="Rubber">Rubber</option>
                                                        <option value="Carbon">Carbon</option>
                                                        <option value="Nylon">Nylon</option>
                                                        <option value="Others">Other</option>                       
                                                      </optgroup>
                                                  </select>
                                              </div>

                                               <div class="form-group col-md-4">
                                                  <label for="temple_material">Temple Material</label>
                                                  <select class="form-control form-control-sm select2" name="temple_material" id="temple_material">
                                                      <option value="">Select Temple Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate">Acetate</option>
                                                        <option value="HD Acetate">HD Acetate</option>
                                                        <option value="TR-90">TR-90</option>
                                                        <option value="Others">Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy">Alloy</option>
                                                        <option value="Titanium">Titanium</option>
                                                        <option value="Aluminium">Aluminium</option>
                                                        <option value="Stainless steel">Stainless steel</option>
                                                        <option value="Others">Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood">Wood</option>
                                                        <option value="Rubber">Rubber</option>
                                                        <option value="Carbon">Carbon</option>
                                                        <option value="Nylon">Nylon</option>
                                                        <option value="Others">Other</option>                       
                                                      </optgroup>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="prescription_type">Prescription Type</label>
                                                  <select class="form-control form-control-sm select2" name="prescription_type" id="prescription_type">
                                                      <option value="">Select Prescription Type</option>
                                                      <option value="bifocal/progressive">Bifocal / Progressive</option>
                                                      
                                                      <option value="others">Others</option>
                                                  </select>
                                              </div>

                                              <div class="form-group col-md-4">
                                                  <label for="frame_style">Frame Style</label>
                                                  <select class="form-control form-control-sm select2" name="frame_style" id="frame_style">
                                                      <option value="">Select Frame style</option>
                                                      <option value="standard">Standard</option>
                                                      
                                                      <option value="others">Others</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-3">
                                                  <label for="frame_style_secondary">Frame Style Secondary</label>
                                                  <select class="form-control form-control-sm select2" name="frame_style_secondary" id="frame_style_secondary">
                                                      <option value="">Select Frame style secondary</option>
                                                      <option value="youth">Youth</option>
                                                      
                                                      <option value="others">Others</option>
                                                  </select>
                                              </div>

                                               <div class="form-group col-md-3">
                                                  <label for="gender">Gender</label>
                                                  <select class="form-control form-control-sm select2" name="gender" id="gender">
                                                      <option value="">Select Gender</option>
                                                      <option value="male">Male</option>
                                                      <option value="female">Female</option>
                                                      <option value="unisex">Unisex</option>
                                                      
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-3">
                                                  <label for="product_condition">Product Condition</label>
                                                  <select class="form-control form-control-sm select2" name="product_condition" id="product_condition">
                                                      <option value="">Select Product condition</option>
                                                      <option value="new">New</option>
                                                      
                                                      <option value="others">Others</option>
                                                  </select>
                                              </div>
                                              
                                               <div class="form-group col-md-3">
                                                  <label for="product_warranty">Warranty</label>
                                                  <select class="form-control form-control-sm select2" name="product_warranty" id="product_warranty">
                                                      <option value="default(1year)">Standard (1 Year Manufacturer Warranty)</option>
                                                  </select>
                                              </div>
                                              <h3>For Contact lenses</h3>
                                               <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                  <label for="base_curve">Base Curve (in mm)</label>
                                                  <input type="text" class="form-control" name="base_curve" id="base_curve" placeholder="">
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                  <label for="lens_diameter">Lens Diameter (in mm)</label>
                                                  <input type="text" class="form-control" name="lens_diameter" id="lens_diameter" placeholder="">
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                  <label for="water_content">Water Content (in %)</label>
                                                  <input type="text" class="form-control" name="water_content" id="water_content" placeholder="">
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                  <label for="lens_material">Lens Material</label>
                                                  <input type="text" class="form-control" name="lens_material" id="lens_material" placeholder="">
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                  <label for="packaging">Packaging</label>
                                                  <input type="text" class="form-control" name="packaging" id="packaging" placeholder="">
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                      <label for="usage_duration">Usage Duration</label>
                                                      <input type="text" class="form-control" name="usage_duration" id="usage_duration" placeholder="">
                                                  </div>
                                              </div>
                                                  <h3>For Contact lenses Solutions</h3>
                                                  
                                                      <div class="form-group col-md-9">
                                                      <label for="solution_qty">Solution Quantity (in ml)</label>
                                                      <input type="text" class="form-control" name="solution_qty" id="solution_qty" placeholder="">
                                                      </div>
                      
                                          
                                          </div>

                                        </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button  class="btn btn-primary" id="ajaxProductSubmit" type="submit">Save changes</button>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                              </form>

                              <form method="post" action="{{ route('purchase.ajaxaddcategory') }}" id="ajaxaddcategory">
                                     @csrf

                                <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="openCategoryModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-header">
                                           <h5 class="modal-title">Add New Category</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Category Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="cgst_perc">CGST Percentage</label>
                                                    <input type="text" class="form-control" name="cgst_perc" id="cgst_perc" placeholder="">
                                                </div>
                                                 <div class="form-group col-md-3">
                                                    <label for="sgst_perc">SGST Percentage</label>
                                                    <input type="text" class="form-control" name="sgst_perc" id="sgst_perc" placeholder="">
                                                </div>
                                                <div class="form-group col-md-12">
                                                     <label for="description">Description</label>
                                                        <textarea class="form-control" name="description" rows="5" id="description"></textarea>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button  class="btn btn-primary" id="ajaxCategorySubmit" type="submit">Save changes</button>
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
     <input type="hidden" name="date[]" value="@{{ purchase_date }}">
    <input type="hidden" name="invoice_no[]" value="@{{ purchase_invoice_no }}">

    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="product_id[]" value="@{{ product_id }}">
      @{{ product_name }}
    </td>
   <td>
      <input type="text" class="form-control form-control-sm text-right hsn_sac" name="hsn_sac[]">
    </td>
    <td>
      <input type="text" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]">
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
      <input type="text" class="form-control form-control-sm text-right sub_total" name="sub_total[]">
    </td>    
    <td>
      <input type="hidden"  class="tax_status" value="@{{ tax_status }}">
      <input type="hidden"  class="taxation_type" value="@{{ taxation_type }}">
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
      <input  name="created_by[]" type="hidden" value="{{ Auth::user()->id }}" class="form-control form-control-sm text-right created_by" readonly>
      <input  name="buying_price[]" class="form-control form-control-sm text-right buying_price" readonly>
      <input  name="selling_price[]" type="hidden" class="form-control form-control-sm text-right selling_price" readonly>
      <input  name="notes[]" type="hidden" class="form-control form-control-sm text-right notes" readonly>
    </td>
    
    <td><button class="btn btn-danger btn-sm rounded-0 removeeventmore"><i class="fa fa-trash"></i></button></td>
  </tr>
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click",".addeventmore",function(){
      
      var purchase_date = $('#purchase_date').val();
      var purchase_invoice_no = $('#purchase_invoice_no').val();
      var vendor_id = $('#vendor_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id = $('#product_id').val();
      var product_name = $('#product_id').find('option:selected').text();
      var tax_status = $('#tax_status').prop('checked');
      var taxation_type = $('#taxation_type').val();
      var cgst_perc,sgst_perc;
      //alert(category_name);
      if(purchase_date==''){
        //$.notify("Date is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Purchase date is Required");
        return false;
      }
      if(purchase_invoice_no==''){
        // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Purchase Invoice No. is Required");
        return false;
      }
      if(vendor_id==''){
        //$.notify("Supplier Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Vendor Name is Required");
        return false;
      }
      if(category_id==''){
        //$.notify("Category Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Category Name is Required");
        return false;
      }
      if(product_id==''){
        //$.notify("Product Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Product Name is Required");
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
              purchase_date:purchase_date,
              purchase_invoice_no:purchase_invoice_no,
              vendor_id:vendor_id,
              category_id:category_id,
              category_name:category_name,
              product_id:product_id,
              product_name:product_name,
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
    $(document).on("keyup click",".unit_price,.buying_qty",function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
      
      var total = unit_price * buying_qty;
      $(this).closest("tr").find("input.price").val(total);
      var price = $(this).closest("tr").find("input.price").val();
             
    });

         $(document).on("keyup click",".discount_rate",function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
            if(buying_qty==''){
              // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
              toastr.error("Buying Quantity is Required");
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
                var buying_price = parseFloat(predisctotal) - parseFloat(discount_rate);
                var disc = parseFloat(predisctotal) - parseFloat(buying_price);
                var disc_final = disc.toFixed(0);
                var sub_total = buying_price.toFixed(0);
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
                var buying_price = parseFloat(predisctotal) - [(predisctotal*discount_rate)/100];
                var disc = parseFloat(predisctotal) - parseFloat(buying_price);
                var disc_final = disc.toFixed(0);
                var sub_total = buying_price.toFixed(0);
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
               $(this).closest("tr").find("input.buying_price").val(price);
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
                $(this).closest("tr").find("input.buying_price").val(post_price);
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
      $(".buying_price").each(function(){
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
      $(".buying_qty").each(function(){
        var valueqty = $(this).val();
        if(!isNaN(valueqty) && valueqty.length != 0){
          total_qty += parseFloat(valueqty);
        }
      });

      $("#cgst_total").val(total_cgst);
      $("#sgst_total").val(total_sgst);
      $("#total_qty").val(total_qty);
      $("#total_discount").val(totdiscount);
      $("#grand_total").val(sum);
      //console.log(total_cgst, total_sgst, total_qty);
    }
     
    $(document).on('change','#payment_type',function(){
          var pay_type = $(this).val();
          var total = $("#grand_total").val();
          
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
          var total = $("#grand_total").val();
          if(paid_amount > total) {
               toastr.error("Amount should be less than Grand Total.");
              return false;
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
      var vendor_id = $('#vendor_id').val();
      // alert(vendor_id);
      $.ajax({
        url:"{{route('get-product')}}",
        type:"GET",
        data:{
          category_id:category_id,
          vendor_id:vendor_id,
        },
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'">'+v.product_model_no+'</option>';
          });
          $('#product_id').html(html);
        }
      });
    });
  });
</script>

<script>
       var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
         $('#purchase_date').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
          maxDate: today
         });
</script>

    <script>
         $(document).ready(function(){
            
               $('#ajaxaddvendor').validate({
                      ignore: [],
                      rules: {
                        company_name: {
                          required: true,
                        },
                        email: {
                          required: true,
                          email: true,
                        },
                        address_line_1: {
                          required: true,
                        },
                        address_line_2: {
                          required: true,
                        },
                        phone_no: {
                          number: true,
                        },
                        pincode: {
                          required: true,
                           number: true,
                          maxlength:6,
                        },
                        company_name: {
                          required: true,
                        },
                        contact_person: {
                          required: true,
                          
                        },
                        mobile_no: {
                          required: true,
                         minlength:9,
                          maxlength:10,
                          number: true,
                        },
                        gstin: {
                          required: true,
                         maxlength:15,
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
                  url: "{{ url('/ajaxaddvendor') }}",
                  method: 'post',
                  data: {
                     "_token": "{{ csrf_token() }}",
                     company_name: jQuery('#company_name').val(),
                     company_url: jQuery('#company_url').val(),
                     address_line_1: jQuery('#address_line_1').val(),
                     address_line_2: jQuery('#address_line_2').val(),
                     country: jQuery('#country-dropdown').val(),
                     state: jQuery('#state-dropdown').val(),
                     city: jQuery('#city-dropdown').val(),
                     landmark: jQuery('#landmark').val(),
                     pincode: jQuery('#pincode').val(),
                     email: jQuery('#email').val(),
                     phone_no: jQuery('#phone_no').val(),
                     contact_person: jQuery('#contact_person').val(),
                     mobile_no: jQuery('#mobile_no').val(),
                     gstin: jQuery('#gstin').val(),
                     payment_method: jQuery('#payment_method').val(),
                     discount_type: jQuery('#discount_type').val(),
                     notes: jQuery('#notes').val(),
                  },
                  success: function(data){
                    //console.log(data);
                   $('#openVendorModal').modal('hide');
                      toastr.success(data.success);
                    }
                  });
             }
               });
            });
    </script>

    <script>
         $(document).ready(function(){

              $('#ajaxaddcategory').validate({
                      ignore: [],
                       rules: {
                          name: {
                            required: true,
                          },
                          cgst_perc: {
                            required: true,
                            number: true,
                          },
                          sgst_perc: {
                            required: true,
                            number: true,
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
                            url: "{{ url('/ajaxaddcategory') }}",
                            method: 'post',
                            data: {
                               "_token": "{{ csrf_token() }}",
                               name: jQuery('#name').val(),
                               description: jQuery('#description').val(),
                               cgst_perc: jQuery('#cgst_perc').val(),
                               sgst_perc: jQuery('#sgst_perc').val(),                                         
                            },
                            success: function(data){
                              $('#openCategoryModal').modal('hide');
                              toastr.success(data.success);
                            } 
                          });
                         
                       }
                     });
               });
          
    </script>

    <script type="text/javascript">
            $(document).ready(function(){
                   $('#ajaxaddproduct').validate({
                      ignore: [],
                      rules: {
                        product_model_no: {
                          required: true,
                        },
                        product_collection: {
                          required: true,
                        },
                        vendor_id: {
                          required: true
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
                      },

                      submitHandler: function (form) {

                        $.ajax({
                          url: "{{ url('/ajaxaddproduct') }}",
                          method: 'post',
                          data: {
                             "_token": "{{ csrf_token() }}",
                             vendor_id: jQuery('#vendor_id_sub').val(),
                             category_id: jQuery('#category').val(),
                             product_modelno: jQuery('#product_modelno').val(),
                             product_collection: jQuery('#product_collection').val(),
                             country_origin: jQuery('#country_origin').val(),
                             brand: jQuery('#brand').val(),
                             frame_type: jQuery('#frame_type').val(),
                             frame_shape: jQuery('#frame_shape').val(),
                             frame_size: jQuery('#frame_size').val(),
                             frame_width: jQuery('#frame_width').val(),
                             frame_dimesion: jQuery('#frame_dimesion').val(),
                             product_height: jQuery('#product_height').val(),
                             frame_color: jQuery('#frame_color').val(),
                             temple_color: jQuery('#temple_color').val(),
                             frame_weight: jQuery('#frame_weight').val(),
                             frame_material: jQuery('#frame_material').val(),
                             temple_material: jQuery('#temple_material').val(),
                             prescription_type: jQuery('#prescription_type').val(),
                             frame_style: jQuery('#frame_style').val(),
                             frame_style_secondary: jQuery('#frame_style_secondary').val(),
                             gender: jQuery('#gender').val(),
                             product_condition: jQuery('#product_condition').val(),
                             product_warranty: jQuery('#product_warranty').val(),
                             base_curve: jQuery('#base_curve').val(),
                             lens_diameter: jQuery('#lens_diameter').val(),
                             water_content: jQuery('#water_content').val(),
                             lens_material: jQuery('#lens_material').val(),
                             packaging: jQuery('#packaging').val(),
                             usage_duration: jQuery('#usage_duration').val(),
                             solution_qty: jQuery('#solution_qty').val(),
                          },
                          success: function(data){
                             $('#openProductModal').modal('hide');
                                      toastr.success(data.success);
                            }
                          });
                      }
                  });
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
@endsection






































