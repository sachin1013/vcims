@extends('backend.layouts.master')
@section('content')

<div id="layoutSidenav_content">
<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('customers.view') }}">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
           
            <div class="card mb-4">
                <!--<div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Customers</span>
                    <small class="d-sm-block"><a href="{{ route('customers.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Customer</a></small>
                </div>-->
                <div class="card-body">
                   <div class="row gutters-sm">
			            <div class="col-md-4 mb-3">
			              <div class="card">
			                <div class="card-body">
			                  <div class="d-flex flex-column align-items-center text-center">
			                    <i class="fa fa-user-circle fa-7x" alt="Admin" width="150"></i>
			                    <div class="mt-3">
			                      <h4>{{$customer->first_name}} {{$customer->last_name}}</h4>
			                      <p class="text-secondary mb-1"><span class="badge badge-pill badge-primary">{{ $customer->user_type }}</span></p>
			                      <p class="text-muted font-size-sm">
									</p>
			                      </div>
			                  </div>
			                </div>
			              </div>		              
			            </div>
			            <div class="col-md-8">
			              <div class="card mb-3">
			                <div class="card-body">
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Full Name</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                    	@if(!empty($customer->first_name))
			                      {{$customer->first_name}}@endif @if(!empty($customer->last_name)) {{$customer->last_name}}@endif
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Date of Birth</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                      @if(!empty($customer->dob)){{$customer->dob}}@endif
			                      @if(!empty($customer->age))[{{$customer->age}}]@endif
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Email</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                      @if(!empty($customer->email)){{$customer->email}}@endif
			                    </div>
			                  </div>
			                  <hr>
			                 <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Mobile / Alternate Mobile No.</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                      @if(!empty($customer->contact_no)){{$customer->contact_no}}@endif / @if(!empty($customer->alt_contact_no)){{$customer->alt_contact_no}}@endif
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Address</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                    		<?php $addresses = DB::table('addresses')->where('cust_id', $customer->id)->get(); ?>
			                    		@if(count($addresses) > 1)
			                    			<p>more than 1 addresses</p>
			                    		@elseif(count($addresses) == 1)
			                    		@foreach($addresses as $address)
			                    		<?php $country = DB::table('countries')->where('id', $address->country)->first();
			                    		$state = DB::table('states')->where('id', $address->state)->first();
			                    		$city = DB::table('cities')->where('id', $address->city)->first(); ?>
			                    		<p>@if(!empty($address->address_line_1)){{$address->address_line_1}},@endif  @if(!empty($address->address_line_2)){{$address->address_line_2}},@endif @if(!empty($address->landmark)){{$address->landmark}},@endif @if(!empty($city->name)) {{$city->name}},@endif @if(!empty($state->name)){{$state->name}},@endif @if(!empty($country->name)) {{$country->name}},@endif @if(!empty($address->pincode)) {{$address->pincode}}@endif </p>
			                    		@endforeach
			                    		@else
			                    		<p>Hi</p>
			                    		@endif    
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Referred By</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">
			                      @if(!empty($customer->referred_by)){{$customer->referred_by}}@endif
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Customer Category / Family code</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">@if(!empty($customer->customer_code))
			                      <span class="badge badge-pill badge-warning"> {{ $customer->customer_code }}</span>  &nbsp; / @endif &nbsp;@if(!empty($customer->family_code)) <span class="badge badge-pill badge-success">{{$customer->family_code}}@endif</span>
			                    </div>
			                  </div>
			                  <hr>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Past Purchase reference / Invoice Date</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">@if(!empty($customer->reference_by))
			                      <span class="badge badge-pill badge-warning"> {{ $customer->reference_by }}</span>  &nbsp; / @endif &nbsp;@if(!empty($customer->remarks)) <span class="badge badge-pill badge-success">{{$customer->remarks}} / @endif</span>
			                      @if(!empty($customer->notes)) <span class="badge badge-pill badge-success">{{$customer->notes}}@endif</span>
			                    </div>
			                  </div>
			                  <hr/>
			                  <div class="row">
			                    <div class="col-sm-3">
			                      <h6 class="mb-0">Created on</h6>
			                    </div>
			                    <div class="col-sm-9 text-secondary">@if(!empty($customer->created_at))
			                      <span> {{ $customer->created_at }}</span>@endif
			                    </div>
			                  </div>
			                  <header></header>
			                </div>
			              </div>
			          	</div>
			        </div>
			                <div class="col-sm-6 mb-3">
			                  <div class="card h-100">
			                    <div class="card-body">
			                      <h3 class="d-flex align-items-center mb-3">Prescriptions</h3><br>
			                      <?php $prescriptions = DB::table('prescriptions')->where('customer_id', $customer->id)->get(); ?>
			                      @if(count($prescriptions) > 0)
			                      
			                      		<table class="table table-bordered" id="prescriptions-table" width="100%" cellspacing="0">
				                            <thead>
				                                <tr>
				                                    <th>Patient Name</th>                              
				                                    <th>Details</th>
				                                    <th>Dr. Name</th>
				                                    <th>Condition</th>
				                                </tr>
				                            </thead>
		                            
		                            		<tbody>@foreach($prescriptions as $prescription)
		                            			<tr>
		                            				<td>{{ $prescription->patient_name }}</td>			
		                            				<td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#OpenPrescriptionmodal-{{$prescription->id}}"> Quick View</button>
		                            				<div class="modal fade " id="OpenPrescriptionmodal-{{$prescription->id}}" tabindex="-1" aria-labelledby="OpenPrescriptionmodal-{{$prescription->id}}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="OpenPrescriptionmodal-{{$prescription->id}}">Prescription - Quick View</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <span class="presc-date"><strong>Prescribed On : </strong></span><span>{{ $prescription->created_at }}</span><br>
                                                <span class="presc-date"><strong>Prescribed By : </strong></span><span>{{ $prescription->doctor_name }}</span><br>
                                                <span class="presc-date"><strong>Prescription Condition : </strong></span><span>{{ $prescription->prescription_condition }}</span><br>
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
                                            <span class="presc-date"><strong>Remarks : </strong></span><span>{{ $prescription->remarks }}</span>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                              </div>
                                            </div>
                                          </div>
            						</div>
			                  
			                </div>
		                            				</td>  
		                            				<td>{{ $prescription->doctor_name }}</td>
		                            				<td>{{ $prescription->prescription_condition }}</td>
		                                        	
		                            			</tr>@endforeach


		                      				</tbody>
			                      		</table>
			                      @else
			                      	<p>No prescriptions are available</p>
			                      @endif
			                    </div>
			                  </div>
			                 
			                  
			        </div>			            
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
</div>
			


<script type="text/javascript">
	$(document).ready(function() {
	    $('#prescriptions-table').DataTable();
	    $('#purchases-tabless').DataTable();
	} );
</script>
@endsection