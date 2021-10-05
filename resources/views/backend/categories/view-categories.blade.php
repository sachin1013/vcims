@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Categories</span>
                    <small class="d-sm-block"><a href="{{ route('categories.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Categories</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>CGST Rate</th>
                                    <th>SGST Rate</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($catedata as $key => $cate)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $cate->name }}</td>
                                    <td>{{ $cate->cgst_perc }}</td>
                                    <td>{{ $cate->sgst_perc }}</td>
                                    <td>{{ $cate->description }}</td>
                                    @php
                                      $count_category = App\Model\Product::where('category_id',$cate->id)->count();   
                                    @endphp
                                    <td>
                                         <a role="button" type="button" class="btn dropdown" id="dropdownMenuButton-{{$cate->id}}" data-toggle="dropdown">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                          </svg> 
                                        </a>
                                        
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{$cate->id}}">
                                          <a class="dropdown-item" href="../categories/edit/{{ $cate->id }}">Edit</a>
                                          <a class="dropdown-item" class="btn btn-link" data-toggle="modal" data-target="#OpenquickviewCategory-{{$cate->id}}">Quick View</a>
                                              </div> 
                                        

                                       <!-- <a href="{{ route('categories.delete',$cate->id) }}" id="delete" title="Delete" class="btn btn-danger btn-sm {{ ($count_category>0)?'disabled':''}}"><i class="fas fa-trash mr-1"></i></a>
                                        -->
                                    </td>
                                </tr>                               

                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
                @foreach ($catedata as $key => $cate)
                                    <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="OpenquickviewCategory-{{$cate->id}}" tabindex="-1" aria-labelledby="OpenquickviewCategory-{{$cate->id}}" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="OpenquickviewCategory-{{$cate->id}}">Quick view</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <table class="table-sm table-bordered" width="100%">
                                                      <thead>
                                                        <tr>                                                          
                                                          <th>Category Name</th>
                                                          <th>CGST Rate</th>
                                                          <th>SGST Rate</th>
                                                          <th>Description</th>                                                          
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                            <td>{{ $cate->name }}</td>
                                                            <td>{{ $cate->cgst_perc }}</td>
                                                            <td>{{ $cate->sgst_perc }}</td>
                                                            <td>{{ $cate->description }}</td>
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
		</div> -->
	</footer>
</div>
@endsection