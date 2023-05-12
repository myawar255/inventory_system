@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Customers</h1>
                </div>
            </div>
        </div>

        <button class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal"
            onclick="addFormShow()" data-bs-target="#myModal">
            <i data-acorn-icon="plus"></i>
            <span>Add Customer</span>
        </button>
        <a href="{{ route('export_customers') }}" class="btn btn-icon btn-icon-start btn-primary mb-4" type="button">
            <i data-acorn-icon="plus"></i>
            <span>Export Customer</span>
        </a>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['Name', 'Address', 'Phone', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['customer_name', 'customer_address', 'customer_phone', 'action'];
        var get_data_url = "{{ route('get_customers') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('customers.create') }}"
        var save_data_url = "{{ route('customers.store') }}"
        var add_title = "Add Customer"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('customers.edit', ':id') }}'
        var update_data_url = '{{ route('customers.update', ':id') }}'
        var edit_title = "Edit Customer"
    </script>
    @include('common.js.edit_data')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('customers.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')
@endsection
