@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Prescription</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Prescription</span>
                    <small class="d-sm-block"><a href="{{ route('prescriptions.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Prescription</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Customer name</th>
                                    <th>Prescribed by</th>
                                    <th>Prescription quick view</th>
                                    <th>Prescription status</th>
                                    <th>Prescription condition</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            {{ $alldata->links() }}
                            <tbody>
                             @foreach ($alldata as $key => $prescription)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><?php
                                    $customer = DB::table('customers')->where('id', $prescription->customer_id)->first();
                                     ?>@if(!empty($customer->first_name))
			                      {{$customer->first_name}}@endif @if(!empty($customer->last_name)) {{$customer->last_name}}@endif</td>
                                    <td>{{ $prescription->doctor_name }}</td>
                                    <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#Openprescriptionmodal-{{$prescription->id}}"> Quick View</button>
                                    <div class="modal fade " id="Openprescriptionmodal-{{$prescription->id}}" tabindex="-1" aria-labelledby="Openprescriptionmodal-{{$prescription->id}}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="Openprescriptionmodal-{{$prescription->id}}">Prescription - Quick View</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <span style="font-weight:bold;font-size:15px;">Created On : </span> <span>&nbsp;{{ date('d-m-Y', strtotime($prescription->created_at)) }}</span>
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
                                                        <td>{{ $prescription->right_eye_sph }}</td>
                                                        <td>{{ $prescription->right_eye_cyl }}</td>
                                                        <td>{{ $prescription->right_eye_axis }}</td>
                                                        <td>{{ $prescription->right_eye_add }}</td>
                                                        <td>{{ $prescription->right_eye_va_dist }}</td>
                                                        <td>{{ $prescription->right_eye_va_near }}</td>
                                                        <td>{{ $prescription->right_eye_pd }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Left Eye</strong></td>
                                                        <td>{{ $prescription->left_eye_sph }}</td>
                                                        <td>{{ $prescription->left_eye_cyl }}</td>
                                                        <td>{{ $prescription->left_eye_axis }}</td>
                                                        <td>{{ $prescription->left_eye_add }}</td>
                                                        <td>{{ $prescription->left_eye_va_dist }}</td>
                                                        <td>{{ $prescription->left_eye_va_near }}</td>
                                                        <td>{{ $prescription->left_eye_pd }}</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    </td>
                                    
                                    <td><span class="badge badge-info">{{ ucfirst($prescription->status) }}</span></td>
                                    
                                    <td><span class="badge badge-warning">{{ ucfirst($prescription->prescription_condition) }}</span></td>
                                    <td><a role="button" type="button" class="btn dropdown" id="dropdownMenuButton-{{$prescription->id}}" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{$prescription->id}}">
                                          <a class="dropdown-item" href="../prescriptions/edit/{{ $prescription->id }}" target="_blank">Edit</a>
                                         
                                        
                                          <a class="dropdown-item" target="_blank" href="../prescriptions/print/{{ $prescription->id }}" target="_blank">Print Prescription</a>
                                              </div> </td>
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