<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">ISBN number</label>
    <input type="text" name="isbn_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ISBN number"
        value="{{ $data->isbn_number }}">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Book Name</label>
    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Book Name"
        value="{{ $data->name }}">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Description</label>
    <input type="text" name="desc" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description"
        value="{{ $data->desc }}">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="form-label">Published Date</label>
    <input type="date" class="form-control" name="published_date" id="datePickerBasic"  value="{{$data->published_date}}"/>
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Price</label>
    <input type="text" name="price" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Price"
        value="{{ $data->price }}">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Category</label>
    <select id="inputState" name="category" class="form-select">
        <option selected="selected">Choose...</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @if ($cat->id == $data->category_id) selected @endif>{{ $cat->name }}
            </option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Author</label>
    <select id="inputState" name="author" class="form-select">
        <option selected="selected">Choose...</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" @if ($author->id == $data->author_id) selected @endif>{{ $author->name }}
            </option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Cover Image</label>
    <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Cover Image"
        value="">
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



