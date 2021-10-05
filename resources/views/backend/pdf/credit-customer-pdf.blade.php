<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credit-Customer</title> 
</head>
<body>
    <h3 style="color: #002366"><span>VISIONCRAFT</span></h3>
    <hr style="color: #002366">
        <h3 style="margin:0;padding:0;text-align:center">Credit Customer Report</h3>
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
    <h4 style="color: #002366;">Credit Summary</h4>   
    <table style="width: 100%; margin-bottom:100px">
        <thead>
            <tr style="background: #002366;">
                <th style=" color:white">SL</th>
                <th style=" color:white">Customer Name</th>
                <th style=" color:white">Invoice</th>
                <th style=" color:white">Date</th>
                <th style=" color:white">Due Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_due = '0';
            @endphp
            @foreach ($alldata as $key => $payment)
                <tr>
                    <th style="border: 1px solid #002366;">{{ $key+1 }}</th>
                    <th style="border: 1px solid #002366;padding:7px;">{{ $payment['customer']['name'] }}
                        ({{ $payment['customer']['mobile_no'] }})</th>
                    <th style="border: 1px solid #002366;padding:7px;">#{{ $payment['invoice']['invoice_no']}}</th>
                    <th style="border: 1px solid #002366;padding:7px;">{{ date('d-M-Y',strtotime($payment['invoice']['date']))}}</th>
                    <th style="border: 1px solid #002366;padding:7px;">&#x20B9;{{ number_format($payment->due_amount,2) }}</th>
                     @php
                        $total_due += $payment->due_amount;   
                     @endphp   
                </tr>
            @endforeach
        </tbody>
        
        <tbody>
            <tr>
                <th colspan="4" style="text-align: right;padding:8px;background: #002366;color:white">Total Due Amount:</th>
                <th><strong>&#x20B9;{{ number_format($total_due,2) }}</strong></th>
            </tr>
            @php
                $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
            @endphp
            <tr>
                <th colspan="4" style="text-align:left;margin-top:8px">printing Date : {{ $date->format('F j, Y, g:i a') }}</th>
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