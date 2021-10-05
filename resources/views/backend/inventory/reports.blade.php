@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid">
         <br>   
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Sales Reports</li>
            </ol>
             {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
             <div class="card mb-4">
              <input type="text" id="demo" name="daterange" value="" />
              <div class="form-row">
             			  <div class="form-group col-md-2">
                                <label for="store"></label>
                                <select class="form-control" name="store_id" id="store-select">
                                    <option value="">Select Store</option>
                                    <option value="master" id="master">Master</option>
                               		<option value="7" id="7">Visioncraft - Chembur</option>
                               		<option value="6" id="6">Visioncraft - Kurla</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                  <label for="sales_invoice_status"></label>
                                  <select name="sales_invoice_status" id="sales_invoice_status" class="form-control">
                                      <option value="">Select Invoice status</option>
                                      <option value="1">Active</option>
                                      <option value="0">Draft</option>
                                      <option value="2">Delivered</option>
                                  </select>
                              </div>
              </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Generate Report</button>
                      </div>
            </div>
            <button type="button" class="btn btn-dark">Export To PDF</button>
              <button type="button" class="btn btn-info">Export to Excel</button>
              <button type="button" class="btn btn-danger">Export to CSV</button>
            
            <div class="card-body">

               <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Store ID</th>
                                    <th>Invoice No.</th>
                                    <th>Customer Name</th>
                                    <th>Invoice Date</th>
                                    <th>Grand Total</th>
                                    <th>Total Discount</th>
                                    <th>Invoice Status</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach ($invoices as $key => $invoice)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                     @if($invoice->store_id == 6)
                                    <td>Visioncraft-Kurla</td>
                                    @elseif($invoice->store_id == 7)
                                    <td>Visioncraft-Chembur</td>
                                    @else
                                    <td></td>@endif
                                    <td> {{ $invoice->sales_invoice_no }}</td>
                                    <?php $customer = DB::table('customers')->where('id', $invoice->customer_id)->first(); ?>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    
                                    <td>{{ $invoice->sales_invoice_date }}</td>
                                    <td>{{ $invoice->grand_total }}</td>
                                    <td>{{ $invoice->discount_total }}</td>
                                    @if($invoice->sales_invoice_status == 1)
                                    <td>Active</td>
                                    @elseif($invoice->store_id == 0)
                                    <td>Draft</td>
                                    @elseif($invoice->store_id == 2)
                                    <td>>Delivered</td>                                    
                                    @else
                                    <td></td>@endif
                                    
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                  <th colspan="5" style="text-align:right">Grand Total:</th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </tfoot>
                        </table>
            			
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
  <script type="text/javascript">
      $(document).ready(function() {
          
        $('#dataTable').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ' '+pageTotal +' ( '+ total +' total)'
            );

            // Remove the formatting to get integer data for summation
            var intVal1 = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total_disc = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal_disc = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                ' '+pageTotal_disc +' ( '+ total_disc +' total)'
            );
        }
    } );

      $(function() {
            $('#demo').daterangepicker({
              ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              "alwaysShowCalendars": true,
              "startDate": "08/27/2021",
              "endDate": "09/02/2021"
          }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
          });

          });



       } );
  </script>
</div>

@endsection
