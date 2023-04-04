@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6 mb-5">

                    <h1 class="mb-0 pb-0 display-4" id="title">Renew Book</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row g-0 justify-content-center">
                            <div class="col-8">
                                <form method="POST" enctype="multipart/form-data" id="renew_books">
                                    @csrf

                                    @if (isset($book_id) && $book_id != null)
                                        @php
                                            $book_info = $issued_book_info->book;
                                        @endphp
                                        <div class="row g-0 align-items-center">
                                            @if ($book_info->image_url != null)
                                                <div class="col-5 pe-5">
                                                    <img src="{{ $book_info->image_url }}"
                                                        class="card-img sh-15 sh-sm-25 scale mb-5"
                                                        alt="vertical content image">
                                                </div>
                                            @endif
                                            <div class="col ps-0">
                                                <div class="card-body ps-0">
                                                    <h2 class="text-primary mb-0">{{ $book_info->name }}</h2>
                                                    <h6 class="text-alternate">{{ $book_info->isbn_number }}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <h4>Description</h4>
                                            <p class="text-alternate">{{ $book_info->desc }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h4>Published Date</h4>
                                            <p class="text-alternate">{{ $book_info->published_date }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h4>Category</h4>
                                            <p class="text-alternate"><span class="dot"
                                                    style="background:{{ $book_info->category->background }}"></span>
                                                &nbsp;{{ $book_info->category->name }}
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <h4>Author</h4>
                                            <p class="text-alternate">{{ $book_info->author->name }}</p>
                                        </div>
                                        <input type="hidden" name="issued_book_id" value="{{ $book_id }}">
                                        <input type="hidden" name="user_name" value="{{ auth()->id() }}">
                                    @else
                                    

                                        <div class="display_return_content"></div>


                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="required fw-bold fs-6 mb-2">Issue Record (issueId)</label>
                                            <select id="issue_id_select" name="issued_book_id" class="form-select">
                                                <option value="" selected disabled>Select Issued Book ID</option>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->id }}">lib_{{ $book->id }}</option>
                                                @endforeach
                                            </select>
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                            @error('book_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif



                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="form-label">New Return Date</label>
                                        <input type="date" class="form-control" name="return_date" id="datePickerBasic"
                                            min="{{ date('Y-m-d') }}" required/>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        @error('return_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">
                                            <span class="indicator-label">Submit</span>
                                        </button>
                                    </div>

                                </form>
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
        $('#issue_id_select').change(function() {
            var id = $(this).val();
            const issue_url = '{{ route('renew_request.get_issue_data_on_renew', ':id') }}'
            new_url = issue_url.replace(':id', id)

            $.get(new_url, function(data) {
                $('.display_return_content').html(data)
            });
        });
        $('#renew_books').on('submit', function(e) {
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
                url: "{{ route('renew_request.save_renew_request') }}",
                data: formData,
                success: function(response) {
                    myalert("Renew Request Generated Successfully", response, 5000);
                    setTimeout(function() {
                        window.location.href = document.referrer;
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    myalert("error", xhr.responseJSON, 10000);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
@endsection
