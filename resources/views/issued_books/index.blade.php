@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Issued Books</h1>
                </div>
            </div>
        </div>

        <button class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" data-bs-toggle="modal"
            onclick="addFormShow()" data-bs-target="#myModal">
            <i data-acorn-icon="plus"></i>
            <span>Issue Book</span>
        </button>
        <button class="btn btn-icon btn-icon-start btn-outline-primary mb-4" type="button" data-bs-toggle="modal"
            data-bs-target="#returnModal">
            <i data-acorn-icon="rotate-left"></i>
            <span>Return Book</span>
        </button>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['ID', 'Book Name', 'User name', 'Issue Date', 'Return Date', 'status', 'fine', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('issued_books.modal.returnBook')

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['lib_id', 'book_name', 'user_name', 'issued_date', 'return_date', 'return_status', 'fine',
            'action'
        ];
        var get_data_url = "{{ route('get_issuedBooks') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('issuedBooks.create') }}"
        var save_data_url = "{{ route('issuedBooks.store') }}"
        var add_title = "Issue Book"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('issuedBooks.edit', ':id') }}'
        var update_data_url = '{{ route('issuedBooks.update', ':id') }}'
        var edit_title = "Edit Record"
    </script>
    @include('common.js.edit_data')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('issuedBooks.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')


    <script>
        $('input[name="returnRadio"]').change(function() {
            // Get the value of the selected radio button
            const selectedValue = $('input[name="returnRadio"]:checked').val();

            // Show or hide the appropriate section based on the selected value
            if (selectedValue === 'issueid') {
                $('#issueid-section').show();
                $('#user-name-section').hide();
            } else if (selectedValue === 'user_name') {
                $('#issueid-section').hide();
                $('#user-name-section').show();
            }
        });


        $('#issued_book_filter').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            console.log('formData: ', formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('return_issuedBooks') }}',
                data: formData,
                success: function(response) {
                    console.log('response: ', response);
                    var filter_data = $('.filter_books')
                    filter_data.html('')
                    if (typeof response === "object" && response.length == 0) {
                        filter_data.html('No Books found')
                    }

                    response.forEach(element => {
                        console.log('element: ', element);

                        filter_data.append(`<div class="card mb-2  border-primary"  onclick="book_detail(${element.id})">
                        <a href="#" class="row g-0 sh-10">
                            <div class="col-auto">
                                <div class="sw-9 sh-10 d-inline-block d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-search undefined"><circle cx="9" cy="9" r="7"></circle><path d="M14 14L17.5 17.5"></path></svg>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                                    <div class="d-flex flex-column">
                                        <div class="text-primary book_name">${element.book.name}</div>
                                        <div class="text-small text-muted issue_date">issued date: ${element.issued_date}</div>
                                        <div class="text-small text-muted release_date">return date: ${element.return_date}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('error: ', xhr.responseJSON);
                    myalert("error", xhr.responseJSON, 10000);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function book_detail(id) {
            console.log('id: ', id);
            var show_status_url = '{{ route('return_book', ':id') }}'

            $('#modalTitle_simple').html('Return Book');
            $('.simpleModal_body').html('');
            url = show_status_url.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#returnModal').modal('hide');
                    $('#simpleModal').modal('show');
                    console.log('data: ', data);
                    $('.simpleModal_body').html(data);
                },
            });
        }

        function fine_save() {
            let singleDeleteDraw = {
                ...dataTable
            };

            var fine = $('#fine_save').val()
            var id = $('#issue_id').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('return_book_data') }}",
                data: {
                    fine: fine,
                    id: id,
                },
                success: function(response) {
                    console.log('response: ', response);
                    singleDeleteDraw._fnDraw();
                    myalert("success", response, 5000);
                    $('#simpleModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log('error: ', xhr.responseJSON);
                    myalert("error", xhr.responseJSON, 10000);
                },
            });
        }
    </script>
@endsection
