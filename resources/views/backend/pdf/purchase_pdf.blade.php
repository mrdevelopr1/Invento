@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Purchase Invoice</h4>
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
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16"><strong>Purchase Invoice No # {{ $purchase->purchase_no }}</strong></h4>
                                    <h3>
                                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo" height="100"/>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <address>
                                            <strong>Nanna Pat MArt</strong><br>
                                            Michelina Lock, Christianstad<br>
                                            support@invento.com
                                        </address>
                                    </div>
                                    <div class="col-6 mt-4 text-end">
                                        <address>
                                            <strong>Invoice Date:</strong><br>
                                            {{ date('d-m-Y', strtotime($purchase->date)) }}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Items Purchase Invoice</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Supplier</strong></td>
                                                    <td class="text-center"><strong>Category</strong></td>
                                                    <td class="text-center"><strong>Product Name</strong></td>
                                                    <td class="text-center"><strong>Quantity</strong></td>
                                                    <td class="text-center"><strong>Unit Price</strong></td>
                                                    <td class="text-center"><strong>Total Price</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                $total_sum = 0;
                                                @endphp
                                                @foreach($relatedPurchases as $details)
                                                <tr>
                                                    <td class="text-center">{{ $details->supplier->name ?? 'N/A' }}</td>
                                                    <td class="text-center">{{ $details->category->name ?? 'N/A' }}</td>
                                                    <td class="text-center">{{ $details->product->name ?? 'N/A' }}</td>
                                                    <td class="text-center">{{ $details->buying_qty ?? 'N/A' }}</td>
                                                    <td class="text-center">{{ $details->unit_price ?? 'N/A' }}</td>
                                                    <td class="text-center">{{ $details->buying_price ?? 'N/A' }}</td>
                                                </tr>
                                                @php
                                                $total_sum += $details->buying_price;
                                                @endphp
                                                @endforeach

                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center"><strong>Grand Amount</strong></td>
                                                    <td class="thick-line text-end">AED{{ $total_sum }}</td>
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
