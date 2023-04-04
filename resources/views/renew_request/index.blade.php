@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6 mb-5">

                    <h1 class="mb-0 pb-0 display-4" id="title">Renew Request</h1>
                </div>
            </div>
        </div>

        <a href="{{ route('renew_request.add_renew_request') }}" class="btn btn-icon btn-icon-start btn-primary mb-4"
            type="button">
            <i data-acorn-icon="plus"></i>
            <span>Renew Request</span>
        </a>

        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = ['issuedBook ID', 'User Name', 'Book Name', 'Requested Return Date', 'approved', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = ['issuedBookID', 'user_name', 'book_name', 'return_date', 'approved', 'action'];
        var get_data_url = "{{ route('renew_request.get_renew_request') }}"
    </script>
    @include('common.js.get_data')
    {{-- **Save Data** --}}

    <script>
        function deleteData(id) {
            let singleDeleteDraw = {
                ...dataTable
            };

            var url = '{{ route('renew_request.delete_renew_request', ':id') }}';
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

        function approveData(id) {
            $('#myModal').modal('show');
            var approveData_url = '{{ route('renew_request.show_renew_approve_req', ':id') }}'
            url = approveData_url.replace(':id', id);
            event.preventDefault();
            $('#modalTitle').html("Approve Renew Request");
            $('#add_data_form').html('');
            $.get({
                url: url,
                success: function(data) {
                    $('#edit_data_form').html(data);
                },
            });
        }

        $('#edit_data_form').on('submit', function(e) {
            e.preventDefault();
            let singleDeleteDraw = {
                ...dataTable
            };

            var formData = new FormData(this);
            console.log('formData: ', formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('renew_request.approve_renew') }}",
                data: formData,
                success: function(response) {
                    myalert("success", response, 5000);
                    singleDeleteDraw._fnDraw();
                    $('#myModal').modal('hide')
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
    </script>
@endsection
