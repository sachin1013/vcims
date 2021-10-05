<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @php
        $customer = DB::table('customers')->where('id', $prescription->customer_id)->first();
    @endphp
    <title>Prescription #000{{ $prescription->id }}-{{ $customer->first_name }} {{ $customer->last_name }}</title> 
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
    <div class="tax-invoice-header">
        
            <h2 style="font-weight:bold;text-align:center;">PRESCRIPTION</h2>
        
    </div>

    <div class="invoice-body">
        <div class="row">
            <div class="invoice-no" style="display:inline-block;float:left;width:65%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Prescription No.</span> &nbsp;#000{{ $prescription->id }}</div>
            <div class="invoice-date" style="display:inline-block;float:right;width:30%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Date</span> &nbsp;{{ date('d-m-Y', strtotime($prescription->created_at)) }}</div>
        </div>
        <div class="row">
            <div class="customer-name" style="line-height:2.5;">
                <span style="font-weight:bold;font-size:15px;">Name</span>&nbsp;@if(!empty($customer->first_name)) {{$customer->first_name}}@endif @if(!empty($customer->last_name)) {{$customer->last_name}}@endif 
            </div>
        </div>

        <div class="row" style="padding-bottom:15px;">
            <div class="contact-no" style="display:inline-block;float:left;width:50%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;vertical-align:top;">Contact No.</span> &nbsp;@if(!empty($customer->contact_no)) {{$customer->contact_no}}@endif</div>
            @if(!empty($customer->email))<div class="email" style="display:inline-block;float:left;width:45%;line-height:2.5;"><span style="font-weight:bold;font-size:15px;">Email</span> &nbsp;{{$customer->email}}</div>@endif
        </div>

        <div class="row">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="header-table" style="font-weight:bold;font-size:15px;"></th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Sph.</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Cyl.</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Axis</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Add.</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Distance Vision (DV)</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">Near Vision(NV)</th>
                        <th class="header-table" style="font-weight:bold;font-size:15px;">PD</th>
                    </tr>
                </thead>
                    <tr>
                        <td class="header-table">Right Eye</td>
                        @if(!empty($prescription->right_eye_sph))
                        <td class="header-table">{{ $prescription->right_eye_sph }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->right_eye_cyl))
                        <td class="header-table">{{ $prescription->right_eye_cyl }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif
                        
                        @if(!empty($prescription->right_eye_axis))
                        <td class="header-table">{{ $prescription->right_eye_axis }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->right_eye_add))
                        <td class="header-table">{{ $prescription->right_eye_add }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->right_eye_va_dist))
                        <td class="header-table">{{ $prescription->right_eye_va_dist }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->right_eye_va_near))
                        <td class="header-table">{{ $prescription->right_eye_va_near }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->right_eye_pd))
                        <td class="header-table">{{ $prescription->right_eye_pd }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif
                    </tr>
                    <tr>
                        <td class="header-table">Left Eye</td>
                        @if(!empty($prescription->left_eye_sph))
                        <td class="header-table">{{ $prescription->left_eye_sph }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->left_eye_cyl))
                        <td class="header-table">{{ $prescription->left_eye_cyl }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif
                        
                        @if(!empty($prescription->left_eye_axis))
                        <td class="header-table">{{ $prescription->left_eye_axis }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->left_eye_add))
                        <td class="header-table">{{ $prescription->left_eye_add }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->left_eye_va_dist))
                        <td class="header-table">{{ $prescription->left_eye_va_dist }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->left_eye_va_near))
                        <td class="header-table">{{ $prescription->left_eye_va_near }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif

                        @if(!empty($prescription->left_eye_pd))
                        <td class="header-table">{{ $prescription->left_eye_pd }}</td>
                        @else
                        <td class="header-table"> - </td>
                        @endif
                    </tr>
            </table>
        </div>
    </div>
</body>
</html>