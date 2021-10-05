@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('products.view') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Edit Product</span>
                    <small class="d-sm-block"><a href="{{ route('products.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Product List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update',$editData->id) }}" method="post" id="Product_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="vendor_id">Vendor Name</label>
                                <select class="form-control form-control-sm select2" name="vendor_id" id="vendor_id">
                                    
                                    @foreach ($vendor as $vendor)
                                    <option value="{{ $vendor->id }}" @if($editData->vendor_id == $vendor->id) selected="selected" @endif>{{ $vendor->company_name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="category">Product Category</label>
                                <select class="form-control form-control-sm select2" name="category_id" id="category-select">
                                    
                                    @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}" @if($editData->category_id == $cate->id) selected="selected" @endif>{{ $cate->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            </div>
                        <div class="form-row">    
                            <div class="form-group col-md-6">
                                <label for="product_model_no">Model No.</label>
                                <input type="text" class="form-control" name="product_model_no" value="{{ $editData->product_model_no }}" id="product_model_no" placeholder="Enter Model no.">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="product_collection">Collection</label>
                                <input type="text" class="form-control" name="product_collection" id="product_collection" value="{{ $editData->product_collection }}" placeholder="Enter Model collection">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="country_origin">Country Of Origin</label>
                                <select class="form-control form-control-sm select2"  name="country_origin" id="country-dropdown">

                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if($editData->country_origin == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                                    @endforeach

                                    
                                </select>
                            </div>

                        <div class="form-group col-md-3">
                                <label for="brand">Brand Name</label>
                                <select class="form-control form-control-sm select2" name="brand" id="brand">
                                   
                                 @foreach ($brands as $brand) 
                                                    <option value="{{$brand->name}}" @if($editData->brand == $brand->name) selected="selected" @endif>
                                                        {{$brand->name}}
                                                    </option>
                                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="frame_type">Frame Type</label>
                                <select class="form-control form-control-sm select2"  name="frame_type" id="frame_type">
                                    
                                    
                                    <option value="Full rim" @if($editData->frame_type == "Full rim") selected="selected" @endif>Full Rim</option>
                                    <option value="Half rim" @if($editData->frame_type == "Half rim") selected="selected" @endif>Half Rim</option>
                                    <option value="Rimless" @if($editData->frame_type == "Rimless") selected="selected" @endif>Rimless</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            
                            
                            <div class="form-group col-md-3">
                                <label for="frame_shape">Frame shape</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_shape }}" name="frame_shape" id="frame_shape">
                                    
                                    
                                    <option value="Rectangle" @if($editData->frame_shape == "Rectangle") selected="selected" @endif>Rectangle</option>
                                    <option value="Round" @if($editData->frame_shape == "Round") selected="selected" @endif>Round</option>
                                    <option value="Square" @if($editData->frame_shape == "Square") selected="selected" @endif>Square</option>
                                    <option value="Hexagonal" @if($editData->frame_shape == "Hexagonal") selected="selected" @endif>Hexagonal</option>
                                    <option value="Wayfarer" @if($editData->frame_shape == "Wayfarer") selected="selected" @endif>Wafarer</option>
                                    <option value="Cat eye" @if($editData->frame_shape == "Cat eye") selected="selected" @endif>Cat Eye</option>
                                    <option value="Aviator" @if($editData->frame_shape == "Aviator") selected="selected" @endif>Aviator</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="frame_shape">Frame size</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_size }}" name="frame_size" id="frame_size">
                                   
                                    
                                    <option value="Small" @if($editData->frame_size == "Small") selected="selected" @endif>Small (<132mm) </option>
                                    <option value="Medium" @if($editData->frame_size == "Medium") selected="selected" @endif>Medium (133mm - 138mm)</option>
                                    <option value="Large" @if($editData->frame_size == "Large") selected="selected" @endif>Large (>139mm)</option>
                                    
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="frame_dimension">Frame dimension (in mm)</label>
                                <input type="text" class="form-control" value="{{ $editData->frame_dimension }}" name="frame_dimension" id="frame_dimension">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="frame_width">Temple Length (in mm)</label>
                                <input type="text" class="form-control" value="{{ $editData->temple_length }}" id="temple_length" value="temple_length">
                            </div>
                            

                            <div class="form-group col-md-3">
                                <label for="height">Bridge Width (in mm)</label>
                                <input type="text" class="form-control" value="{{ $editData->bridge_width }}" id="bridge_width" value="bridge_width">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="height">Lens Width (in mm)</label>
                                <input type="text" class="form-control" value="{{ $editData->lens_width }}" name="lens_width" id="lens_width">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_color">Glass Color (For Sunglasses)</label>
                                <input type="text" class="form-control" value="{{ $editData->sunglass_color }}" name="sunglass_color" id="sunglass_color" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_lens_material">Lens Material (For Sunglasses)</label>
                                <input type="text" class="form-control" value="{{ $editData->sunglass_lens_material }}" name="sunglass_lens_material" id="sunglass_lens_material" placeholder="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="sunglass_lens_technology">Lens Technology (For Sunglasses)</label>
                                <input type="text" class="form-control" value="{{ $editData->sunglass_lens_technology }}" name="sunglass_lens_technology" id="sunglass_lens_technology" placeholder="">
                            </div>

                             <div class="form-group col-md-3">
                                <label for="frame_color">Frame colour</label>
                                <input type="text" class="form-control" name="frame_color" id="frame_color" value="{{ $editData->frame_color }}">
                                <!--<select class="form-control form-control-sm select2" value="{{ $editData->frame_color }}" name="frame_color" id="frame_color">
                                    
                                    <option value="Blue" @if($editData->frame_color == "Blue") selected="selected" @endif>Blue</option>
                                    <option value="Grey" @if($editData->frame_color == "Grey") selected="selected" @endif>Grey</option>
                                    <option value="Black" @if($editData->frame_color == "Black") selected="selected" @endif>Black</option>
                                    <option value="Brown" @if($editData->frame_color == "Brown") selected="selected" @endif>Brown</option>
                                    <option value="Yellow" @if($editData->frame_color == "Yellow") selected="selected" @endif>Yellow</option>
                                    <option value="Gold" @if($editData->frame_color == "Gold") selected="selected" @endif>Gold</option>
                                    <option value="Gunmetal" @if($editData->frame_color == "Gunmetal") selected="selected" @endif>Gunmetal</option>
                                    <option value="Green" @if($editData->frame_color == "Green") selected="selected" @endif>Green</option>
                                    <option value="Pink" @if($editData->frame_color == "Pink") selected="selected" @endif>Pink</option>
                                    <option value="Red" @if($editData->frame_color == "Red") selected="selected" @endif>Red</option>
                                    <option value="Rosemetal" @if($editData->frame_color == "Rosemetal") selected="selected" @endif>Rose Metal</option>    
                                    <option value="Silver" @if($editData->frame_color == "Silver") selected="selected" @endif>Silver</option>
                                </select>-->
                            </div>

                            <div class="form-group col-md-3">
                                <label for="temple_color">Temple colour</label>
                                <input type="text" class="form-control" name="temple_color" id="temple_color" value="{{ $editData->temple_color }}">

                                <!--<select class="form-control form-control-sm select2" value="{{ $editData->temple_color }}" name="temple_color" id="temple_color">

                                    <option value="Blue" @if($editData->temple_color == "Blue") selected="selected" @endif>Blue</option>
                                    <option value="Grey" @if($editData->temple_color == "Grey") selected="selected" @endif>Grey</option>
                                    <option value="Black" @if($editData->temple_color == "Black") selected="selected" @endif>Black</option>
                                    <option value="Brown" @if($editData->temple_color == "Brown") selected="selected" @endif>Brown</option>
                                    <option value="Yellow" @if($editData->temple_color == "Yellow") selected="selected" @endif>Yellow</option>
                                    <option value="Gold" @if($editData->temple_color == "Gold") selected="selected" @endif>Gold</option>
                                    <option value="Gunmetal" @if($editData->temple_color == "Gunmetal") selected="selected" @endif>Gunmetal</option>
                                    <option value="Green" @if($editData->temple_color == "Green") selected="selected" @endif>Green</option>
                                    <option value="Pink" @if($editData->temple_color == "Pink") selected="selected" @endif>Pink</option>
                                    <option value="Red" @if($editData->temple_color == "Red") selected="selected" @endif>Red</option>
                                    <option value="Rosemetal" @if($editData->temple_color == "Rosemetal") selected="selected" @endif>Rose Metal</option>    
                                    <option value="Silver" @if($editData->temple_color == "Silver") selected="selected" @endif>Silver</option>
                                    
                                </select>-->
                            </div>
                            <div class="form-group col-md-3">
                                <label for="frame_weight">Frame Weight</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_weight }}" name="frame_weight" id="frame_weight">
                                    
                                    <option value="Feather light" @if($editData->frame_weight == "Feather light") selected="selected" @endif>Feather light (less than 10gm)</option>
                                    <option value="Light" @if($editData->frame_weight == "Light") selected="selected" @endif>Light weight(between 10-20gm)</option>
                                    <option value="Average weight" @if($editData->frame_weight == "Average weight") selected="selected" @endif> Average in weight(between 20-40gm)</option>
                                    <option value="Above average" @if($editData->frame_weight == "Above average") selected="selected" @endif>Above average (More than 40 gm)</option>
                                </select>
                            </div>

                             <div class="form-group col-md-3">
                                <label for="frame_material">Frame Material</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_material }}" name="frame_material" id="frame_material">
                                    
                                    <option value="">Select Frame Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate" @if($editData->frame_material == "Acetate") selected="selected" @endif>Acetate</option>
                                                        <option value="HD Acetate" @if($editData->frame_material == "HD Acetate") selected="selected" @endif>HD Acetate</option>
                                                        <option value="TR-90" @if($editData->frame_material == "TR-90") selected="selected" @endif>TR-90</option>
                                                        <option value="Plastic - Others" @if($editData->frame_material == "Plastic - Others") selected="selected" @endif>Plastic - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy" @if($editData->frame_material == "Alloy") selected="selected" @endif>Alloy</option>
                                                        <option value="Titanium" @if($editData->frame_material == "Titanium") selected="selected" @endif>Titanium</option>
                                                        <option value="Aluminium" @if($editData->frame_material == "Aluminium") selected="selected" @endif>Aluminium</option>
                                                        <option value="Stainless steel" @if($editData->frame_material == "Stainless steel") selected="selected" @endif>Stainless steel</option>
                                                        <option value="Metal - Others" @if($editData->frame_material == "Metal - Others") selected="selected" @endif>Metal - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood" @if($editData->frame_material == "Wood") selected="selected" @endif>Wood</option>
                                                        <option value="Rubber" @if($editData->frame_material == "Rubber") selected="selected" @endif>Rubber</option>
                                                        <option value="Carbon" @if($editData->frame_material == "Carbon") selected="selected" @endif>Carbon</option>
                                                        <option value="Nylon" @if($editData->frame_material == "Nylon") selected="selected" @endif>Nylon</option>
                                                        <option value="Others" @if($editData->frame_material == "Others") selected="selected" @endif>Others</option>                       
                                    </optgroup>
                                </select>
                            </div>

                             <div class="form-group col-md-3">
                                <label for="temple_material">Temple Material</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->temple_material }}" name="temple_material" id="temple_material">
                                  <option value="">Select Temple Material</option>
                                                      <optgroup label="Plastic">
                                                        <option value="Acetate" @if($editData->temple_material == "Acetate") selected="selected" @endif>Acetate</option>
                                                        <option value="HD Acetate" @if($editData->temple_material == "HD Acetate") selected="selected" @endif>HD Acetate</option>
                                                        <option value="TR-90" @if($editData->temple_material == "TR-90") selected="selected" @endif>TR-90</option>
                                                        <option value="Plastic - Others" @if($editData->temple_material == "Plastic - Others") selected="selected" @endif>Plastic - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Metal">
                                                        <option value="Alloy" @if($editData->temple_material == "Alloy") selected="selected" @endif>Alloy</option>
                                                        <option value="Titanium" @if($editData->temple_material == "Titanium") selected="selected" @endif>Titanium</option>
                                                        <option value="Aluminium" @if($editData->temple_material == "Aluminium") selected="selected" @endif>Aluminium</option>
                                                        <option value="Stainless steel" @if($editData->temple_material == "Stainless steel") selected="selected" @endif>Stainless steel</option>
                                                        <option value="Metal - Others" @if($editData->temple_material == "Metal - Others") selected="selected" @endif>Metal - Others</option>
                                                      </optgroup>
                                                      <optgroup label="Others">
                                                        <option value="Wood" @if($editData->temple_material == "Wood") selected="selected" @endif>Wood</option>
                                                        <option value="Rubber" @if($editData->temple_material == "Rubber") selected="selected" @endif>Rubber</option>
                                                        <option value="Carbon" @if($editData->temple_material == "Carbon") selected="selected" @endif>Carbon</option>
                                                        <option value="Nylon" @if($editData->temple_material == "Nylon") selected="selected" @endif>Nylon</option>
                                                        <option value="Others" @if($editData->temple_material == "Others") selected="selected" @endif>Others</option>                       
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="prescription_type">Prescription Type</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->prescription_type }}" name="prescription_type" id="prescription_type">
                                    <option value="Single vision/Bifocal/Progressive" @if($editData->prescription_type == "Single vision/Bifocal/Progressive") selected="selected" @endif>Single vision/Bifocal/Progressive</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->gender }}" name="gender" id="gender">
                                    
                                    <option value="Male" @if($editData->gender == "Male") selected="selected" @endif>Male</option>
                                    <option value="Female" @if($editData->gender == "Female") selected="selected" @endif>Female</option>
                                    <option value="Unisex" @if($editData->gender == "Unisex") selected="selected" @endif>Unisex</option>
                                    
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                 <input type="hidden" class="form-control" name="frame_style" id="frame_style" placeholder="" value="{{ $editData->frame_style }}">
                             <!--   <label for="frame_style">Frame Style</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_style }}" name="frame_style" id="frame_style">
                                    
                                    <option value="Standard" @if($editData->frame_style == "Standard") selected="selected" @endif>Standard</option>
                                    
                                    <option value="Others" @if($editData->frame_style == "Others") selected="selected" @endif>Others</option>
                                </select>-->
                            </div>
                            <div class="form-group col-md-3">
                                <input type="hidden" class="form-control" name="frame_style_secondary" id="frame_style_secondary" placeholder="" value="{{ $editData->frame_style_secondary }}">
                                <!--
                                <label for="frame_style_secondary">Frame Style Secondary</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->frame_style_secondary }}" name="frame_style_secondary" id="frame_style_secondary">
                                    
                                    <option value="Youth" @if($editData->frame_style_secondary == "Youth") selected="selected" @endif>Youth</option>
                                    
                                    <option value="Others" @if($editData->frame_style_secondary == "Others") selected="selected" @endif>Others</option>
                                </select>-->
                            </div>

                            
                            <div class="form-group col-md-3">
                                <input type="hidden" class="form-control" name="product_condition" id="product_condition" placeholder="" value="{{ $editData->product_condition }}">
                                <input type="hidden" class="form-control" name="product_warranty" id="product_warranty" placeholder="" value="{{ $editData->product_warranty }}">
                            <!--
                                <label for="product_condition">Product Condition</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->product_condition }}" name="product_condition" id="product_condition">
                                    
                                    <option value="New" @if($editData->product_condition == "New") selected="selected" @endif>New</option>
                                    
                                    <option value="Others" @if($editData->product_condition == "Others") selected="selected" @endif>Others</option>
                                </select>-->
                            </div>
                            <!--
                             <div class="form-group col-md-3">
                                <label for="product_warranty">Warranty</label>
                                <select class="form-control form-control-sm select2" value="{{ $editData->product_warranty }}" name="product_warranty" id="product_warranty">
                                    <option value="Default(1year)" @if($editData->product_warranty == "Default(1year)") selected="selected" @endif>Standard (1 Year Manufacturer Warranty)</option>
                                </select>
                            </div>-->
                            <div class="form-group col-md-3">
                                <label for="contact_lens_type">Lens Type (For Contact Lens)</label>
                                <select class="form-control form-control-sm select2" name="contact_lens_type" id="contact_lens_type">
                                    <option value="">Select Lens Type</option>
                                    <option value="Daily" @if($editData->contact_lens_type == "Daily") selected="selected" @endif>Daily</option>
                                    <option value="Weekly" @if($editData->contact_lens_type == "Weekly") selected="selected" @endif>Weekly</option>
                                    <option value="Fortnigthly" @if($editData->contact_lens_type == "Fortnigthly") selected="selected" @endif>Fortnigthly</option>
                                    <option value="Monthly" @if($editData->contact_lens_type == "Monthly") selected="selected" @endif>Monthly</option>
                                    <option value="Yearly" @if($editData->contact_lens_type == "Yearly") selected="selected" @endif>Yearly</option>
                                </select>
                            </div>
                             <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="base_curve">Base Curve (in mm)</label>
                                    <input type="text" class="form-control" name="base_curve" value="{{ $editData->base_curve }}" id="base_curve" placeholder="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="contact_lens_color">Lens Color (For Contact Lens)</label>
                                    <input type="text" class="form-control" name="contact_lens_color" value="{{ $editData->contact_lens_color }}" id="contact_lens_color" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="contact_lens_diameter">Lens Diameter (in mm)</label>
                                <input type="text" class="form-control" name="contact_lens_diameter" value="{{ $editData->contact_lens_diameter }}" id="contact_lens_diameter" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="water_content">Water Content (in %)</label>
                                <input type="text" class="form-control" name="water_content" value="{{ $editData->water_content }}" id="water_content" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="contact_lens_material">Lens Material</label>
                                <input type="text" class="form-control" name="contact_lens_material" value="{{ $editData->contact_lens_material }}" id="contact_lens_material" placeholder="">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="contact_lens_packaging">Packaging</label>
                                <input type="text" class="form-control" name="contact_lens_packaging" value="{{ $editData->contact_lens_packaging }}" id="contact_lens_packaging" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="usage_duration">Usage Duration</label>
                                    <input type="text" class="form-control" name="usage_duration" value="{{ $editData->usage_duration }}" id="usage_duration" placeholder="">
                                </div>
                            </div>
                                <div class="form-group col-md-4">
                                <label for="contact_lens_solution_qty">Solution Quantity (For contact lens solution)</label>
                                <input type="text" class="form-control" value="{{ $editData->contact_lens_solution_qty }}" name="contact_lens_solution_qty" id="contact_lens_solution_qty" placeholder="">
                                </div>
                             </div>
                        </div>
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
      $('#Product_form').validate({
        rules: {
          name: {
            required: true,
          },
          supplier_id: {
            required: true
          },
          unit_id: {
            required: true,
            
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