@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Category Managment</h1>
                </div>
            </div>
        </div>

        <button class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal"
            onclick="addFormShow()" data-bs-target="#myModal">
            <i data-acorn-icon="plus"></i>
            <span>Add Category</span>
        </button>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['Colour', 'Name', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['bg_color', 'name', 'action'];
        var get_data_url = "{{ route('get_categories') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('categories.create') }}"
        var save_data_url = "{{ route('categories.store') }}"
        var add_title = "Add Category"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('categories.edit', ':id') }}'
        var update_data_url = '{{ route('categories.update', ':id') }}'
        var edit_title = "Edit Category"
    </script>
    @include('common.js.edit_data_post')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('categories.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')


    {{-- **View Books** --}}
    <script>
        function viewFormShow(id) {
            event.preventDefault();
            var cat_by_books_url = "{{ route('book.index') }}?cat_id=" + id
            window.location.href = cat_by_books_url
        }
    </script>
@endsection
