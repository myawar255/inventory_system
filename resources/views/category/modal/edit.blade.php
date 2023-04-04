<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Category Name</label>
    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full Name"
        value="{{ $data->name }}">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Category Colour</label>
    <input type="color" id="html5colorpicker" name="color" onchange="clickColor(0, -1, -1, 5)"
        value="{{ $data->background }}" style="width:85%;">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Category Image</label>
    <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0"
        placeholder="Category Image" value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

@if ($data->image_url != null)
    <img src="{{ $data->image_url }}" class="card-img sh-15 sh-sm-25 scale mb-5" alt="">
@endif

<input type="hidden" id="edit_id" name="id" value="{{ $data->id }}">

<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit">
        <span class="indicator-label">Submit</span>
    </button>
</div>
