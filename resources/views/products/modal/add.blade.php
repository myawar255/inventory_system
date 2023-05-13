<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Product Name</label>
    <input type="text" name="productname" class="form-control form-control-solid mb-3 mb-lg-0" value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('productname')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Purchase Price
    </label>
    <input type="text" name="purchase_price" class="form-control form-control-solid mb-3 mb-lg-0" value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('purchase_price')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Sale Price</label>
    <input type="text" name="sale_price" class="form-control form-control-solid mb-3 mb-lg-0">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('sale_price')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Opening Stock</label>
    <input type="text" name="opening_stock" class="form-control form-control-solid mb-3 mb-lg-0">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('opening_stock')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>




<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit">
        <span class="indicator-label">Submit</span>
    </button>
</div>
