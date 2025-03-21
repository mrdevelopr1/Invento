@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Product All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{route('product.add')}}" class="btn btn-secondary waves-effect waves-light" style="float:right;">Add Product</a>
                    <br><br>

                        <h4 class="card-title">Product All Data</h4><br>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Supplier Name</th>
                                <th>Unit</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($products as $key =>$item)
                            <tr>
                                <td>{{( $key+1 )}}</td>
                                <td>{{( $item->name )}}</td>
                                <td>{{( $item['supplier']['name'] ?? 'N/A' )}}</td>
                                <td>{{( $item['unit']['name'] ?? 'N/A' )}}</td>
                                <td>{{( $item['category']['name'] ?? 'N/A' )}}</td>
                                <td>AED {{( $item->unit_price ?? 'N/A' )}}</td>
                                <td>
                                    <a href="{{route('product.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>

                                    <a href="{{route('product.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
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