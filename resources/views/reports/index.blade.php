@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4" id="title">Dashboard</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <a href="{{ route('reports.print') }}" class="btn btn-icon btn-icon-start btn-primary mb-4 download_btn" type="button">
            <i data-acorn-icon="arrow-double-right"></i>
            <span>Generate Report</span>
        </a>
        <!-- Title and Top Buttons End -->

        <div class="row g-2">
            <div class="col-12 col-xl-4 mb-5">
                <div class="card bg-gradient-light">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="border border-white sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="book" class="text-white"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3 text-white">Total Books
                            </div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-white total_books">
                                <div class="spinner-border text-white" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card bg-gradient-light">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="border border-white sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="book" class="text-white"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3 text-white">Issued Books
                            </div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-white issued_books">
                                <div class="spinner-border text-white" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card bg-gradient-light">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="border border-white sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="book" class="text-white"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3 text-white">Returned Books
                            </div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-white returned_books">
                                <div class="spinner-border text-white" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-2">
            <div class="col-12 col-xl-4 mb-5">
                <div class="card active">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary">
                                <i data-acorn-icon="book" class="text-primary"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Requested Books</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary requested_books">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card active">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary">
                                <i data-acorn-icon="book" class="text-primary"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Reserved Books</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary reserved_books">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card active">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary">
                                <i data-acorn-icon="book" class="text-primary"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Renewed Books</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary renewed_books">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-2">
            <div class="col-12 col-xl-4 mb-5">
                <div class="card hover-border-primary">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="bg-gradient-light sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="user" class="text-white"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Total Users</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary total_users">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card hover-border-primary">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="bg-gradient-light sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="user" class="text-white"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Total Students</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary total_students">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-5">
                <div class="card hover-border-primary">
                    <div class="h-100 row g-0 card-body align-items-center">
                        <div class="col-auto">
                            <div
                                class="bg-gradient-light sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                <i data-acorn-icon="user" class="text-white"></i>

                            </div>
                        </div>
                        <div class="col">
                            <div class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">Total Faculty</div>
                        </div>
                        <div class="col-auto ps-3">
                            <div class="display-5 text-primary total_faculty">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        var arr = ['total_books', 'issued_books', 'returned_books', 'requested_books', 'reserved_books', 'renewed_books',
            'total_users', 'total_students', 'total_faculty'
        ]

        $.each(arr, function(index, value) {
            var myUrl = '{{ route('reports.getData', ':value') }}'
            url = myUrl.replace(':value', value);


            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(`.${value}`).html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error getting ' + value + ': ' + textStatus + ' - ' + errorThrown);
                }
            });
        });
    </script>
@endsection
