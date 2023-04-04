@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6 mb-5">
                    @if ($cat_id != null)
                        <h1 class="mb-0 pb-0 display-4" id="title"><span
                                class="text-primary fw-bold">{{ $category->name }}</span>&nbsp;<span>Books</span></h1>
                    @else
                        <h1 class="mb-0 pb-0 display-4" id="title">Books Managment</h1>
                    @endif
                </div>
            </div>
        </div>

        <button class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal"
            onclick="addFormShow()" data-bs-target="#myModal">
            <i data-acorn-icon="plus"></i>
            <span>Add Book</span>
        </button>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['ISBN Number', 'Name', 'Category', 'Author', 'Quantity', 'Remaining', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['isbn_number', 'name', 'category', 'author', 'qty', 'remaining', 'action'];
        var get_data_url = "{{ route('get_books') }}?cat_id={{ $cat_id }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('book.create') }}"
        var save_data_url = "{{ route('book.store') }}"
        var add_title = "Add Book"
    </script>
    @include('common.js.add_data')


    {{-- **View Data** --}}
    <script>
        var show_form_url = '{{ route('book.show', ':id') }}'
        var view_title = "Book Info"
    </script>
    @include('common.js.view_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('book.edit', ':id') }}'
        var update_data_url = '{{ route('book.update', ':id') }}'
        var edit_title = "Edit Book"
    </script>
    @include('common.js.edit_data_post')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('book.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')

    <script>
        function view_issue_status(id) {
            console.log('id: ', id);
            var show_status_url = '{{ route('book.view_book', ':id') }}/true'

            $('#simpleModal').modal('show');
            $('#modalTitle_simple').html('View Status');
            $('.simpleModal_body').html('');
            url = show_status_url.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('.simpleModal_body').html(data);
                },
            });
        }
    </script>
@endsection
