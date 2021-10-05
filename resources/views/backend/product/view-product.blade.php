@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
         <br>   
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Product</span>
                    <small class="d-sm-block"><a href="{{ route('products.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Product</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>                                   
                                    <th>Category</th>
                                    <th>Brand Name</th>
                                    <th>Collection</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($alldata as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product['category']['name'] }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->product_collection }}</td>
                                    <td>{{ $product->product_model_no }}</td>                                   
                                    
                                    
                                    <td>

                                    <a role="button" type="button" class="btn dropdown" id="dropdownMenuButton-{{$product->id}}" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{$product->id}}">
                                          <a class="dropdown-item" href="../products/edit/{{ $product->id }}">Edit</a>
                                          <a class="dropdown-item" class="btn btn-link" data-toggle="modal" data-target="#OpenquickviewProduct-{{$product->id}}">Quick View</a>
                                              </div> 
                                    
                                        
                                    </td>
                                   
                                 
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>

            </div>

            @foreach ($alldata as $key => $product)
                                    <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="OpenquickviewProduct-{{$product->id}}" tabindex="-1" aria-labelledby="OpenquickviewProduct-{{$product->id}}" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="OpenquickviewProduct-{{$product->id}}">Quick view</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <?php $category = DB::table('categories')->where('id', $product->category_id)->first(); ?>
                                                    <p class="text-secondary mb-1"><span class="badge badge-pill badge-primary">{{ $category->name }}</span></span> <strong> ></strong> <span class="mb-2 text-muted text-uppercase small"><strong>{{ $product->brand }}</strong></p>
                                                    <br><h4>{{ $product->product_model_no }}</h4>
                                                    <table class="table table-sm table-borderless mb-0">
                                                          <tbody>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Collection</th>
                                                              <td>{{ $product->product_collection }}</td>
                                                              <th class="pl-0 w-25" scope="row">Country Of Origin</th>
                                                              <?php $country = DB::table('countries')->where('id', $product->country_origin)->first(); ?>
                                                              @if(!empty($country))
                                                              <td>{{ $country->name }}</td>
                                                              @endif
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Frame Type</th>
                                                              <td>{{ $product->frame_type }}</td>
                                                              <th class="pl-0 w-25" scope="row">Frame Shape</th>
                                                              <td>{{ $product->frame_shape }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Frame Size</th>
                                                              <td>{{ $product->frame_size }}</td>
                                                              <th class="pl-0 w-25" scope="row">Frame Dimension</th>
                                                              <td>{{ $product->frame_dimension }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Temple Length</th>
                                                              <td>{{ $product->temple_length }}</td>
                                                              <th class="pl-0 w-25" scope="row">Bridge Width</th>
                                                              <td>{{ $product->bridge_width }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Lens Width</th>
                                                              <td>{{ $product->lens_width }}</td>
                                                              <th class="pl-0 w-25" scope="row">Sunglass Color</th>
                                                              <td>{{ $product->sunglass_color }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Lens Material (For Sunglasses)</th>
                                                              <td>{{ $product->sunglass_lens_material }}</td>
                                                              <th class="pl-0 w-25" scope="row">Lens Technology (For Sunglasses)</th>
                                                              <td>{{ $product->sunglass_lens_technology  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Frame Material</th>
                                                              <td>{{ $product->frame_color }}</td>
                                                              <th class="pl-0 w-25" scope="row">Temple Color</th>
                                                              <td>{{ $product->temple_color  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Frame Weight</th>
                                                              <td>{{ $product->frame_weight }}</td>
                                                              <th class="pl-0 w-25" scope="row">Frame Material</th>
                                                              <td>{{ $product->frame_material  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Lens Material (For Sunglasses)</th>
                                                              <td>{{ $product->sunglass_lens_material }}</td>
                                                              <th class="pl-0 w-25" scope="row">Lens Technology (For Sunglasses)</th>
                                                              <td>{{ $product->sunglass_lens_technology  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Temple Material</th>
                                                              <td>{{ $product->temple_material }}</td>
                                                              <th class="pl-0 w-25" scope="row">Prescription Type</th>
                                                              <td>{{ $product->prescription_types  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Frame Style</th>
                                                              <td>{{ $product->frame_style }}</td>
                                                              <th class="pl-0 w-25" scope="row">Frame Style Secondary</th>
                                                              <td>{{ $product->frame_style_secondary  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Gender</th>
                                                              <td>{{ $product->gender }}</td>
                                                              <th class="pl-0 w-25" scope="row">Product Condition</th>
                                                              <td>{{ $product->product_condition  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Product Warranty</th>
                                                              <td>{{ $product->product_warranty }}</td>
                                                              <th class="pl-0 w-25" scope="row">Lens Type (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_type  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Base curve (For Contact Lens)</th>
                                                              <td>{{ $product->base_curve }}</td>
                                                              <th class="pl-0 w-25" scope="row">Lens Color (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_color  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Lens Diameter (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_diameter }}</td>
                                                              <th class="pl-0 w-25" scope="row">Water Content (For Contact Lens)</th>
                                                              <td>{{ $product->water_content  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Lens Material (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_material }}</td>
                                                              <th class="pl-0 w-25" scope="row">Lens Packaging (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_packaging  }}</td>
                                                            </tr>
                                                            <tr>
                                                              <th class="pl-0 w-25" scope="row">Usage Duration (For Contact Lens)</th>
                                                              <td>{{ $product->usage_duration }}</td>
                                                              <th class="pl-0 w-25" scope="row">Solution Quantity (For Contact Lens)</th>
                                                              <td>{{ $product->contact_lens_solution_qty  }}</td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                </div>
                                              </div>
                                </div>
                @endforeach
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
@endsection