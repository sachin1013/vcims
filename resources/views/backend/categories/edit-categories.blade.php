@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Categories</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-edit mr-1"></i>Edit Categories</span>
                    <small class="d-sm-block"><a href="{{ route('categories.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Categories List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update',$editData->id) }}" method="post" id="category">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" value="{{ $editData->name }}" name="name" id="name" placeholder="Ex: T-shirt,Shoes">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="cgst_perc">CGST Percentage</label>
                                <input type="text" class="form-control" value="{{ $editData->cgst_perc }}" name="cgst_perc" id="cgst_perc" placeholder="">
                            </div>
                             <div class="form-group col-md-3">
                                <label for="sgst_perc">SGST Percentage</label>
                                <input type="text" class="form-control" value="{{ $editData->sgst_perc }}" name="sgst_perc" id="sgst_perc" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                 <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="5" id="description">{{ $editData->description }}</textarea>
                                
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
      $('#category').validate({
        rules: {
          name: {
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