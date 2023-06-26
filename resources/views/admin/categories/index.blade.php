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
@section('title','Categories')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                    <h3 class="card-title">Categories</h3>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $key => $category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>{{$category->order}}</td>
                                        <td><button class="btn btn-info" data-parent_id="{{$category->parent_id}}" data-name="{{$category->name}}" data-id="{{$category->id}}" data-order="{{$category->order}}" data-toggle="modal" data-target="#edit">Edit</button>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-'+{{$category->id}}).submit();" class="btn btn-danger">Delete</a>
                                            <form action="{{route('admin.categories.destroy',$category->id)}}" method="post" id="delete-form-{{$category->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Category Not Found</td>

                                    </tr>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
                                    <label for="parent_id">Parent</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
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
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
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
            var parent_id = button.data('parent_id')
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #order').val(order);
            modal.find('.modal-body #parent_id').val(parent_id);
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
