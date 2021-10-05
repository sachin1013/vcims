@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid"><br>
			<h1 class="mt-4" style="display:inline;">Overview</h1> &nbsp;&nbsp;&nbsp;
			    @if(Auth::user()->id == 5)
			    <select name="store" class="custom-select-sm store_filter" id="store_filter" style="padding-left:25px;border: 0;display:inline-block;vertical-align: middle;">
					    <option value="1">Master</option>
					    <option value="6">Visioncraft - Kurla</option>
					    <option value="7">Visioncraft - Chembur</option>
				 </select>&nbsp;&nbsp;&nbsp;
				@endif
				&nbsp;&nbsp;&nbsp;<select name="duration" data-url="{{url('/')}}" data-token="{{ csrf_token() }}" class="custom-select-sm duration_filter" id="filter_duration" style="padding-left:25px;border: 0;display:inline-block;vertical-align: middle;">
					    <option value="today">Today</option>
					    <option value="thisweek">This week</option>
					    <option value="thismonth">This month</option>
					  </select>
					  <br><br>
					  
			    <div class="row" id="dashboard_tile">
				<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
				   <?php
                    use Carbon\Carbon;
                    
                    $today = \Carbon\Carbon::today();
                    

                        $invoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])->get();
                        $customers = DB::table('customers')->where('created_at', '>=', $today)->count();
                        $prescriptions = DB::table('prescriptions')->where('created_at', '>=', $today)->count();
                        $orders = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])->count();
                        $total = 0;
                        
                        foreach($invoices as $invoice)
                        {   
                            $gtotal = $invoice->grand_total;
                            $total = $total + $gtotal;
                        }
                        

                        $kinvoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])
                                                        ->where('store_id', '=', 6)->get();
                        $customers_kurla = DB::table('customers')->where('created_at', '>=', $today)->where('created_by', '=', 6)->count();
                        $prescriptions_kurla = DB::table('prescriptions')->where('created_at', '>=', $today)->where('created_by', '=', 6)->count();
                        $orders_kurla = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])->where('created_by', '=', 6)->count();
                        $total_kurla = 0;
                        
                        foreach($kinvoices as $kinvoice)
                        {   
                            $gtotal = $kinvoice->grand_total;
                            $total_kurla = $total_kurla + $gtotal;
                        }
                        
                            
                        $chinvoices = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])
                                                        ->where('store_id', '=', 7)->get();
                        $customers_chembur = DB::table('customers')->where('created_at', '>=', $today)->where('created_by', '=', 7)->count();
                        $prescriptions_chembur = DB::table('prescriptions')->where('created_at', '>=', $today)->where('created_by', '=', 7)->count();
                        $orders_chembur = DB::table('invoices')->where('created_at', '>=', $today)
                                                        ->whereIn('sales_invoice_status', [1,2])->where('created_by', '=', 7)->count();
                        $total_chembur = 0;
                        
                        foreach($chinvoices as $chinvoice)
                        {   
                            $gtotal = $chinvoice->grand_total;
                            $total_chembur = $total_chembur + $gtotal;
                        }
                    ?>
                 
                    
                    
                    @if(Auth::user()->id == 6)
					<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="purchasesTotal">&#x20B9; {{ $total_kurla }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-columns fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="customers">{{ $customers_kurla }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Prescriptions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="prescriptions">{{ $prescriptions_kurla }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Orders Delivered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="orders">{{ $orders_kurla }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list-alt fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				<br>
				@elseif(Auth::user()->id == 7)
				<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="purchasesTotal">&#x20B9; {{ $total_chembur }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-columns fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="customers">{{ $customers_chembur }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Prescriptions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="prescriptions">{{ $prescriptions_chembur }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Orders Delivered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="orders">{{ $orders_chembur }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list-alt fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				<br>
				@else
				<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="purchasesTotal">&#x20B9; {{ $total }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-columns fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="customers">{{ $customers }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Prescriptions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="prescriptions">{{ $prescriptions }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Orders Delivered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="orders">{{ $orders }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list-alt fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				<br>
				
				@endif
				<div class="row">
					<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-1">
                                               <a class="small font-weight-bold text-dark stretched-link" href="{{ route('invoice.add') }}">New Sales Invoice</a></div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-edit fa-1x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>

                    <div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-1">
                                               <a class="small font-weight-bold text-dark stretched-link" href="{{ route('purchase.add') }}">New Purchase Invoice</a></div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-paste fa-1x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>

                    <div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-1">
                                               <a class="small font-weight-bold text-dark stretched-link" href="{{ route('products.add') }}">New Product </a></div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-1x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>
                    <div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-1">
                                               <a class="small font-weight-bold text-dark stretched-link" href="{{ route('customers.add') }}">New Customer </a></div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-plus fa-1x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>
				</div>
			</div>
            <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="chooseStoreModal">
                                    <div class="modal-dialog modal-sm" role="document">
                                      <div class="modal-content">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="name">Choose Store</label>
                                                    <select class="form-control form-control" name="store_id" id="store_id">
                                                      <option value="">Select Store</option>
                                                      <option value="male">Visioncraft - Chembur</option>
                                                      <option value="female">Visioncraft - Kurla</option>                                
                                                  </select>
                                                </div>
                                               
                                            </div>
                                        </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                          </div>
                                      </div>
                                    </div>
            </div>
			
	</main>
	<!--<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid">
			
		</div>
	</footer>-->
</div>
<script type="text/javascript">

    $(document).ready(function() {
    $('#filter_duration').on('change',function(){
        var store = $( ".store_filter option:selected" ).val();
      var duration =  $( ".duration_filter option:selected" ).val();
      var token = $(this).data('token');
      var base_url = $(this).data('url');
         $.ajax({
            url:base_url+'/update_stats',
            type: 'POST',
            data: { "_token" :"{{ csrf_token() }}",
                    "store" :store,
                    "duration" :duration },
            success:function(data){
                $('#purchasesTotal').html("&#x20B9; "+data.total);
                $('#customers').html(data.customers);
                $('#prescriptions').html(data.prescriptions);
                $('#orders').html(data.orders);
            }
         });
    
    })
    });
</script>
@endsection