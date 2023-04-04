@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6 mb-5">

                    <h1 class="mb-0 pb-0 display-4" id="title">Requested Books</h1>
                </div>
            </div>
        </div>

        <a href="{{route('requested_books.add_request')}}" class="btn btn-icon btn-icon-start btn-primary mb-4" type="button">
            <i data-acorn-icon="plus"></i>
            <span>Request Book</span>
        </a>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['User', 'Book Name', 'Author', 'Subject', 'Description', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['user_name', 'book_name', 'author_name', 'subject', 'desc', 'action'];
        var get_data_url = "{{ route('requested_books.get_requested_books') }}"
    </script>
    @include('common.js.get_data')
    {{-- **Save Data** --}}

    <script>
          function deleteData(id) {
            let singleDeleteDraw = {
                ...dataTable
            };

            var url = '{{ route('requested_books.delete_book_request', ':id') }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    url = url;

                    axios({
                            method: 'get',
                            url: url
                        })
                        .then(function(response) {
                            singleDeleteDraw._fnDraw();
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            )
                        })
                        .catch(function(error) {});

                }
            })
        }
    </script>
@endsection
