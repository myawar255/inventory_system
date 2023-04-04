@php
    $data = $return->issued_book->book;
@endphp
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
    <h4>Issued Date</h4>
    <p class="text-alternate">{{ $return->issued_book->issued_date }}</p>
</div>
<div class="mb-3">
    <h4>Return Date</h4>
    <p class="text-alternate">{{ $return->issued_book->return_date }}</p>
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Fine</label>
    <input type="number" name="fine" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Fine"
        value="0" required>
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>

<input type="hidden" name="id" value="{{ $return->id }}">


<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit">
        <span class="indicator-label">Approve</span>
    </button>
</div>
