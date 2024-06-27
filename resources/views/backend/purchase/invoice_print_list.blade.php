@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Print Purchase All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{ route('purchase.add') }}" class="btn btn-secondary waves-effect waves-light" style="float:right;">Add Invoice</a>
                    <br><br>

                        <h4 class="card-title">Invoice All Data</h4><br>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $displayedInvoiceIds = [];
                                @endphp
                                @foreach($allData as $key => $item)
                                    @if(!in_array($item->purchase_no, $displayedInvoiceIds))
                                        @php
                                            $displayedInvoiceIds[] = $item->purchase_no;
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            
                                            <td>#{{ $item->purchase_no }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                            <td>
                                                <a href="{{ route('print.purchase', $item->id) }}" class="btn btn-info sm" title="Print Invoice"><i class="fas fa-print"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>

@endsection
