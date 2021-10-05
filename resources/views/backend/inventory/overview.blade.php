@extends('backend.layouts.master')
@section('content')

<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid"><br>
			<h1 class="mt-4" style="display:inline;">Inventory Overview</h1> &nbsp;&nbsp;&nbsp;
			    
					  <br><br>
					  
			    <div class="row" id="dashboard_tile">
				<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
				  
               
                    
                    
				
				<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Products</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="purchasesTotal">{{ $product_count }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-muted"></i>
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
                                               Total Quantity</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="customers">{{ $product_quantity }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hand-holding fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Product To Reorder</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="prescriptions">{{ $reorder_count }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-stream fa-2x text-muted"></i>
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
                                                Stock Valuation</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="orders">{{ $inventory_val }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hand-holding-usd fa-2x text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				<br>
			
			</div>
            
			
	</main>
	<!--<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid">
			
		</div>
	</footer>-->
</div>
@endsection