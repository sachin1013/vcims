<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice-Pos</title> 
</head>
<body>
    <h3 style="color: #002366"><span>VISIONCRAFT <br>Daily Invoice Report</span></h3>
    <hr style="color: #002366">
        <p style="margin:0;padding:0;text-align:center">{{ $start_date }} To {{ $end_date }}</p>
    <hr style="color: #002366">
    {{-- @php
        $payment = App\model\Payment::where('invoice_id',$invoice->id)->first();
    @endphp
    <div>
        <strong>Shipped To:</strong><br>
        {{ $payment['customer']['name'] }}<br>
        {{ $payment['customer']['address'] }}<br>
        {{ ($payment['customer']['email'])?$payment['customer']['email']:'Example@gmail.com' }}<br>
        {{ $payment['customer']['mobile_no'] }} <br>
        <strong>Invoice Date:</strong><br>
          {{ date('d-M-Y',strtotime($invoice->date)) }}<br>
    </div>    --}}
    <h4 style="color: #002366;">Order Summary</h4>   
    <table style="width: 100%; margin-bottom:100px">
        <thead>
            <tr style="background: #002366;">
                <th style=" color:white">Sr. No.</th>
                <th style=" color:white">Invoice No</th>
                <th style=" color:white">Customer Name</th>
                <th style=" color:white">Description</th>
                <th style=" color:white">Amount</th>
                <th style=" color:white">Date</th>
            </tr>
        </thead>
        <tbody >
            @php
                $total_sum = 0;
            @endphp
            @foreach ($alldata as $key => $invoice)
                <tr>
                    <th style="border: 1px solid #002366;">{{ $key+1 }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">#{{ $invoice->invoice_no }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">{{ $invoice['payment']['customer']['name'] }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">{{ ($invoice->description)?$invoice->description:'There is no Description in This invoice!' }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">&#x20B9;{{ number_format($invoice['payment']['total_amount'],2) }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">{{ date('Y-m-d',strtotime($invoice->date)) }}</th>
                </tr>
            @php
                $total_sum += $invoice['payment']['total_amount'];
            @endphp
            @endforeach
        </tbody>
        
        <tbody>
            @php
                $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
            @endphp
            <tr>
                <th colspan="4" style="text-align:left">printing Date : {{ $date->format('F j, Y, g:i a') }}</th>
                <th colspan="1" style="margin-top:20px; text-align: right;padding:8px;:white">Grand Total :</th>
                <th><strong>&#x20B9;{{ number_format($total_sum,2) }}</strong></th>
            </tr>
            
        </tbody>
    </table>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th colspan="4" style="text-align: left;border-top:2px solid #002366;padding-top:5px">Owner Signature</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
                <th colspan="8" style="text-align: left">Mobile : </th>
            </tr>
            <tr>
                <th colspan="8" style="text-align: left">Address : Mumbai, Maharashtra</th>
            </tr>
            
        </tbody>
    </table>
    
      
</body>
</html>