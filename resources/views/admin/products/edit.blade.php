@extends('admin.layouts.main')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/toastr/toastr.min.css')}}"
@endpush
@section('title','Coupons')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

                <form action="{{route('admin.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputName">Product Name</label>
                                        <input type="text" id="inputName" class="form-control" name="name" value="{{$product->name}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName">Product Code</label>
                                        <input type="text" id="inputName" class="form-control" name="code" value="{{$product->code}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName">Product Quantity</label>
                                        <input type="text" id="inputName" class="form-control" name="quantity" value="{{$product->quantity}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName">Product Selling Price</label>
                                        <input type="text" id="inputName" class="form-control" name="selling_price" value="{{$product->selling_price}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName">Product Discount Price</label>
                                        <input type="text" id="inputName" class="form-control" name="discount_price" value="{{$product->discount_price}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputDescription">Product Description</label>
                                        <textarea id="inputDescription" class="form-control" rows="4" name="details">{{$product->details}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputName">Product Video Link</label>
                                        <input type="url" id="inputName" class="form-control" name="video_link" value="{{$product->video_link}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName">Main Slider</label><br>
                                        <input type="checkbox" name="main_slider" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{$product->main_slider}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName">Hot Deals</label><br>
                                        <input type="checkbox" name="hot_deal" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{$product->hot_deal}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName">Best Rated</label><br>
                                        <input type="checkbox" name="best_rated" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{$product->best_rated}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName">Hot New</label><br>
                                        <input type="checkbox" name="hot_new" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{$product->hot_new}}">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Brand And Category</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file"  class="form-control" name="image" onchange="ReadImage(this);">
                                <img src="{{'/'.$product->image}}" alt="" class="product-image-thumb" id="image">

                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Brands</label>
                                <select id="inputStatus" class="form-control custom-select" name="brand_id">
                                    <option selected>Select one</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}"   {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="categories[]">
                                    @foreach($categories as $category)
                                        <option
                                            @foreach($product->categories as $postcategory)
                                            {{$postcategory->id == $category->id ? 'selected' : ''}}
                                            @endforeach
                                            value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="inputName">Product Color</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select a Color" style="width: 100%;" name="color[]">
                                        @foreach(explode(',',$product->color) as $color)
                                        <option value="{{$color}}" selected>{{$color}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="inputName">Product Size</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select a Size" style="width: 100%;" name="size[]">
                                        @foreach(explode(',',$product->size) as $size)
                                            <option value="{{$size}}" selected>{{$size}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="inputName">Product Photos</label>
                                    <input type="file" id="inputName" class="form-control" name="photos[]" multiple>
                                </div>

                            <div class="form-group d-flex justify-content-between">
                                <label for="inputName">Publish : </label>
                                <input type="checkbox" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new Product" class="btn btn-success float-right">
                </div>
            </div>
                </form>
        </section>
        <!-- /.content -->
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
    <!-- Bootstrap Switch -->
    <script src="{{asset('/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('/admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>

        function ReadImage(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                    .attr('src', e.target.result)
                    .width(80)
                };
                reader.readAsDataURL(input.files[0])
            }
        };

        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)

            var code = button.data('code')
            var percentage = button.data('percentage')
            var expire_date = button.data('expire_date')
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #percentage').val(percentage);
            modal.find('.modal-body #expire_date').val(expire_date);
            modal.find('.modal-body #id').val(id);

        });

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2(
                {
                    tags: true
                }
            )

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    </script>

@endpush
