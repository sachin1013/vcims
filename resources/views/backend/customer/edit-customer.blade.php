@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
         <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Customer</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-edit mr-1"></i>Edit Customer</span>
                    <small class="d-sm-block"><a href="{{ route('customers.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Customer List</a></small>
                </div>
                <div class="card-body">
                    <form action="../update/{{ $customer->id }}" method="post" id="editCustomer">
                        @csrf
                        <div class="form-row">
                                                     
                           <div class="form-group col-md-4">
                                  <label for="first_name">First Name</label>
                                  <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $customer->first_name }}">
                                </div>
                                <div class=" form-group col-md-4">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $customer->last_name }}">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $customer->email }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user_type">Customer Type</label>
                                    <select class="form-control form-control-sm" name="user_type" id="user_type">
                                        <option value="B2C" @if($customer->user_type == "B2C") selected="selected" @endif>B2C</option>
                                        <option value="B2B" @if($customer->user_type == "B2B") selected="selected" @endif>B2B</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="organization_name">Organization </label>
                                    <input type="text" class="form-control" name="organization_name" id="organization_name" value="{{ $customer->organization_name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="designation">Designation </label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="{{ $customer->designation }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gst_no">GSTIN (if applicable) </label>
                                    <input type="text" class="form-control" name="gst_no" id="gst_no" value="{{ $customer->gst_no }}">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="contact_no">Mobile No. </label>
                                  <input type="text" class="form-control" name="contact_no" id="contact_no" value="{{ $customer->contact_no }}">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="alt_contact_no">Alternate Contact No. </label>
                                  <input type="text" class="form-control" name="alt_contact_no" value="{{ $customer->alt_contact_no }}" id="alt_contact_no" placeholder="">
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control datepicker" name="dob" id="dob" value="{{ $customer->dob }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="gender">Gender</label>
                                    <select class="form-control form-control-sm" name="gender" id="gender">
                                        <option value="Male" @if($customer->gender == "Male") selected="selected" @endif>Male</option>
                                        <option value="Female" @if($customer->gender == "Female") selected="selected" @endif>Female</option>
                                        <option value="Others" @if($customer->gender == "Others") selected="selected" @endif>Others</option>
                                    </select>
                                </div>

                               
                                <div class="form-group col-md-3">
                                   <label for="customer_code">Customer Code </label>
                                    <select class="form-control form-control-sm" name="customer_code" id="customer_code">
                                        <option value="Bronze" @if($customer->customer_code == "Bronze") selected="selected" @endif>Bronze [Upto &#x20B9;1200]</option>
                                        <option value="Silver" @if($customer->customer_code == "Silver") selected="selected" @endif>Silver [&#x20B9;1200 - &#x20B9;2499]</option>
                                        <option value="Gold" @if($customer->customer_code == "Gold") selected="selected" @endif>Gold [&#x20B9;2500 - &#x20B9;4000]</option>
                                        <option value="Platinum" @if($customer->customer_code == "Platinum") selected="selected" @endif>Platinum[Above &#x20B9;4000]</option>
                                        <option value="VVIP" @if($customer->customer_code == "VVIP") selected="selected" @endif>VVIP</option>
                                    </select>
                                </div>
                                 <div class="form-group col-md-3">
                                   <label for="referred_by">Referred By </label>
                                  <input type="text" class="form-control" name="referred_by" id="referred_by" value="{{ $customer->referred_by }}">
                                </div>
                                <div class="form-group col-md-3">
                                   <label for="family_code">Family Code </label>
                                  <input type="text" class="form-control" name="family_code" id="family_code" value="{{ $customer->family_code }}">
                                </div>
                                  <input type="hidden" class="form-control" name="password" id="password" value="$2y$10$FhosaSZi/OUXWK2hVVVfKuLo3aF5bvIXVgzHoqpW/1S/XOCiak7c2" placeholder="">
                                <div class="form-group col-md-4">
                                   <label for="notes">Notes </label>
                                   <textarea rows = "3" class="form-control" name="notes" id="notes">{{ $customer->notes }} </textarea>
                                </div>

                              </div>
                              <?php $address = DB::table('addresses')->where('cust_id', $customer->id)->first(); ?>
                              @if(!empty($address))
                              <div class="form-row" id="addressBlock">
                                <h3>Address</h3>
                                  <div class="form-row">
                                     
                                         <div class="form-group col-md-6">
                                            <label for="address_line_1">Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1" id="address_line_1" value="{{ $address->address_line_1 }}">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="address_line_2">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2" id="address_line_2" value="{{ $address->address_line_2 }}">
                                          </div>
                                          
                                          <div class="form-group col-md-4">
                                               <label for="country">Country</label>
                                              
                                              <select class="form-control form-control-sm" name="country" id="country-dropdown">
                                                 
                                                 @foreach ($countries as $country) 
                                                  <option value="{{$country->id}}" @if($address->country == $country->id) selected="selected" @endif>
                                                  {{ $country->name }}
                                                </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          
                                          <div class="form-group col-md-4">
                                               <label for="state">State</label>
                                                <select class="form-control form-control-sm" name="state" id="state-dropdown">
                                                  <option value="{{$address->state}}">
                                                  <?php $state = DB::table('states')->where('id', $address->state)->first(); ?>
                                                  @if (!empty($state))
                                                    {{ $state->name }}
                                                  @else
                                                  @endif
                                                  </option>

                                              </select>                                            
                                            </div>
                                           
                                           <div class="form-group col-md-4">
                                               <label for="city">City</label>
                                              <select class="form-control form-control-sm" name="city" id="city-dropdown">
                                                 <option value="{{$address->state}}">
                                                  <?php $city = DB::table('cities')->where('id', $address->city)->first(); ?>
                                                  @if(!empty($city))
                                                    {{$city->name}}
                                                  @else
                                                  @endif</option>
                                                </select>
                                            </div>
                                        

                                           <div class="form-group col-md-4">
                                               <label for="landmark">Landmark</label>
                                              <input type="text" class="form-control" name="landmark" id="landmark" value="{{ $address->landmark }}">
                                          </div>
                                           <div class="form-group col-md-4">
                                               <label for="pincode">Pincode</label>
                                              <input type="text" class="form-control" name="pincode" id="pincode" value="{{ $address->pincode }}">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="address_type">Address Type</label>
                                              <select class="form-control form-control-sm" name="address_type" id="address_type">
                                                  <option value="home" @if($address->address_type == "home") selected="selected" @endif>Home </option>
                                                  <option value="office" @if($address->address_type == "office") selected="selected" @endif>Office / Commercial </option>
                                                  
                                              </select>
                                          </div>
                                  </div>
                              </div>
                                @endif
                             <!-- <div class="form-group">
                                <button type="button" name="add" id="addAddress" class="btn btn-success">Add More Addresses</button>
                              </div>
                        -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
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

<script>
    $(document).ready(function () {
        $('#user_type').select2();
        $('#gender').select2();
        $('#customer_code').select2();
        $('#country-dropdown').select2();
        $('#state-dropdown').select2();
        $('#city-dropdown').select2();
        $('#address_type').select2();
      
      $('#customer').validate({
        rules: {
          first_name: {
            required: true,
          },
          last_name: {
            required: true,            
          },
          email: {
            email: true,
          },
          user_type: {
            required: true,
           
          },
          contact_no: {
            required: true,
            minlength:9,
            maxlength:10,
            number: true,
          },
          alt_contact_no: {
            minlength:9,
            maxlength:10,
            number: true,
          },
          gst_no: {
            maxlength:15,
          },
          pincode: {
            number: true,
            maxlength:6,
          },
          gender: {
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
        }
      });
    });
    </script>
     <script>
      var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#dob').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd',
           maxDate: today
      });
  </script>

  <script>
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

<script type="text/javascript">
  var i= 0;
  $("#addAddress").click(function(){
   
        ++i;
   
        $("#addressBlock").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

   $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
</script>

@endsection