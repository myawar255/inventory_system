<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Full Name</label>
    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full Name"
        value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Address
    </label>
    <input type="text" name="address" class="form-control form-control-solid mb-3 mb-lg-0" value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('address')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Phone</label>
    <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('phone')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Comment</label>
    <input type="text" name="comment" class="form-control form-control-solid mb-3 mb-lg-0">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('comment')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>




<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit">
        <span class="indicator-label">Submit</span>
    </button>
</div>
