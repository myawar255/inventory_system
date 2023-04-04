<div class="row g-0 align-items-center">
    @if ($data->image_url != null)
        <div class="col-5 pe-5">
            <img src="{{ $data->image_url }}" class="card-img sh-15 sh-sm-25 scale mb-5" alt="vertical content image">
        </div>
    @endif
    <div class="col ps-0">
        <div class="card-body ps-0">
            <h2 class="text-primary mb-0">{{ $data->name }}</h2>
            <h6 class="text-alternate">{{ $data->isbn_number }}</h6>
        </div>
    </div>
</div>


<div class="mb-3">
    <h4>Description</h4>
    <p class="text-alternate">{{ $data->desc }}</p>
</div>

<div class="mb-3">
    <h4>Availability</h4>
    <p class="text-alternate">{{ $data->remaining }}</p>
</div>
<div class="mb-3">
    <h4>Category</h4>
    <p class="text-alternate"><span class="badge"
            style="background:{{ $data->category->background }}">&nbsp;&nbsp;</span>{{ $data->category->name }}</p>
</div>
<div class="mb-3">
    <h4>Author</h4>
    <p class="text-alternate">{{ $data->author->name }}</p>
</div>
<div class="mb-3">
    <h4>Published Date</h4>
    <p class="text-alternate">{{ $data->published_date }}</p>
</div>


@if ($data->remaining < 1)
    @if ($data->checkreserve())
        <div class="">
            <div class="alert alert-primary" role="alert">You have reserved This Book</div>
        </div>
    @else
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-primary me-2 reserveMe"
                onClick="reserveMe({{ $data->id }})">Reserve
                Book</button>
        </div>
    @endif
@else
    @if ($data->checkborrowed())
        <div class="">
            <div class="alert alert-primary" role="alert">You have Borrowed This Book</div>
        </div>
    @else
        <div class="borrowbox" style="display:none">
            <div class="fv-row mb-5 fv-plugins-icon-container">
                <label class="form-label">Issued Date</label>
                <input type="date" class="form-control" id="issue_date" min="{{ date('Y-m-d') }}"
                    value="{{ date('Y-m-d') }}" />
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="fv-row mb-5 fv-plugins-icon-container">
                <label class="form-label">Return Date</label>
                <input type="date" class="form-control" id="return_date" />
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <input type="hidden" id="book_id" value="{{ $data->id }}">
            <input type="hidden" id="user_id" value="{{ auth()->id() }}">
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-primary me-2 BorrowMe" onClick="BorrowMe()">Borrow
                Book</button>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-primary me-2 saveBorrow" style="display: none"
                onClick="saveBorrow({{ $data->id }})">Borrow Book</button>
        </div>
    @endif
@endif
<div class="reservebox"></div>


<script>
    function reserveMe(id) {
        console.log('id: ', id);
        $.ajax({
            type: 'POST',
            url: "{{ route('reserve_request.save_reserved_request') }}",
            data: {
                book_name: id,
                user_name: "{{ auth()->id() }}",
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log('data: ', data);
                $('.reserveMe').hide();
                $('.reservebox').html(
                    '<div class="alert alert-primary" role="alert">You have reserved This Book</div>');
            },
        });
    }

    function BorrowMe() {
        $('.borrowbox').show()
        $('.BorrowMe').hide()
        $('.saveBorrow').show()
    }

    function saveBorrow(id) {
        console.log('id: ', id);
        var issue_date = $('#issue_date').val();
        var return_date = $('#return_date').val();
        if (issue_date != '' && return_date != '') {
            $.ajax({
                type: 'POST',
                url: "{{ route('borrow_request.save_borrow_request') }}",
                data: {
                    issue_date: issue_date,
                    return_date: return_date,
                    book_name: $('#book_id').val(),
                    user_name: $('#user_id').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('data: ', data);
                    $('.saveBorrow').hide();
                    $('.borrowbox').html(
                        '<div class="alert alert-primary" role="alert">Borrowed Request Sent to Librarian</div>'
                    );
                },
            });
        }
    }
</script>
