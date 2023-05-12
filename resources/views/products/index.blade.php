@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Products</h1>
                </div>
            </div>
        </div>

        <button class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal"
            onclick="addFormShow()" data-bs-target="#myModal">
            <i data-acorn-icon="plus"></i>
            <span>Add Product</span>
        </button>
        <a href="{{ route('export_customers') }}" class="btn btn-icon btn-icon-start btn-primary mb-4" type="button">
            <span>Export Products</span>
        </a>

        <a class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i data-acorn-icon="plus"></i>
          <span>Add Bulk Products</span>
      </a>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['Name', 'Purchase Price', 'Sale Price', 'Stock', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['productname', 'purchase_price', 'sale_price', 'stock', 'action'];
        var get_data_url = "{{ route('get_products') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('products.create') }}"
        var save_data_url = "{{ route('products.store') }}"
        var add_title = "Add Product"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('products.edit', ':id') }}'
        var update_data_url = '{{ route('products.update', ':id') }}'
        var edit_title = "Edit Product"
    </script>
    @include('common.js.edit_data')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('products.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')
@endsection
