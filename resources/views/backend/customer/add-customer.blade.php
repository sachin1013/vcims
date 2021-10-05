@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Customer</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Customer</span>
                    <small class="d-sm-block"><a href="{{ route('customers.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Customers List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="post" id="customer">
                        @csrf
                        <div class="form-row">
                                                     
                           <div class="form-group col-md-4">
                                  <label for="first_name">First Name</label>
                                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="">
                                </div>
                                <div class=" form-group col-md-4">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user_type">Customer Type</label>
                                    <select class="form-control form-control-sm" name="user_type" id="user_type">
                                        <option value="B2C">B2C</option>
                                        <option value="B2B">B2B</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="organization_name">Organization </label>
                                    <input type="text" class="form-control" name="organization_name" id="organization_name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="designation">Designation </label>
                                    <input type="text" class="form-control" name="designation" id="designation">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gst_no">GSTIN (if applicable) </label>
                                    <input type="text" class="form-control" name="gst_no" id="gst_no">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="contact_no">Mobile No. </label>
                                  <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                   <label for="alt_contact_no">Alternate Contact No. </label>
                                  <input type="text" class="form-control" name="alt_contact_no" id="alt_contact_no" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control datepicker" name="dob" id="dob" placeholder="dd-mm-yyyy">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="gender">Gender</label>
                                    <select class="form-control form-control-sm" name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                              <div class="form-group col-md-3">
                                   <label for="customer_code">Customer Code </label>
                                    <select class="form-control form-control-sm" name="customer_code" id="customer_code">
                                        <option value="Bronze">Bronze [Upto &#x20B9;1200]</option>
                                        <option value="Silver">Silver [&#x20B9;1200 - &#x20B9;2499]</option>
                                        <option value="Gold">Gold [&#x20B9;2500 - &#x20B9;4000]</option>
                                        <option value="Platinum">Platinum[Above &#x20B9;4000]</option>
                                        <option value="VVIP">VVIP</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                   <label for="referred_by">Referred By </label>
                                  <input type="text" class="form-control" name="referred_by" id="referred_by" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                   <label for="family_code">Family Code </label>
                                  <input type="text" class="form-control" name="family_code" id="family_code" placeholder="">
                                </div>
                                  <input type="hidden" class="form-control" name="password" id="password" value="$2y$10$FhosaSZi/OUXWK2hVVVfKuLo3aF5bvIXVgzHoqpW/1S/XOCiak7c2" placeholder="">
                                <div class="form-group col-md-4">
                                   <label for="notes">Notes </label>
                                   <textarea rows = "3" class="form-control" name="notes" id="notes"> </textarea>
                                </div>

                              </div>
                              <div class="form-row" id="addressBlock">
                                <h3>Address</h3>
                                  <div class="form-row">                                     
                                         <div class="form-group col-md-6">
                                            <label for="address_line_1">Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Apartment No., Floor, Building Name">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="address_line_2">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Street name, Locality">
                                          </div>
                                          
                                          <div class="form-group col-md-4">
                                               <label for="country">Country</label>                                         
                                              <select class="form-control form-control-sm" name="country" id="country-dropdown">
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
                                                <select class="form-control form-control-sm" name="state" id="state-dropdown">
                                              </select>                                            
                                            </div>
                                           
                                           <div class="form-group col-md-4">
                                               <label for="city">City</label>
                                              <select class="form-control form-control-sm" name="city" id="city-dropdown">
                                              </select>
                                          </div>
                                        

                                           <div class="form-group col-md-4">
                                               <label for="landmark">Landmark</label>
                                              <input type="text" class="form-control" name="landmark" id="landmark">
                                          </div>
                                           <div class="form-group col-md-4">
                                               <label for="pincode">Pincode</label>
                                              <input type="text" class="form-control" name="pincode" id="pincode">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="address_type">Address Type</label>
                                              <select class="form-control form-control-sm" name="address_type" id="address_type">
                                                  <option value="Home">Home </option>
                                                  <option value="Office/Commercial">Office / Commercial </option>                 
                                              </select>
                                          </div>
                                  </div>
                              </div>

                             <!-- <div class="form-group">
                                <button type="button" name="add" id="addAddress" class="btn btn-success">Add More Addresses</button>
                              </div>
                        -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
          },
          customer_code: {
            required: true,
          },
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