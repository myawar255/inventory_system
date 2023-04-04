<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Select Book</label>
    <select id="book_name" name="book_name" class="form-select" onchange="getBookDetails()">
        <option value="" selected disabled>Choose...</option>
        @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->name }}</option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>
<div class="checking_availablity_block" style="display: none">
    <div class="alert alert-primary" role="alert">Checking Availablity</div>
</div>
<div class="book_available_block">

    <div class="fv-row mb-5 fv-plugins-icon-container">
        <label class="required fw-bold fs-6 mb-2">Select User</label>
        <select id="inputState" name="user_name" class="form-select">
            <option value="" selected disabled>Choose...</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->complete_name() }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="fv-row mb-5 fv-plugins-icon-container">
        <label class="form-label">Issued Date</label>
        <input type="date" class="form-control" name="issue_date" id="datePickerBasic" />
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="fv-row mb-5 fv-plugins-icon-container">
        <label class="form-label">Return Date</label>
        <input type="date" class="form-control" name="return_date" id="datePickerBasic" />
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>


    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">
            <span class="indicator-label">Submit</span>
        </button>
    </div>
</div>

<div class="book_unavailable_block" style="display: none">
    <div class="alert alert-danger" role="alert">This Book is not Available</div>
</div>


<script>
    function getBookDetails() {
        var bookId = document.getElementById("book_name").value;
        if (bookId != "") {
            $('.checking_availablity_block').show()
            // Send an AJAX request
            $.ajax({
                url: "{{ route('check_book_availability') }}",
                type: "POST",
                data: {
                    book_id: bookId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('.checking_availablity_block').hide()
                    // Do something with the response
                    console.log(response);
                    if (response < 1) {
                        $('.book_unavailable_block').show();
                        $('.book_available_block').hide();
                    } else {
                        $('.book_unavailable_block').hide();
                        $('.book_available_block').show();
                    }
                },
            });
        }
    }
</script>
