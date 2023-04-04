<div class="fv-row mb-5 fv-plugins-icon-container">
    <div class="mb-3">
        <h4>Selected Book</h4>
        <p class="text-alternate">{{ $book->name }}</p>
    </div>
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Select User</label>
    <select id="inputState" name="user_name" class="form-select">
        <option value="" selected disabled>Choose...</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>{{ $user->complete_name() }}
            </option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="form-label">Issued Date</label>
    <input type="date" class="form-control" name="issue_date" id="datePickerBasic"
        value="{{ $data->issued_date }}" />
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="form-label">Return Date</label>
    <input type="date" class="form-control" name="return_date" id="datePickerBasic"
        value="{{ $data->return_date }}" />
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>

<input type="hidden" name="id" value="{{ $data->id }}">


<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit">
        <span class="indicator-label">Submit</span>
    </button>
</div>
