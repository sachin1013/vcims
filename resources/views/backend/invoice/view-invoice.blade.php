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
                    <span><i class="fas fa-table mr-1"></i>View Sales</span>
                    <small class="d-sm-block"><a href="{{ route('invoice.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Sales</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                
                                    <th>Sr. No.</th>
                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Store ID</th>
                                    <th>Customer Name</th>
                                    <th>Tax status / Taxation type</th>
                                    <th>Order Status</th>
                                    <th>Total Discount</th>
                                    <th>Grand Total</th>  
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                 @foreach ($alldata as $key => $invoice)
                                    <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y',strtotime($invoice->sales_invoice_date)) }}</td>
                                    <td>{{ $invoice->sales_invoice_no }}</td>
                                    @if($invoice->store_id == 6)
                                    <td><span class="badge badge-primary"><strong>Visioncraft-Kurla</strong></span></td>
                                    @elseif($invoice->store_id == 7)
                                    <td><span class="badge badge-warning"><strong>Visioncraft-Chembur</strong></span></td>
                                    @else
                                    <td></td>@endif
                                    <?php $customer = DB::table('customers')->where('id', $invoice->customer_id)->first(); ?>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    
                                    @if ($invoice->tax_status == 1)
                                        <td><span class="badge badge-info">Tax enabled</span> / <span class="badge badge-secondary">{{ $invoice->taxation_type }}</span></td>
                                    @else
                                        <td><span class="badge badge-info">Tax disabled</span> / <span class="badge badge-secondary">{{ $invoice->taxation_type }}</span></td>
                                    @endif
                                    

                                    @if($invoice->sales_invoice_status == 0)
                                        <td><strong><span class="badge badge-secondary">Draft</span></strong></td>
                                    @elseif($invoice->sales_invoice_status == 1)
                                        <td><span class="badge badge-warning">Active</span></td>
                                    @else
                                        <td><span class="badge badge-success">Delivered</span></td>
                                    @endif
                                    <td>&#x20B9;{{ number_format($invoice->discount_total,2) }}</td>
                                    <td>&#x20B9;{{ number_format($invoice->grand_total,2) }}</td>
                                    <?php $payment = DB::table('payments')->where('sales_invoice_no',$invoice->sales_invoice_no)->orderBy('id', 'DESC')->first(); ?>
                                    <td>{{ $payment->payment_type }}</td>

                                    <td>
                                      <a role="button" type="button" class="btn dropdown" id="dropdownMenuButton" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if(Auth::user()->role =="Admin")
                                          <a class="dropdown-item" target="_blank" href="../invoice/edit/{{ $invoice->id }}">Edit</a>@endif
                                          <a class="dropdown-item" target="_blank" href="../invoice/print/{{ $invoice->id }}">Print Invoice</a>
                                          <a class="dropdown-item" target="_blank" href="../invoice/print-advance/{{ $invoice->id }}">Print Advance Receipt</a>
                                          
                                          <!--<button type="button" class="btn btn-link" data-toggle="modal" data-target="#Openquickmodal-{{$invoice->id}}"> Quick View</button>-->
                             <div class="modal fade" id="Openquickmodal-{{$invoice->id}}" tabindex="-1" aria-labelledby="Openquickmodal-{{$invoice->id}}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="Openquickmodal-{{$invoice->id}}">Quick View - {{ $invoice->sales_invoice_no }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <?php $details = DB::table('invoice_details')->where('sales_invoice_id', $invoice->sales_invoice_no)->get(); ?>
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
                                                        
                                                            <td>{{ $detail->product_name }}</td>  
                                                            <td>{{ $detail->sell_qty }}</td>
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
                                                            <td>{{ $detail->total_product }}</td>    
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
                                    
                                </tr>

                                 @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
                                        </div> 



</div>
<script type="text/javascript">
    $('#myModal').modal('show');
</script>
@endsection