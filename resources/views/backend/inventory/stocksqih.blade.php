@extends('backend.layouts.master')
@section('content')

<div id="layoutSidenav_content">
	<main>
	<div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Stocks</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Product Stocks</span>
                    {{-- <small class="d-sm-block"><a href="{{ route('customers.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i></a></small> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Vendor Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Status</th>
                                    <th>Added By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $key => $stock)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <?php $category = DB::table('categories')->where('id',$stock->category_id)->first(); ?>
                                    <td>{{ $category->name }}</td>
                                    <?php $product = DB::table('products')->where('id',$stock->product_id)->first(); ?>
                                    @if(!empty($product))
                                    <td>{{ $product->product_model_no }}</td>
                                    @endif
                                    <?php $vendor = DB::table('vendors')->where('id',$stock->vendor_id)->first(); ?>
                                    @if(!empty($vendor))
                                    <td>{{ $vendor->company_name }}</td>
                                    @endif
                                    <td><span class="badge badge-danger">{{ $stock->quantity }}</span></td>
                                    <td>{{ $stock->unit_price }}</td> 
                                    @if($stock->status = '1')
                                    <td><span class="badge badge-warning">Active</span></td>
                                    @endif
                                    <?php $user = DB::table('users')->where('id',$stock->created_by)->first(); ?>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
@endsection