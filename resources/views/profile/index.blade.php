@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4" id="title">Profile</h1>
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row">
            <!-- Left Side Start -->
            <div class="col-12 col-xl-4 col-xxl-3">
                <!-- Biography Start -->
                <h2 class="small-title">Profile</h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-column mb-4">
                            <div class="d-flex align-items-center flex-column">
                                <div class="sw-13 position-relative mb-3 d-flex justify-content-center">
                                    <img src="https://ui-avatars.com/api/?background=ECF5FF&color=1ea8e7&name={{ auth()->user()->name }}"
                                        class="img-fluid rounded-xl" alt="thumb" />
                                </div>
                                <div class="h5 mb-0">{{ auth()->user()->name }}</div>
                                <div class="text-muted">{{ auth()->user()->getRolenames()[0] }}</div>
                                <div class="text-muted">
                                    <i data-acorn-icon="email" class="me-1"></i>
                                    <span class="align-middle">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="nav flex-column" role="tablist">
                            <a class="nav-link active px-0 border-bottom border-separator-light" data-bs-toggle="tab"
                                href="#overviewTab" role="tab">
                                <i data-acorn-icon="activity" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Overview</span>
                            </a>
                            <a class="nav-link px-0 border-bottom border-separator-light" data-bs-toggle="tab"
                                href="#issuedBooksTab" role="tab">
                                <i data-acorn-icon="book" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Issued Books</span>
                            </a>
                            <a class="nav-link px-0 border-bottom border-separator-light" data-bs-toggle="tab"
                                href="#returnedBooksTab" role="tab">
                                <i data-acorn-icon="book" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Returned Books</span>
                            </a>
                            <a class="nav-link px-0 border-bottom border-separator-light" data-bs-toggle="tab"
                                href="#requestedBooksTab" role="tab">
                                <i data-acorn-icon="book" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Requested Books</span>
                            </a>
                            <a class="nav-link px-0" data-bs-toggle="tab" href="#reservedBooksTab" role="tab">
                                <i data-acorn-icon="book" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Reserved Books</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Biography End -->
            </div>
            <!-- Left Side End -->

            <!-- Right Side Start -->
            <div class="col-12 col-xl-8 col-xxl-9 mb-5 tab-content">
                <!-- Overview Tab Start -->
                <div class="tab-pane fade show active" id="overviewTab" role="tabpanel">
                    <!-- Stats Start -->
                    <h2 class="small-title">Stats</h2>
                    <div class="mb-5">
                        <div class="row g-2">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card hover-border-primary">
                                    <div class="card-body">
                                        <div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
                                            <span>Issued Books</span>
                                            <i data-acorn-icon="book" class="text-primary"></i>
                                        </div>
                                        <div class="cta-1 text-primary issued_books">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card hover-border-primary">
                                    <div class="card-body">
                                        <div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
                                            <span>Returned Books</span>
                                            <i data-acorn-icon="book" class="text-primary"></i>
                                        </div>
                                        <div class="cta-1 text-primary returned_books">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card hover-border-primary">
                                    <div class="card-body">
                                        <div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
                                            <span>Requested Books</span>
                                            <i data-acorn-icon="book" class="text-primary"></i>
                                        </div>
                                        <div class="cta-1 text-primary requested_books">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card hover-border-primary">
                                    <div class="card-body">
                                        <div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
                                            <span>Reserved Books</span>
                                            <i data-acorn-icon="book" class="text-primary"></i>
                                        </div>
                                        <div class="cta-1 text-primary reserved_books">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Stats End -->
                </div>
                <!-- Overview Tab End -->

                {{-- Issued Books Data will Render here --}}
                <div class="tab-pane fade" id="issuedBooksTab" role="tabpanel">
                </div>

                {{-- Returned Books Data will Render Here --}}
                <div class="tab-pane fade" id="returnedBooksTab" role="tabpanel">
                </div>

                {{-- Requested Books Data will Render Here --}}
                <div class="tab-pane fade" id="requestedBooksTab" role="tabpanel">
                </div>

                {{-- Reserved Books Data will Render Here --}}
                <div class="tab-pane fade" id="reservedBooksTab" role="tabpanel">
                </div>
            </div>
            <!-- Right Side End -->
        </div>
    </div>
@endsection


@section('js_after')
    <script>
        $.ajax({
            url: '{{ route('profile.get_issued_books') }}',
            success: function(html) {
                console.log('html: ', html);
                $('#issuedBooksTab').html(html);
            }
        });
        $.ajax({
            url: '{{ route('profile.get_returned_books') }}',
            success: function(html) {
                console.log('html: ', html);
                $('#returnedBooksTab').html(html);
            }
        });
        $.ajax({
            url: '{{ route('profile.get_requested_books') }}',
            success: function(html) {
                console.log('html: ', html);
                $('#requestedBooksTab').html(html);
            }
        });
        $.ajax({
            url: '{{ route('profile.get_reserved_books') }}',
            success: function(html) {
                console.log('html: ', html);
                $('#reservedBooksTab').html(html);
            }
        });

        var arr = ['issued_books', 'returned_books', 'requested_books', 'reserved_books']

        $.each(arr, function(index, value) {
            var myUrl = '{{ route('profile.getData', ':value') }}'
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
