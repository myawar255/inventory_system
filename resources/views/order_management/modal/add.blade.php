@extends('layouts.app')
@section('css_after')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Add Order</h1>
                </div>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data" id="add_order">

            <div class="fv-row mb-5 fv-plugins-icon-container">
                <label class="required fw-bold fs-6 mb-2">Company Name</label>
                <input type="text" name="company_name" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @error('company_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row add_more">
                <div>
                    <a onclick="add_more()">
                        <i class="bi bi-plus-circle float-end" style="font-size: 22px"></i>
                    </a>
                </div>
                <div class="col-7">
                    <div class="fv-row mb-5 fv-plugins-icon-container">
                        <label class="required fw-bold fs-6 mb-2">Select Product</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="product_name">
                            <option label="&nbsp;"></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->productname }}</option>
                            @endforeach
                        </select>

                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-5">
                    <div class="fv-row mb-5 fv-plugins-icon-container ">
                        <label class="required fw-bold fs-6 mb-2">Quantity</label>
                        <input type="text" name="quantity" class="form-control form-control-solid mb-3 mb-lg-0 me-2">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @error('sale_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">

                    <div class="fv-row mb-5 fv-plugins-icon-container">
                        <label class="required fw-bold fs-6 mb-2">Order Date</label>
                        <input type="date" name="order_date" class="form-control form-control-solid mb-3 mb-lg-0">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @error('order_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">

                    <div class="fv-row mb-5 fv-plugins-icon-container">
                        <label class="required fw-bold fs-6 mb-2">Expecting Delievry Date</label>
                        <input type="date" name="deleivery_date" class="form-control form-control-solid mb-3 mb-lg-0">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @error('deleivery_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">
                    <span class="indicator-label">Submit</span>
                </button>
            </div>
        </form>
    </div>
@endsection
@section('js_after')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        var count = 1;

        function add_more() {
            count++;
            var url = '{{ route('get_more_products', ':count') }}';
            url = url.replace(':count', count);
            console.log('count: ', count);
            $.ajax({
                type: 'GET',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('.add_more').append(data)

                },
            });
        }

        function removeClubField(count) {
            $('.add_more' + count).remove();
        }

        $('#add_order').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('order_management.store') }}",
            data: formData,
            success: function(responce) {
                myalert("success", responce, 5000);
                var frm = $('#add_order')[0];
                frm.reset();
                return false;

            },
            error: function(xhr, status, error) {
                myalert("error", xhr.responseJSON.message, 10000);
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });
    </script>
@endsection



