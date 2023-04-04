@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6 mb-5">

                    <h1 class="mb-0 pb-0 display-4" id="title">Return Book</h1>
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
                                    <div class="display_return_content"></div>
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="required fw-bold fs-6 mb-2">Issue Record (issueId)</label>
                                        <select id="issue_id_select" name="issued_book_id" class="form-select">
                                            <option value="" selected disabled>Select Issued Book ID</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">lib_{{ $book->book->id }}</option>
                                            @endforeach
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        @error('book_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="form-label">New Return Date</label>
                                        <input type="date" class="form-control" name="return_date" id="datePickerBasic"
                                            min="{{ date('Y-m-d') }}" required />
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
                url: "{{ route('return_request.save_return_request') }}",
                data: formData,
                success: function(response) {
                    myalert("Return Request Generated Successfully", response, 5000);
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
