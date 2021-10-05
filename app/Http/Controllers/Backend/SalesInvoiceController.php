<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Vendor;
use App\Model\Invoice;
use App\Model\Address;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use App\Model\Country;
use App\Model\Prescription;
use Auth;
use DB;
use PDF;

class SalesInvoiceController extends Controller
{
	public function view ()
    {        
        return view('backend.salesinvoice.view-salesinvoices');
    }

    public function add()
    { 

    }
}
?>