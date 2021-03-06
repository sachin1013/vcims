@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <br>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>Paid Customers</span>
                    <small class="d-sm-block"><a href="{{ route('customers.paid.pdf') }}" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-print mr-1"></i>Print Data</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Customer Name</th>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Paid Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_paid = '0';
                                @endphp
                                @foreach ($alldate as $key => $payment)
                                @php
                                    $invoice = App\Model\Invoice::where('id',$payment->invoice_id)->first();   
                                @endphp
                                @if ($invoice->status == '1')
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $payment['customer']['name'] }}
                                        ({{ $payment['customer']['mobile_no'] }})
                                    </td>
                                    <td>#{{ $payment['invoice']['invoice_no']}}</td>
                                    <td>{{ date('d-M-Y',strtotime($payment['invoice']['date']))}}</td>
                                    <td>&#x20B9;{{ number_format($payment->paid_amount,2) }}</td>
                                    <td>
                                        <a href="{{ route('invoice.details.pdf',$payment->invoice_id) }}" target="_blank" title="Details" class="btn btn-success btn-sm"><i class="fas fa-eye mr-1"></i></a> 
                                    </td>
                                    @php
                                       $total_paid += $payment->paid_amount;   
                                    @endphp 
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Customer Name</th>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Paid Amount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <th colspan="5" style="text-align: right;">Total Paid Amount : &#x20B9;{{ number_format($total_paid,2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
@endsection