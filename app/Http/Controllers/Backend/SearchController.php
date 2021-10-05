<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Prescription;
use App\Model\Address;
use Auth;
use Response;
use DB;


class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $customers = [];
        if($request->has('q')) {
            $query = $request->q;
            $customers = Customer::select('id', 'first_name', 'last_name')->where('first_name', 'LIKE', '%'.$query.'%')
                                ->orWhere('last_name','LIKE','%'.$query. '%')
                                ->orWhere('contact_no','LIKE','%'.$query. '%')
                                ->orWhere('alt_contact_no','LIKE','%'.$query. '%')->get();
        }
        return response()->json($customers);  
    } 
}
