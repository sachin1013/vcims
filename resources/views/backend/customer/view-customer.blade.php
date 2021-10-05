@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Customers</span>
                    <small class="d-sm-block"><a href="{{ route('customers.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Customer</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Customer Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{ $alldate->links() }}
                            <tbody>
                                @foreach ($alldate as $key => $customer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->contact_no }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->user_type }}</td>
                                    @php
                                      $count_customer = App\Model\Payment::where('customer_id',$customer->id)->count();   
                                    @endphp
                                    <td>
                                      <a role="button" type="button" class="btn dropdown" id="dropdownMenuButton" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="../customers/edit/{{ $customer->id }}" target="_blank">Edit</a>
                                          <a class="dropdown-item" href="../customers/profile/{{ $customer->id }}" target="_blank">View</a>
                                        </div> 
                                      <!--  <a href="{{ route('customers.delete',$customer->id) }}" id="delete" title="Delete" class="btn btn-danger btn-sm {{ ($count_customer>0)?'disabled':''}}"><i class="fas fa-trash mr-1"></i></a>

                                           <a href="{{ route('customers.edit',$customer->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-1"></i></a>

                                        -->
                                        
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
	<script type="text/javascript">
	    $(document).ready(function() {
            $('#dataTable').DataTable( {
                "paging":   false
            } );
        } );
	</script>
</div>
@endsection