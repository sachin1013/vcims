@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Purchase</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Purchase</span>
                    <small class="d-sm-block"><a href="{{ route('purchase.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Purchase</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Vendor Name</th>
                                    <th>Tax status / Taxation type</th>
                                    <th>Description</th>
                                    <th>Total Discount</th>
                                    <th>Grand Total</th>  
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($alldata as $key => $purchase)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y',strtotime($purchase->purchase_date)) }}</td>
                                    <td>{{ $purchase->purchase_invoice_no }}</td>                                    
                                    <?php $vendor = DB::table('vendors')->where('id', $purchase->vendor_id)->first(); ?>
                                    <td>{{ $vendor->company_name }}</td>
                                    @if ($purchase->tax_status == 1)
                                        <td><span class="badge badge-info">Tax enabled</span> / <span class="badge badge-secondary">{{ $purchase->taxation_type }}</span></td>
                                    @else
                                        <td><span class="badge badge-info">Tax disabled</span> / <span class="badge badge-secondary">{{ $purchase->taxation_type }}</span></td>
                                    @endif
                                    

                                    <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#Openquickmodal-{{$purchase->id}}"> Quick View</button>
                                        <div class="modal fade " id="Openquickmodal-{{$purchase->id}}" tabindex="-1" aria-labelledby="Openquickmodal-{{$purchase->id}}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="Openquickmodal-{{$purchase->id}}">Quick View - {{ $purchase->purchase_invoice_no }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <?php $details = DB::table('purchase_details')->where('invoice_no', $purchase->purchase_invoice_no)->get(); ?>
                                                <table class="table-sm table-bordered" width="100%">
                                                  <thead>
                                                    <tr>
                                                      
                                                      <th>Product Name</th>
                                                      <th>Qty.</th>
                                                      <th>Unit Price</th>                           
                                                      <th>CGST Rate</th>
                                                      <th>CGST Amt.</th>
                                                      <th>SGST Rate</th>
                                                      <th>SGST Amt.</th>
                                                      <th>Sub Total</th>
                                                      <th>Discount details</th>
                                                      <th>Discount Amt.</th>
                                                      <th>Final Price</th>
                                                      
                                                    </tr>
                                                  </thead><tbody>
                                                  @foreach($details as $detail)
                                                      <tr>
                                                        <?php $product = DB::table('products')->where('id',$detail->product_id)->first(); ?>
                                                            <td>{{ $product->product_model_no }}</td>  
                                                            <td>{{ $detail->buying_qty }}</td>
                                                            <td>{{ $detail->unit_price }}</td>
                                                            <td>{{ $detail->cgst_perc }}</td>
                                                            <td>{{ $detail->cgst_amt }}</td>
                                                            <td>{{ $detail->sgst_perc }}</td>
                                                            <td>{{ $detail->sgst_amt }}</td>
                                                            <td>{{ $detail->sub_total  }}</td>
                                                            <td>{{ $detail->discount_rate }} - {{ $detail->discount_type }}</td>
                                                            <td>{{ $detail->discount_amt }}</td>
                                                            <?php $sub = $detail->sub_total;
                                                            $discount = $detail->discount_amt;
                                                            
                                                            $total = $sub-$discount; ?>
                                                            <td>{{ $total }}</td>    
                                                      </tr>
                                                  @endforeach
                                                </tbody>
                                                </table>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                    <td>&#x20B9;{{ number_format($purchase->total_discount,2) }}</td>
                                    <td>&#x20B9;{{ number_format($purchase->grand_total,2) }}</td>
                                    <?php $payment = DB::table('purchase_payments')->where('purchase_invoice_no',$purchase->purchase_invoice_no)->first(); ?>
                                    <td>{{ $payment->payment_type }}</td>
                                    <td>
                                      <a role="button" type="button" class="btn dropdown" id="dropdownMenuButton-{{$purchase->id}}" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{$purchase->id}}">
                                          <a class="dropdown-item" href="../purchase/edit/{{ $purchase->id }}">Edit</a>
                                          <a class="dropdown-item" href="#">Print</a>
                                          <a class="dropdown-item" href="#">View</a>
                                          <button type="button" class="dropdown-item btn-light" data-toggle="modal" data-target="#Paymentmodal-{{$purchase->id}}"> Make Payment</button>


                                            
                                        </div> 



                                        <!--
                                        <a href="{{ route('purchase.edit',$purchase->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-1"></i></a>

                                        <a href="{{ route('purchase.delete',$purchase->id) }}" id="delete" title="Delete" class="btn btn-danger btn-sm {{ ($purchase->status == '1')?'disabled':''}}"><i class="fas fa-trash mr-1"></i></a>
                                        -->
                                    </td>
                                </tr>
                                <!--<div class="modal fade"  data-backdrop="static" data-keyboard="false" id="Paymentmodal-{{$purchase->id}}" tabindex="-1" aria-labelledby="Paymentmodal-{{$purchase->id}}" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="Paymentmodal-{{$purchase->id}}">Make Payment - {{ $purchase->purchase_invoice_no }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                   
                                                    <p><strong>Total Amount : </strong>{{ $purchase->grand_total }}</p>
                                                    <?php $payments = DB::table('purchase_payments')->where('purchase_invoice_no', $purchase->purchase_invoice_no)->get(); 
                                                      $totalamt = 0;
                                                      $totaldue = 0;
                                                      foreach($payments as $payment)
                                                      { 
                                                        
                                                        $totalamt +=$payment->paid_amount;
                                                      }
                                                      $grand = $purchase->grand_total;
                                                      $totaldue = $grand - $totalamt;
                                                    ?>
                                                    <p><strong>Due Amount : </strong>{{ $totaldue }}</p>
                                                    @if($totaldue<=0)
                                                    
                                                      <div class="alert alert-info" role="alert">
                                                              There is no due amount left with this invoice!!!
                                                      </div>
                                                    
                                                    @else
                                                    
                                                        <form>
                                                          <div class="form-row">
                                                              <div class="form-group col-md-3">
                                                                
                                                                <label for="payment_type">Paid Status</label>
                                                                <select name="payment_type" id="payment_type" class="form-control">
                                                                    <option value="">Select Status</option>
                                                                    <option value="Full Paid">Full Paid</option>
                                                                    <option value="Full Due">Full Due</option>
                                                                    <option value="Partial Paid">Partial Paid</option>
                                                                </select>
                                                              </div>
                                                              <div class="form-group col-md-3">
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
                                                              
                                                              <div class="form-group col-md-3">
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
                                                            <button type="submit" class="btn btn-primary mt-2">Save Purchase Payment</button>
                                                          </div>              
                                                        </form>
                                                    
                                                    @endif
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                </div>
                                              </div>
                                </div>-->
                                              
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

            

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
		</div> -->
	</footer>
</div>






@endsection