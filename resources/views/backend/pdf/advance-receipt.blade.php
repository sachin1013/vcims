<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     @php
        $customer = DB::table('customers')->where('id', $invoice->customer_id)->first();
    @endphp
    <title>Advance Receipt &nbsp;#000{{ $invoice->id }}-{{ $customer->first_name }} {{ $customer->last_name }}</title> 
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
</head>
<body>
    <style type="text/css">
        @page {
            header: page-header;
            footer: page-footer;
        }
        .tax-invoice-header {
            position:relative;
            display:block;
            padding-top:160px;
        }
        .invoice-body {
            position: relative;
            display:block;
            padding-top:25px;
        }
        .header-table{
            padding:0.75em;
        }
        .gst-table
        {
            padding:0.2em 0.5em;
            white-space:nowrap;
        }
    </style>
    <htmlpageheader name="page-header">
        <div class="row">
            <img src="{{ asset('/public/images/invoice-header.jpg') }}"/>
        </div>
    </htmlpageheader>
    @php
        $customer = DB::table('customers')->where('id', $invoice->customer_id)->first();
        $address = DB::table('addresses')->where('cust_id', $invoice->customer_id)->first();
        $items = DB::table('invoice_details')->where('sales_invoice_id', $invoice->sales_invoice_no)->get();
    @endphp
    <div class="tax-invoice-header">
        
            <h2 style="font-weight:bold;text-align:center;">Advance Receipt</h2>
        
    </div>
    <div class="invoice-body">

        <div class="row">
            <div class="invoice-no" style="display:inline-block;float:left;width:65%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Order No.</span> &nbsp;#000{{ $invoice->id }}</div>
            <div class="invoice-date" style="display:inline-block;float:right;width:30%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Date</span> &nbsp;{{ date('d-m-Y', strtotime($invoice->sales_invoice_date)) }}</div>
        </div>
        <div class="row">
            <div class="customer-name" style="line-height:2.5;">
                <span style="font-weight:bold;font-size:15px;">Name</span>&nbsp;@if(!empty($customer->first_name)) {{$customer->first_name}}@endif @if(!empty($customer->last_name)) {{$customer->last_name}}@endif 
            </div>
        </div>
        <!--<div class="row">
            <div class="customer-address" style="line-height:3;"><span style="font-weight:bold;font-size:15px;">
                Address</span> &nbsp;@if(!empty($address->address_line_1)) {{$address->address_line_1}}@endif
                        @if(!empty($address->address_line_1)) {{$address->address_line_1}}@endif
                        @if(!empty($address->address_line_2)) {{$address->address_line_2}}@endif
                        @if(!empty($address->landmark)) {{$address->landmark}}@endif
                        @if(!empty($address->city )) {{$address->city }}@endif                        
                        @if(!empty($address->pincode)) {{$address->pincode}}@endif
                        @if(!empty($customer->address)) {{$customer->address}}@endif
            </div>
        </div>-->
        <div class="row" style="padding-bottom:15px;">
            <div class="contact-no" style="display:inline-block;float:left;width:50%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;vertical-align:top;">Contact No.</span> &nbsp;@if(!empty($customer->contact_no)) {{$customer->contact_no}}@endif</div>
            @if(!empty($customer->email))<div class="email" style="display:inline-block;float:left;width:45%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Email</span> &nbsp;{{$customer->email}}</div>@endif
        </div>
        <div class="row">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Sr.No.</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Category</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Product Description</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Net Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($items as $item)
                    <tr>
                        @php
                            $category = DB::table('categories')->where('id', $item->category_id)->first();
                            @endphp
                            <td class="header-table">{{ $i }}</td>
                            <td class="header-table">@if(!empty($category->name)) {{$category->name}}@endif</td>
                            <td class="header-table">@if(!empty($item->product_name)) {{$item->product_name}}@endif</td>
                            <td class="header-table">@if(!empty($item->total_product)) {{$item->total_product}}@endif</td>                        
                    </tr>
                    @endforeach
                </tbody>
                <tbody>

                    <tr>
                        <td colspan="2"></td>
                        <td class="header-table" style="font-weight:bold;font-size:15px;">Total</td>
                        @php
                        $total = 0;
                            foreach($items as $item)
                            {
                                $sub = $item->sell_qty * $item->unit_price;
                                $total = $total + $sub;
                                }     
                           
                        @endphp
                        <td class="header-table" style="font-weight:bold;font-size:15px;">@if(!empty($invoice->grand_total)) {{$invoice->grand_total}}@endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td class="header-table" style="font-weight:bold;font-size:15px;">Advance paid</td>
                        @php
                            $advance = DB::table('payments')->where('sales_invoice_no', $invoice->sales_invoice_no)->first();   
                        @endphp
                        <td class="header-table" style="font-weight:bold;font-size:15px;">@if($advance->paid_amount >=0) {{$advance->paid_amount}}@endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td class="header-table" style="font-weight:bold;font-size:15px;">Balance to be paid</td>
                        @php
                            $balance = $invoice->grand_total - $advance->paid_amount;   
                        @endphp
                        <td class="header-table" style="font-weight:bold;font-size:15px;">@if(!empty($balance)) {{$balance}}@endif</td>
                    </tr> 
                </tbody>               
            </table>
            
        </div>
        
       <!-- <div class="row">
            @if(!empty($invoice->notes))
            <div class="invoice-notes" style="line-height:2.5;">
               <span style="font-weight:bold;font-size:15px;">Notes</span> {{$invoice->notes}}
            </div>
            @endif
        </div>
        <div class="row">
            @if(!empty($invoice->due_date))
            <div class="invoice-due" style="line-height:2.5;">
                <span style="font-weight:bold;font-size:15px;">Delivered On</span> {{$invoice->due_date}}
            </div>
            @endif
        </div>
    </div>-->
    <htmlpagefooter name="page-footer">
        <div class="row">
            <img src="{{ asset('/public/images/invoice-footer.jpg') }}"/>
        </div>
    </htmlpagefooter>
</body>
</html>