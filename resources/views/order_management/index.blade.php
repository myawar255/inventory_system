@extends('layouts.app')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('acron/css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('acron/css/vendor/select2-bootstrap4.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Order Management</h1>
                </div>
            </div>
        </div>

        <a href="{{ route('order_management.create') }}" class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" >
            <i data-acorn-icon="plus"></i>
            <span>Add Order</span>
        </a>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['Order ID', 'Company Name', 'Status', 'Delivery Date', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    <script src="{{ asset('acron/js/vendor/select2.full.min.js') }}"></script>
    <script src="{{ asset('acron/js/forms/controls.select2.js') }}"></script>

    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['order_number', 'company_name', 'status', 'delivery', 'action'];
        var get_data_url = "{{ route('get_orders') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('order_management.create') }}"
        var save_data_url = "{{ route('order_management.store') }}"
        var add_title = "Add Order"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('products.edit', ':id') }}'
        var update_data_url = '{{ route('products.update', ':id') }}'
        var edit_title = "Edit Order"
    </script>
    @include('common.js.edit_data')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('products.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')
@endsection
