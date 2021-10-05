@extends('backend.layouts.master')
@section('content')

<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Prescription</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Edit Prescription</span>
                    <small class="d-sm-block"><a href="{{ route('prescriptions.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Prescription List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('prescriptions.update', $prescription->id) }}" method="post" id="Prescription_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="customer">Customer Name</label>
                                <select class="form-control col-md-12" name="customer_id" id="customer">
                                @foreach ($customers as $customer)
                                  <option value="{{ $customer->id }}" @if($prescription->customer_id == $customer->id) selected="selected" @endif>{{ $customer->first_name}} {{ $customer->last_name}} ({{ $customer->contact_no}} - {{$customer->family_code }})</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="patient_name">Prescribed For</label>
                                <input type="text" class="form-control" name="patient_name" id="patient_name" value="{{ $prescription->patient_name }}">
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
                                    <td><input type="text" class="form-control" name="right_eye_sph" id="right_eye_sph" value="{{ $prescription->right_eye_sph }}"></td>
                                    <td><input type="text" class="form-control" name="right_eye_cyl" id="right_eye_cyl" value="{{ $prescription->right_eye_cyl }}"></td>
                                    <td><select class="form-control" name="right_eye_axis" id="right_eye_axis">
                                                <option value=""></option>
                                                @for ($i = 1; $i <= 180; $i++){
                                                <option value="{{ $i }}" @if($prescription->right_eye_axis == $i) selected="selected" @endif>{{ $i }}</option>}
                                                @endfor
                                            </select>
                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_add" id="right_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}" @if($prescription->right_eye_add == $i) selected="selected" @endif>{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_dist" id="right_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60" @if($prescription->right_eye_va_dist == "6/60") selected="selected" @endif>6/60</option>
                                            <option value="6/36" @if($prescription->right_eye_va_dist == "6/36") selected="selected" @endif>6/36</option>
                                            <option value="6/24" @if($prescription->right_eye_va_dist == "6/24") selected="selected" @endif>6/24</option>
                                            <option value="6/18P" @if($prescription->right_eye_va_dist == "6/18P") selected="selected" @endif>6/18P</option>
                                            <option value="6/18" @if($prescription->right_eye_va_dist == "6/18") selected="selected" @endif>6/18</option>
                                            <option value="6/12P" @if($prescription->right_eye_va_dist == "6/12P") selected="selected" @endif>6/12P</option>
                                            <option value="6/12" @if($prescription->right_eye_va_dist == "6/12") selected="selected" @endif>6/12</option>
                                            <option value="6/9P" @if($prescription->right_eye_va_dist == "6/9P") selected="selected" @endif>6/9P</option>
                                            <option value="6/9" @if($prescription->right_eye_va_dist == "6/9") selected="selected" @endif>6/9</option>
                                            <option value="6/6P" @if($prescription->right_eye_va_dist == "6/6P") selected="selected" @endif>6/6P</option>
                                            <option value="6/6" @if($prescription->right_eye_va_dist == "6/6") selected="selected" @endif>6/6</option>
                                            <option value="6/5" @if($prescription->right_eye_va_dist == "6/5") selected="selected" @endif>6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_va_near" id="right_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36" @if($prescription->right_eye_va_near == "N36") selected="selected" @endif>N36</option>
                                            <option value="N18" @if($prescription->right_eye_va_near == "N18") selected="selected" @endif>N18</option>
                                            <option value="N12" @if($prescription->right_eye_va_near == "N12") selected="selected" @endif>N12</option>
                                            <option value="N10" @if($prescription->right_eye_va_near == "N10") selected="selected" @endif>N10</option>
                                            <option value="N10P" @if($prescription->right_eye_va_near == "N10P") selected="selected" @endif>N10P</option>
                                            <option value="N8" @if($prescription->right_eye_va_near == "N8") selected="selected" @endif>N8</option>
                                            <option value="N8P" @if($prescription->right_eye_va_near == "N8P") selected="selected" @endif>N8P</option>
                                            <option value="N6" @if($prescription->right_eye_va_near == "N6") selected="selected" @endif>N6</option>
                                            <option value="N6P" @if($prescription->right_eye_va_near == "N6P") selected="selected" @endif>N6P</option>
                                            <option value="N5" @if($prescription->right_eye_va_near == "N5") selected="selected" @endif>N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="right_eye_pd" id="right_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}" @if($prescription->right_eye_pd == $i) selected="selected" @endif>{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Left Eye</strong></td>
                                    <td><input type="text" class="form-control" name="left_eye_sph" id="left_eye_sph" value="{{ $prescription->left_eye_sph }}"></td>
                                    <td><input type="text" class="form-control" name="left_eye_cyl" id="left_eye_cyl" value="{{ $prescription->left_eye_cyl }}"></td>
                                    <td><select class="form-control col-md-12" name="left_eye_axis" id="left_eye_axis">
                                            <option value=""></option>
                                            @for ($i = 1; $i <= 180; $i++){
                                            <option value="{{ $i }}" @if($prescription->left_eye_axis == $i) selected="selected" @endif>{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_add" id="left_eye_add">
                                            <option value=""></option>
                                            @for ($i = 0.75; $i <= 4; $i = $i + 0.25){
                                            <option value="{{ $i }}" @if($prescription->left_eye_add == $i) selected="selected" @endif>{{ $i }}</option>}
                                            @endfor
                                        </select>                                        
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_dist" id="left_eye_va_dist">
                                            <option value=""></option>
                                            <option value="6/60" @if($prescription->left_eye_va_dist == "6/60") selected="selected" @endif>6/60</option>
                                            <option value="6/36" @if($prescription->left_eye_va_dist == "6/36") selected="selected" @endif>6/36</option>
                                            <option value="6/24" @if($prescription->left_eye_va_dist == "6/24") selected="selected" @endif>6/24</option>
                                            <option value="6/18P" @if($prescription->left_eye_va_dist == "6/18P") selected="selected" @endif>6/18P</option>
                                            <option value="6/18" @if($prescription->left_eye_va_dist == "6/18") selected="selected" @endif>6/18</option>
                                            <option value="6/12P" @if($prescription->left_eye_va_dist == "6/12P") selected="selected" @endif>6/12P</option>
                                            <option value="6/12" @if($prescription->left_eye_va_dist == "6/12") selected="selected" @endif>6/12</option>
                                            <option value="6/9P" @if($prescription->left_eye_va_dist == "6/9P") selected="selected" @endif>6/9P</option>
                                            <option value="6/9" @if($prescription->left_eye_va_dist == "6/9") selected="selected" @endif>6/9</option>
                                            <option value="6/6P" @if($prescription->left_eye_va_dist == "6/6P") selected="selected" @endif>6/6P</option>
                                            <option value="6/6" @if($prescription->left_eye_va_dist == "6/6") selected="selected" @endif>6/6</option>
                                            <option value="6/5" @if($prescription->left_eye_va_dist == "6/5") selected="selected" @endif>6/5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_va_near" id="left_eye_va_near">
                                            <option value=""></option>
                                            <option value="N36" @if($prescription->left_eye_va_near == "N36") selected="selected" @endif>N36</option>
                                            <option value="N18" @if($prescription->left_eye_va_near == "N18") selected="selected" @endif>N18</option>
                                            <option value="N12" @if($prescription->left_eye_va_near == "N12") selected="selected" @endif>N12</option>
                                            <option value="N10" @if($prescription->left_eye_va_near == "N10") selected="selected" @endif>N10</option>
                                            <option value="N10P" @if($prescription->left_eye_va_near == "N10P") selected="selected" @endif>N10P</option>
                                            <option value="N8" @if($prescription->left_eye_va_near == "N8") selected="selected" @endif>N8</option>
                                            <option value="N8P" @if($prescription->left_eye_va_near == "N8P") selected="selected" @endif>N8P</option>
                                            <option value="N6" @if($prescription->left_eye_va_near == "N6") selected="selected" @endif>N6</option>
                                            <option value="N6P" @if($prescription->left_eye_va_near == "N6P") selected="selected" @endif>N6P</option>
                                            <option value="N5" @if($prescription->left_eye_va_near == "N5") selected="selected" @endif>N5</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control col-md-12" name="left_eye_pd" id="left_eye_pd">
                                            <option value=""></option>
                                            @for ($i = 26; $i <= 40; $i = $i + 0.5){
                                            <option value="{{ $i }}" @if($prescription->left_eye_pd == $i) selected="selected" @endif>{{ $i }}</option>}
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
                                <input type="text" class="form-control" name="doctor_name" id="doctor_name" value="{{ $prescription->doctor_name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prescription_condition">Prescription Condition</label>
                                <select class="form-control" name="prescription_condition" id="prescription_condition">
                                    <option value="">Select Prescription Condition</option>
                                    <option value="normal" @if($prescription->prescription_condition == "normal") selected="selected" @endif>Normal</option>
                                    <option value="severe" @if($prescription->prescription_condition == "severe") selected="selected" @endif>Severe</option>
                                    <option value="others" @if($prescription->prescription_condition == "others") selected="selected" @endif>Others</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Prescription Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select Prescription Status</option>
                                    <option value="active" @if($prescription->status == "active") selected="selected" @endif>Active</option>
                                    <option value="expired" @if($prescription->status == "expired") selected="selected" @endif>expired</option>
                                    <option value="others" @if($prescription->status == "others") selected="selected" @endif>Others</option>
                                </select>
                            </div>
                             <div class="form-group col-md-12">
                                <label for="remarks">Remarks</label>
                               <textarea rows = "3" class="form-control" name="remarks" id="remarks">{{ $prescription->remarks }} </textarea>
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