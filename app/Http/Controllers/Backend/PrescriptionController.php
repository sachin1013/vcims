<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Prescription;
use App\Model\Customer;
use App\Model\Unit;
use App\Model\Categories;
use Auth;
use DB;
use PDF;

class PrescriptionController extends Controller
{
    //view customer method
    public function view ()
    {   
       
        $alldata = DB::table('prescriptions')->paginate(10);
        return view('backend.prescription.view-prescription', compact('alldata'));
    }

    //add customer interface method
    public function add()
    {	
    	$data['customer'] = Customer::all();
    	
        return view('backend.prescription.add-prescription',$data);
    }

     //store prescription method
    public function store(Request $request)
    {
            $prescription = new Prescription();
            $prescription->customer_id = $request->customer_id;
            $prescription->patient_name = $request->patient_name;
            $prescription->left_eye_sph = $request->left_eye_sph;
            $prescription->left_eye_cyl = $request->left_eye_cyl;
            $prescription->left_eye_axis = $request->left_eye_axis;
            $prescription->left_eye_add = $request->left_eye_add;
            $prescription->left_eye_va_dist = $request->left_eye_va_dist;
            $prescription->left_eye_va_near = $request->left_eye_va_near;
            $prescription->left_eye_pd = $request->left_eye_pd;
            $prescription->right_eye_sph = $request->right_eye_sph;
            $prescription->right_eye_cyl = $request->right_eye_cyl;
            $prescription->right_eye_axis = $request->right_eye_axis;
            $prescription->right_eye_add = $request->right_eye_add;
            $prescription->right_eye_va_dist = $request->right_eye_va_dist;
            $prescription->right_eye_va_near = $request->right_eye_va_near;
            $prescription->right_eye_pd = $request->right_eye_pd;
            $prescription->doctor_name = $request->doctor_name;
            $prescription->prescription_condition   = $request->prescription_condition;
            $prescription->status   = $request->status;
            $prescription->remarks   = $request->remarks;            
            $prescription->created_by = Auth::user()->id;
            $add_prescription = $prescription->save();

            if($add_prescription){
            $notification=array(
                'message'=>'Successfully Added Prescription',
                'alert-type'=>'success'
            );
            return redirect()->route('prescriptions.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('prescriptions.view')->with($notification);
        }

    }

    public function edit($id)
    {   
        $data['prescription'] = Prescription::find($id);
        $data['customers'] = Customer::all();
        return view('backend.prescription.edit-prescription', $data);
    }

    public function update(Request $request, $id)
    {
        $prescription = Prescription::find($id);
        $prescription->customer_id = $request->customer_id;
            $prescription->patient_name = $request->patient_name;
            $prescription->left_eye_sph = $request->left_eye_sph;
            $prescription->left_eye_cyl = $request->left_eye_cyl;
            $prescription->left_eye_axis = $request->left_eye_axis;
            $prescription->left_eye_add = $request->left_eye_add;
            $prescription->left_eye_va_dist = $request->left_eye_va_dist;
            $prescription->left_eye_va_near = $request->left_eye_va_near;
            $prescription->left_eye_pd = $request->left_eye_pd;
            $prescription->right_eye_sph = $request->right_eye_sph;
            $prescription->right_eye_cyl = $request->right_eye_cyl;
            $prescription->right_eye_axis = $request->right_eye_axis;
            $prescription->right_eye_add = $request->right_eye_add;
            $prescription->right_eye_va_dist = $request->right_eye_va_dist;
            $prescription->right_eye_va_near = $request->right_eye_va_near;
            $prescription->right_eye_pd = $request->right_eye_pd;
            $prescription->doctor_name = $request->doctor_name;
            $prescription->prescription_condition   = $request->prescription_condition;
            $prescription->status   = $request->status;
            $prescription->remarks   = $request->remarks;            
            $prescription->updated_by = Auth::user()->id;
            $update_prescription = $prescription->save();

            if($update_prescription){
            $notification=array(
                'message'=>'Prescription Updated Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('prescriptions.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('prescriptions.view')->with($notification);
        }

    }

    public function printPrescription($id) {
        $data['prescription'] = Prescription::find($id);
        $customPaper = array(0,0,720,1440);
        $pdf = PDF::loadView('backend.pdf.prescription-pdf', $data,['format' => 'A5']);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Prescription.pdf');
    }
}

