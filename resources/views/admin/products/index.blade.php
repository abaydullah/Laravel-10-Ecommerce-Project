@extends('admin.layouts.main')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/toastr/toastr.min.css')}}"
@endpush
@section('title','Products')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-content-between px-5 py-3">
                                <div class="">
                                    <h3 class="card-title">Products</h3>
                                </div>
                                <div class="">
                                    @if(session('delete'))
                                        <span class="alert alert-danger" role="alert">{{session('delete')}}</span>
                                    @endif
                                    @if(session('create'))
                                        <span class="alert alert-success" role="alert">{{session('create')}}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                        Add Category
                                    </button>
                                </div>

                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th style="width: 2%">
                                            #
                                        </th>
                                        <th style="width: 15%">
                                            Name
                                        </th>
                                        <th style="width: 10%">
                                            Code
                                        </th>
                                        <th style="width: 10%">
                                            Price
                                        </th>
                                        <th style="width: 10%">
                                            Discount
                                        </th>
                                        <th style="width: 10%">
                                            Category
                                        </th>
                                        <th style="width: 10%">
                                            Brand
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 15%">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $key => $product)
                                    <tr>
                                        <td>
                                            {{$key+1}}
                                        </td>
                                        <td>
                                            {{$product->name}}
                                            <br/>
                                            <small>
                                                Created  {{$product->created_at->diffForHumans()}}
                                            </small>
                                        </td>
                                        <td>
                                            {{$product->code}}
                                        </td>
                                        <td>
                                            {{$product->selling_price}}
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$product->discount_price}}" aria-valuemin="0" aria-valuemax="100" style="width:  {{$product->discount_price/($product->selling_price/100)}}%">
                                                </div>
                                            </div>
                                            <small class="text-center">
                                                {{$product->discount_price}}
                                            </small>
                                        </td>
                                        <td>
                                            @foreach($product->categories as $category)
                                            <span class="badge badge-success">{{$category->name}}</span>
                                            @endforeach
                                        </td>

                                        <td class="project_progress">
                                            @if(isset($product->brand))
                                           <span> {{$product->brand->name}}</span>
                                            @endif
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-eye">
                                                </i>

                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{route('admin.products.edit',$product->id)}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>

                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-'+{{$product->id}}).submit();">
                                                <i class="fas fa-trash">
                                                </i>

                                            </a>
                                            <form action="{{route('admin.products.destroy',$product->id)}}" method="post" id="delete-form-{{$product->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                Product Not Found
                                            </td>

                                        </tr>
                                    @endforelse
                                    </tbody>

                                </table>
                                {{$products->links()}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- /.add modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" placeholder="order" name="order">
                                </div>

                            </div>
                            <!-- /.card-body -->

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary swalDefaultSuccess">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.add modal -->
        <!-- /.edit modal -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.update','test') }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"  name="name">
                            </div>
                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" class="form-control" id="order" placeholder="order" name="order">
                            </div>


                            <!-- /.card-body -->

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.edit modal -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/admin/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)

            var name = button.data('name')
            var order = button.data('order')
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #order').val(order);
            modal.find('.modal-body #id').val(id);

        });

        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });


    </script>

@endpush
