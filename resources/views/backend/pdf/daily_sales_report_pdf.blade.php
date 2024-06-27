@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Daily Purchases and Sales Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Items Invoice <span class="btn btn-info" style="margin-left: 10px;">{{ date('d-m-Y',strtotime($start_date)) }}</span> - <span class="btn btn-success">{{ date('d-m-Y',strtotime($end_date)) }}</span></strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><strong>Sl</strong></th>
                                                        <th class="text-center"><strong>Product Name</strong></th>
                                                        <th class="text-center"><strong>Purchased Quantity</strong></th>
                                                        <th class="text-center"><strong>Purchase Unit Price</strong></th>
                                                        <th class="text-center"><strong>Sale Quantity</strong></th>
                                                        <th class="text-center"><strong>Sell Unit Price</strong></th>
                                                        
                                                        <th class="text-center"><strong>Total Sales Price</strong></th>
                                                        <th class="text-center"><strong>Total Purchase Price</strong></th>
                                                        <th class="text-center"><strong>Loss/Profit</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 0;
                                                        $grandTotal = 0; // Initialize the grand total variable
                                                    @endphp

                                                    <!-- Loop through products -->
                                                    @foreach($products as $key => $product)
                                                        @php
                                                            // Calculate totals for purchases
                                                            $buying_total = $product->purchases->sum('buying_qty');
                                                            $purchase_unit_price = $product->purchases->avg('unit_price');
                                                            $total_purchase_price = $buying_total * $purchase_unit_price;

                                                            // Calculate totals for sales
                                                            $total_selling_qty = $product->sales->sum('selling_qty');
                                                            $sell_unit_price = $product->sales->avg('unit_price');
                                                            $total_selling_price = $total_selling_qty * $sell_unit_price;

                                                            // Calculate profit/loss
                                                            $total_price_status = $total_selling_price - $total_purchase_price;

                                                            // Add to the grand total
                                                            $grandTotal += $total_price_status;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ ++$no }}</td>
                                                            <td class="text-center">{{ $product->name }}</td>
                                                            <td class="text-center">{{ $buying_total }}</td>
                                                            <td class="text-center">AED {{ number_format($purchase_unit_price, 2) }}</td>
                                                            <td class="text-center">{{ $total_selling_qty }}</td>
                                                            <td class="text-center">AED {{ number_format($sell_unit_price, 2) }}</td>
                                                            <td class="text-center">AED {{ number_format($total_selling_price, 2) }}</td>
                                                            <td class="text-center">AED {{ number_format($total_purchase_price, 2) }}</td>
                                                            <td class="text-center">AED {{ number_format($total_price_status, 2) }}</td>
                                                        </tr>
                                                    @endforeach

                                                    <!-- Grand Total row -->
                                                    <tr>
                                                        <td colspan="7" class="text-end"><strong>Grand Total Profit/Loss</strong></td>
                                                        <td colspan="2" class="text-center"><h4 class="m-0">AED {{ number_format($grandTotal, 2) }}</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@endsection
