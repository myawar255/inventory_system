@extends('layouts.app')
@section('content')

<div class="container">
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h1 class="mb-0 pb-0 display-4" id="title">Add Order</h1>
            </div>
        </div>
    </div>

    <div class="fv-row mb-5 fv-plugins-icon-container">
        <label class="required fw-bold fs-6 mb-2">Company Name</label>
        <input type="text" name="company_name" class="form-control form-control-solid mb-3 mb-lg-0" value="">
        <div class="fv-plugins-message-container invalid-feedback"></div>
        @error('company_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="row add_more">
        <div>
            <a onclick="add_more()" >
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
</div>
@endsection
@section('js_after')
    <script>
        function add_more(count=null) {
            count ++;
            console.log('count: ', count);
            var url = '{{ route('get_more_products', ':count') }}';
            url = url.replace(':count', count);
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
    </script>
@endsection
