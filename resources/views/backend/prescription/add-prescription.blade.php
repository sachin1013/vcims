@extends('backend.layouts.master')
@section('content')

<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Prescription</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Prescription</span>
                    <small class="d-sm-block"><a href="{{ route('prescriptions.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Prescription List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('prescriptions.store') }}" method="post" id="Prescription_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="customer">Customer Name</label>
                                <select class="form-control col-md-12" name="customer_id" id="customer">
                                @foreach ($customer as $customer)
                                  <option value="{{ $customer->id }}">{{ $customer->first_name}} {{ $customer->last_name}} ({{ $customer->contact_no}} - {{$customer->family_code }})</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="patient_name">Prescribed For</label>
                                <input type="text" class="form-control" name="patient_name" id="patient_name">
                            </div>
                        </div>

                       
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
                                    <td><input type="text" class="form-control" name="right_eye_sph" id="right_eye_sph"></td>
                                    <td><input type="text" class="form-control" name="right_eye_cyl" id="right_eye_cyl"></td>
                                    <td><select class="form-control" name="right_eye_axis" id="right_eye_axis">
                                                <option value=""></option>
                                                @for ($i = 1; $i <= 180; $i++){
                                                <option value="{{ $i }}">{{ $i }}</option>}
                                                @endfor
                                            </select>
                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_add" id="right_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_dist" id="right_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60">6/60</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/18P">6/18P</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/12P">6/12P</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/9P">6/9P</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/6P">6/6P</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/5">6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_near" id="right_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N10P">N10P</option>
                                            <option value="N8">N8</option>
                                            <option value="N8P">N8P</option>
                                            <option value="N6">N6</option>
                                            <option value="N6P">N6P</option>
                                            <option value="N5">N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_pd" id="right_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Left Eye</strong></td>
                                    <td><input type="text" class="form-control" name="left_eye_sph" id="left_eye_sph"></td>
                                    <td><input type="text" class="form-control" name="left_eye_cyl" id="left_eye_cyl"></td>
                                    <td><select class="form-control col-md-12" name="left_eye_axis" id="left_eye_axis">
                                            <option value=""></option>
                                            @for ($i = 1; $i <= 180; $i++){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_add" id="left_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_dist" id="left_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60">6/60</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/18P">6/18P</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/12P">6/12P</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/9P">6/9P</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/6P">6/6P</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/5">6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_near" id="left_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N10P">N10P</option>
                                            <option value="N8">N8</option>
                                            <option value="N8P">N8P</option>
                                            <option value="N6">N6</option>
                                            <option value="N6P">N6P</option>
                                            <option value="N5">N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_pd" id="left_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}">{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    
                                </tr>
                            </thead>
                        </table>
                   
                      
                        

                         
                            
                         <br>    
                        <h5><strong>Other information</strong></h5><br>
                        <div class="form-row">
                            
                             <div class="form-group col-md-4">
                                <label for="doctor_name">Prescribed By</label>
                                <input type="text" class="form-control" name="doctor_name" id="doctor_name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prescription_condition">Prescription Condition</label>
                                <select class="form-control" name="prescription_condition" id="prescription_condition">
                                    <option value="">Select Prescription Condition</option>
                                    <option value="normal">Normal</option>
                                    <option value="severe">Severe</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Prescription Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select Prescription Status</option>
                                    <option value="active">Active</option>
                                    <option value="expired">expired</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                             <div class="form-group col-md-12">
                                <label for="remarks">Remarks</label>
                               <textarea rows = "3" class="form-control" name="remarks" id="remarks"> </textarea>
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
    $(document).ready(function(){
      $('#customer').select2();
      $('#right_eye_axis').select2();
      $('#right_eye_add').select2();
      $('#right_eye_va_dist').select2();
      $('#right_eye_va_near').select2();
      $('#right_eye_pd').select2();
      $('#left_eye_axis').select2();
      $('#left_eye_add').select2();
      $('#left_eye_va_dist').select2();
      $('#left_eye_va_near').select2();
      $('#left_eye_pd').select2();
      $('#prescription_condition').select2();
      $('#status').select2();
    });
</script>
@endsection