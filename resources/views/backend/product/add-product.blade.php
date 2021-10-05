@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('products.view') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Product</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Product</span>
                    <small class="d-sm-block"><a href="{{ route('products.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Product List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="post" id="Product_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="vendor_id">Vendor Name</label>
                                <select class="form-control form-control-sm select2" name="vendor_id" id="vendor_id">
                                    <option value="">Select vendor</option>
                                    @foreach ($vendor as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->company_name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="category">Product Category</label>
                                <select class="form-control form-control-sm select2" name="category_id" id="category-select">
                                    <option value="">Select Product Category</option>
                                    @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}" id="{{ $cate->name }}">{{ $cate->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                        
               
                            <div class="form-group col-md-4">
                                <label for="product_model_no">Model No.</label>
                                <input type="text" class="form-control" name="product_model_no" id="product_model_no" placeholder="Enter Model no.">
                            </div>
                            
                            
                            <div class="form-group col-md-4">
                                <label for="product_collection">Collection</label>
                                <input type="text" class="form-control" name="product_collection" id="product_collection" placeholder="Enter Model collection">
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="country_origin">Country Of Origin</label>
                                <select class="form-control form-control-sm select2" name="country_origin" id="country-dropdown">
                                                 <option value="">Select Country</option>
                                                 @foreach ($countries as $country) 
                                                    <option value="{{$country->id}}">
                                                        {{$country->name}}
                                                    </option>
                                                  @endforeach
                                              </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="brand">Brand Name</label>
                                <select class="form-control form-control-sm select2" name="brand" id="brand">
                                   
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand) 
                                                    <option value="{{$brand->name}}">
                                                        {{$brand->name}}
                                                    </option>
                                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="frame_type">Frame Type</label>
                                <select class="form-control form-control-sm select2" name="frame_type" id="frame_type">
                                    
                                    <option value="">Select Frame Type</option>
                                    <option value="Full rim">Full Rim</option>
                                    <option value="Half rim">Half Rim</option>
                                    <option value="Rimless">Rimless</option>
                                    
                                </select>
                            </div>
                        
                                                 
                            <div class="form-group col-md-3">
                                <label for="frame_shape">Frame shape</label>
                                <select class="form-control form-control-sm select2" name="frame_shape" id="frame_shape">
                                    
                                    <option value="">Select Frame shape</option>
                                    <option value="Rectangle">Rectangle</option>
                                    <option value="Round">Round</option>
                                    <option value="Square">Square</option>
                                    <option value="Hexagonal">Hexagonal</option>
                                    <option value="Wayfarer">Wafarer</option>
                                    <option value="Cat eye">Cat Eye</option>
                                    <option value="Aviator">Aviator</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="frame_size">Frame size</label>
                                <select class="form-control form-control-sm select2" name="frame_size" id="frame_size">    
                                    <option value="">Select Frame size</option>
                                    <option value="Small">Small (<132mm) </option>
                                    <option value="Medium">Medium (133mm - 138mm)</option>
                                    <option value="Large">Large (>139mm)</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="frame_dimension">Frame dimension (in mm)</label>
                                <input type="text" class="form-control" name="frame_dimension" id="frame_dimension" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="temple_length">Temple Length (in mm)</label>
                                <input type="text" class="form-control" name="temple_length" id="temple_length" placeholder="">
                            </div>
                            

                            <div class="form-group col-md-3">
                                <label for="bridge_width">Bridge Width (in mm)</label>
                                <input type="text" class="form-control" name="bridge_width" id="bridge_width" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="lens_width">Lens Width (in mm)</label>
                                <input type="text" class="form-control" name="lens_width" id="lens_width" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_color">Glass Color (For Sunglasses)</label>
                                <input type="text" class="form-control" name="sunglass_color" id="sunglass_color" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_lens_material">Lens Material (For Sunglasses)</label>
                                <input type="text" class="form-control" name="sunglass_lens_material" id="sunglass_lens_material" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_lens_technology">Lens Technology (For Sunglasses)</label>
                                <input type="text" class="form-control" name="sunglass_lens_technology" id="sunglass_lens_technology" placeholder="">
                            </div>

                             <div class="form-group col-md-3">
                                <label for="frame_color">Frame colour</label>
                                <input type="text" class="form-control" name="frame_color" id="frame_color" placeholder="">
                               <!--<select class="form-control form-control-sm select2" name="frame_color" id="frame_color">
                                    <option value="">Select Frame colour</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Grey">Grey</option>
                                    <option value="Black">Black</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Gunmetal">Gunmetal</option>
                                    <option value="Green">Green</option>
                                    <option value="Pink">Pink</option>
                                    <option value="Red">Red</option>
                                    <option value="Rosemetal">Rose Metal</option>    
                                    <option value="Silver">Silver</option>
                                </select> -->
                            </div>

                            <div class="form-group col-md-3">
                                <label for="temple_color">Temple colour</label>
                                <input type="text" class="form-control" name="temple_color" id="temple_color" placeholder="">
                                <!--<select class="form-control form-control-sm select2" name="temple_color" id="temple_color">
                                    <option value="">Select Temple colour</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Grey">Grey</option>
                                    <option value="Black">Black</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Gunmetal">Gunmetal</option>
                                    <option value="Green">Green</option>
                                    <option value="Pink">Pink</option>
                                    <option value="Red">Red</option>
                                    <option value="Rosemetal">Rose Metal</option>    
                                    <option value="Silver">Silver</option>
                                </select>-->
                            </div>
                            <div class="form-group col-md-3">
                                <label for="frame_weight">Frame Weight</label>
                                <select class="form-control form-control-sm select2" name="frame_weight" id="frame_weight">
                                    <option value="">Select Frame weight</option>
                                    <option value="Feather light">Feather light (less than 10gm)</option>
                                    <option value="Light">Light weight(between 10-20gm)</option>
                                    <option value="Average weight"> Average in weight(between 20-40gm)</option>
                                    <option value="Above average">Above average (More than 40 gm)</option>
                                </select>
                            </div>

                           <div class="form-group col-md-3">
                                                  <label for="frame_material">Frame Material</label>
                                                  <select class="form-control form-control-sm select2" name="frame_material" id="frame_material">
                                                      <option value="">Select Frame Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate">Acetate</option>
                                                        <option value="HD Acetate">HD Acetate</option>
                                                        <option value="TR-90">TR-90</option>
                                                        <option value="Plastic - Others">Plastic - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy">Alloy</option>
                                                        <option value="Titanium">Titanium</option>
                                                        <option value="Aluminium">Aluminium</option>
                                                        <option value="Stainless steel">Stainless steel</option>
                                                        <option value="Metal - Others">Metal - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood">Wood</option>
                                                        <option value="Rubber">Rubber</option>
                                                        <option value="Carbon">Carbon</option>
                                                        <option value="Nylon">Nylon</option>
                                                        <option value="Others">Others</option>                       
                                                      </optgroup>
                                                  </select>
                                              </div>

                                               <div class="form-group col-md-3">
                                                  <label for="temple_material">Temple Material</label>
                                                  <select class="form-control form-control-sm select2" name="temple_material" id="temple_material">
                                                      <option value="">Select Temple Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate">Acetate</option>
                                                        <option value="HD Acetate">HD Acetate</option>
                                                        <option value="TR-90">TR-90</option>
                                                        <option value="Plastic - Others">Plastic - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy">Alloy</option>
                                                        <option value="Titanium">Titanium</option>
                                                        <option value="Aluminium">Aluminium</option>
                                                        <option value="Stainless steel">Stainless steel</option>
                                                        <option value="Metal - Others">Metal - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood">Wood</option>
                                                        <option value="Rubber">Rubber</option>
                                                        <option value="Carbon">Carbon</option>
                                                        <option value="Nylon">Nylon</option>
                                                        <option value="Others">Others</option>                       
                                                      </optgroup>
                                                  </select>
                                              </div>
                            <div class="form-group col-md-3">
                                <label for="prescription_type">Prescription Type</label>
                                <select class="form-control form-control-sm select2" name="prescription_type" id="prescription_type">
                                    <option value="">Select Prescription Type</option>
                                    <option value="Single vision/Bifocal/Progressive">Single vision/Bifocal/Progressive</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control-sm select2" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unisex">Unisex</option>
                                    
                                </select>
                            </div>
                            
                                <!--
                                <label for="product_warranty">Warranty</label>
                                <select class="form-control form-control-sm select2" name="product_warranty" id="product_warranty">
                                    <option value="Default(1year)">Standard (1 Year Manufacturer Warranty)</option>
                                </select>-->
                            
                            
                             
                            <div class="form-group col-md-3">
                                <label for="contact_lens_type">Lens Type (For Contact Lens)</label>
                                <select class="form-control form-control-sm select2" name="contact_lens_type" id="contact_lens_type">
                                    <option value="">Select Lens Type</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Fortnigthly">Fortnigthly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                </select>
                            </div>
                                <div class="form-group col-md-2">
                                <label for="base_curve">Base Curve (in mm)</label>
                                <input type="text" class="form-control" name="base_curve" id="base_curve" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                <label for="contact_lens_color">Lens Color (For Contact Lens)</label>
                                <input type="text" class="form-control" name="contact_lens_color" id="contact_lens_color" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                <label for="contact_lens_diameter">Lens Diameter (in mm)</label>
                                <input type="text" class="form-control" name="contact_lens_diameter" id="contact_lens_diameter" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="water_content">Water Content (in %)</label>
                                <input type="text" class="form-control" name="water_content" id="water_content" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="contact_lens_material">Lens Material</label>
                                <input type="text" class="form-control" name="contact_lens_material" id="contact_lens_material" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="contact_lens_packaging">Packaging</label>
                                <input type="text" class="form-control" name="contact_lens_packaging" id="contact_lens_packaging" placeholder="">
                                </div>

                                 <div class="form-group col-md-2">
                                    <label for="usage_duration">Usage Duration</label>
                                    <input type="text" class="form-control" name="usage_duration" id="usage_duration" placeholder="">
                                </div>
                        
                                
                                
                                <div class="form-group col-md-3">
                                    <label for="contact_lens_solution_qty">Solution Quantity (in ml)</label>
                                    <input type="text" class="form-control" name="contact_lens_solution_qty" id="contact_lens_solution_qty" placeholder="">
                                </div>
    
                                <div class="form-group col-md-3">
                               

                                <input type="hidden" class="form-control" name="frame_style" id="frame_style" placeholder="" value="Standard"><!--
                                <select class="form-control form-control-sm select2" name="frame_style" id="frame_style">
                                    <option value="">Select Frame style</option>


                                    <option value="Standard">Standard</option>
                                    
                                    <option value="Others">Others</option>
                                </select>-->
                            </div>
                            <div class="form-group col-md-3">
                                <input type="hidden" class="form-control" name="frame_style_secondary" id="frame_style_secondary" placeholder="" value="Youth">
                                <!--
                                <label for="frame_style_secondary">Frame Style Secondary</label>
                                <select class="form-control form-control-sm select2" name="frame_style_secondary" id="frame_style_secondary">
                                    <option value="">Select Frame style secondary</option>
                                    <option value="Youth">Youth</option>
                                    
                                    <option value="Others">Others</option>
                                </select> -->
                            </div>

                            <div class="form-group col-md-3">


                                <input type="hidden" class="form-control" name="product_condition" id="product_condition" placeholder="" value="New">
                                <input type="hidden" class="form-control" name="product_warranty" id="product_warranty" placeholder="" value="Standard (1 Year Manufacturer Warranty)">
                                <!--
                                <label for="product_condition">Product Condition</label>
                                <select class="form-control form-control-sm select2" name="product_condition" id="product_condition">
                                    <option value="">Select Product condition</option>
                                    <option value="New">New</option>
                                    
                                    <option value="Others">Others</option>
                                </select>-->
                            </div>
                            
                        </div>
                
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
	<footer class="py-4 bg-light mt-auto">
		<!--<div class="container-fluids			<div class="d-flex align-items-center justify-content-between small">
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
        /*$("#category-select").change(function(){
            $(this).find("option:selected").each(function(){
                var categoryName = $(this).attr("id");
                 if(categoryName){
                        $(".specs").not("." + categoryName).hide();
                        $("." + categoryName).show();
                    } else{
                        $(".specs").hide();
                    }
            });

        }).change();
*/
      $('#Product_form').validate({
        ignore: [],
        rules: {
          product_model_no: {
            required: true,
          },
          product_collection: {
            required: true,
          },
          vendor_id: {
            required: true
          },          
          category_id: {
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
@endsection