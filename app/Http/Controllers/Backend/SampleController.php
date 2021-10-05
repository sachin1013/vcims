  
<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\Invoice;
use App\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoiceID = $request->companyId;
        $_company = Company::findorfail($invoiceID);
        $_country = Country::where('id', $_company->CountryId)->first();

        return view('invoice.add_invoice', compact('_country', '_company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $requestuest
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        if (!empty($request)) {
            $validator = Validator::make($request->all(), [
                'cust_name' => 'required',
            ], [
                'cust_name.required' => 'Please enter customer name',
            ]
            );

            if ($validator->fails()) {
                \Session::flash('generate_invoice_fail', '');

                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $taxRate = $request->taxRate;
                $group_description = [];
                $group_quantity = [];
                $group_unit_price = [];
                $group_tax = [];
                $group_sub_total = [];
                $group_discount_percentage = [];
                $group_discount_amount = [];
                $group_total = [];
                $group_grand_total = [];

                $_list = 0;
                for ($_list = 0; $_list < count($request->description); ++$_list) {
                    $description = $request->description[$_list];
                    $quantity = $request->quantity[$_list];
                    $unit_price = $request->unit_price[$_list];
                    $discount_percentage = $request->discount_percentage[$_list];

                    if ($quantity != '' && $unit_price != '' && $discount_percentage == '') {
                        $tax = ($taxRate / 100) * ($quantity * $unit_price);
                        $sub_total = $quantity * $unit_price;
                        $total = $sub_total + $tax;
                        $grand_total = $total;
                        $discount_percentage = 0;
                        $discount_amount = 0;
                    }

                    if ($quantity != '' && $unit_price != '' && $discount_percentage != '') {
                        $discount_amount = ($discount_percentage / 100) * ($quantity * $unit_price);
                        $sub_total = ($quantity * $unit_price) - $discount_amount;
                        $tax = ($taxRate / 100) * $sub_total;
                        $total = $sub_total + $tax;
                        $grand_total = $total;
                    }

                    array_push($group_description, $description);
                    array_push($group_quantity, $quantity);
                    array_push($group_unit_price, $unit_price);
                    array_push($group_tax, $tax);
                    array_push($group_discount_percentage, $discount_percentage);
                    array_push($group_discount_amount, $discount_amount);
                    array_push($group_sub_total, $sub_total);
                    array_push($group_total, $total);
                    array_push($group_grand_total, $grand_total);
                }
                // dd('asd');
                //Iterate through multiple inputs
                // foreach ($request->description as $key => $description) {
                //     array_push($group_description, $description);
                // }
                // foreach ($request->quantity as $key => $quantity) {
                //     array_push($group_quantity, $quantity);
                // }
                // foreach ($request->unit_price as $key => $unit_price) {
                //     array_push($group_unit_price, $unit_price);
                // }
                // foreach ($request->tax as $key => $tax) {
                //     $tax = ($taxRate / 100) * ($quantity * $unit_price);
                //     array_push($group_tax, $tax);
                // }
                // foreach ($request->discount_percentage as $key => $discount_percentage) {
                //     array_push($group_discount_percentage, $discount_percentage);
                // }
                // foreach ($request->discount_amount as $key => $discount_amount) {
                //     array_push($group_discount_amount, $discount_amount);
                // }
                // foreach ($request->sub_total as $key => $sub_total) {
                //     array_push($group_sub_total, $sub_total);
                // }

                // foreach ($request->total as $key => $total) {
                //     $total = $sub_total + $tax;
                //     array_push($group_total, $total);
                // }
                // foreach ($request->grand_total as $key => $grand_total) {
                //     array_push($group_grand_total, $grand_total);
                // }

                $group_description = implode(',', $group_description);
                $group_quantity = implode(',', $group_quantity);
                $group_unit_price = implode(',', $group_unit_price);
                $group_tax = implode(',', $group_tax);
                $group_sub_total = implode(',', $group_sub_total);
                $group_discount_percentage = implode(',', $group_discount_percentage);
                $group_discount_amount = implode(',', $group_discount_amount);
                $group_total = implode(',', $group_total);
                $group_grand_total = implode(',', $group_grand_total);

                $invoice = new Invoice();
                $invoice->countryId = $request->countryId;
                $invoice->companyId = $request->companyId;
                $invoice->cust_name = $request->cust_name;
                $invoice->address_1 = $request->address_1;
                $invoice->address_2 = $request->address_2;
                $invoice->city = $request->city;
                $invoice->state = $request->state;
                $invoice->postal_code = $request->postal_code;
                $invoice->d_address_1 = $request->delivery_address_1;
                $invoice->d_address_2 = $request->delivery_address_2;
                $invoice->d_city = $request->delivery_city;
                $invoice->d_state = $request->delivery_state;
                $invoice->d_postal_code = $request->delivery_postal_code;
                $invoice->tax = $group_tax;
                $invoice->sub_total = $group_sub_total;
                $invoice->discount_percentage = $group_discount_percentage;
                $invoice->discount_amount = $group_discount_amount;
                $invoice->total = $group_total;
                $invoice->grand_total = $group_grand_total;
                $invoice->invoice_date = $now;
                $invoice->save();

                //retrieve latest record for invoice
                $_company = Company::findorfail($request->companyId);
                $_country = Country::findorfail($request->countryId);
                $_retrieveLatestInvoice = Invoice::where('companyId', $request->companyId)->orderBy('id', 'DESC')->first();

                //generate running number for invoice
                $_generateRunningNumber = $this->generateRunningNumber($_retrieveLatestInvoice->id, $_company->invoiceId);

                //insert into Invoice Details
                $_invoice_details = new InvoiceDetail();
                $_invoice_details->description = $group_description;
                $_invoice_details->quantity = $group_quantity;
                $_invoice_details->unit_price = $group_unit_price;
                $_invoice_details->invoiceId = $_retrieveLatestInvoice->id;
                $_invoice_details->save();

                //update invoice table with file link & invoice running number
                $_updateInvoice = Invoice::findorfail($_retrieveLatestInvoice->id);
                $_filename = $_generateRunningNumber;
                $_filenameOrder = 'Order_'.$_generateRunningNumber;
                $_download = $_filename.'.pdf';
                $_downloadOrder = $_filenameOrder.'.pdf';
                $_updateInvoice->invoice_running_no = $_generateRunningNumber;
                $_updateInvoice->link = $_download;
                $_updateInvoice->link_order = $_downloadOrder;
                $_updateInvoice->save();
            }

            //Iterate through invoice & invoice detail
            $logo = $_company->logo;
            $sub_total = number_format(array_sum(explode(',', $invoice->sub_total)), 2, '.', '');
            $discount_amount = number_format(array_sum(explode(',', $invoice->discount_amount)), 2, '.', '');
            $tax = number_format(array_sum(explode(',', $invoice->tax)), 2, '.', '');
            $total = number_format(array_sum(explode(',', $invoice->total)), 2, '.', '');
            $grand_total = number_format(array_sum(explode(',', $invoice->grand_total)), 2, '.', '');
            $_runningNumber = $_generateRunningNumber;
            $_generate_pdf_view = array($_country, $_company, $invoice, $_invoice_details, $sub_total, $discount_amount, $tax, $total, $grand_total, $_runningNumber, $logo);

            view()->share('value', $_generate_pdf_view);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('template.invoice')->setPaper('a4', 'portrait')->setWarnings(false)->save(public_path().'\\assets\\invoices\\'.$_filename.'.pdf');
            $pdf = PDF::loadView('template.order')->setPaper('a4', 'portrait')->setWarnings(false)->save(public_path().'\\assets\\orders\\'.$_filenameOrder.'.pdf');
            $companies = Company::orderBy('created_at', 'DESC')->get();

            \Session::flash('generate_invoice_success', '');

            return redirect()->route('company-view', ['id' => $_company->id]);
        }
    }

    public function generateRunningNumber($id, $invoiceName)
    {
        $_runningNumber = str_pad($id, 10, '0', STR_PAD_LEFT);

        return $invoiceName.$_runningNumber;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invoice $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $companies = Company::orderBy('created_at', 'DESC')->get();

        return view('invoice.start_invoice', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Invoice $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $requestuest
     * @param \App\Invoice             $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requestuest, Invoice $invoice)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Invoice $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
    }

    public function pdfview(Request $request)
    {
        $value = Company::orderBy('created_at', 'DESC')->get();
        view()->share('value', $value);
        $_filename = 'INV00001';
        if ($request->has('download')) {
            //     // Set extra option
            //     PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            //     // pass view file
            //     $pdf = PDF::loadView('test');
            //     // download pdf
            //     return $pdf->download('pdfview.pdf');

            $pdf = PDF::loadView('template.invoice');
            // PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')

            return $pdf->stream(''.$_filename.'.pdf');
        }

        return view('test');
    }
}