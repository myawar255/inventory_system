<div class="fv-row mb-5 fv-plugins-icon-container">
    <label class="required fw-bold fs-6 mb-2">Order Name</label>
    <input type="text" name="orderName" class="form-control form-control-solid mb-3 mb-lg-0" value="">
    <div class="fv-plugins-message-container invalid-feedback"></div>
    @error('orderName')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<section class="scroll-section" id="basicSingle">
    <h2 class="small-title">Basic Single</h2>
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="w-100">
                        <label class="form-label">Breads</label>
                        <select id="select2Basic">
                            <option label="&nbsp;"></option>
                            <option value="Breadstick">Breadstick</option>
                            <option value="Biscotti">Biscotti</option>
                            <option value="Fougasse">Fougasse</option>
                            <option value="Lefse">Lefse</option>
                            <option value="Melonpan">Melonpan</option>
                            <option value="Naan">Naan</option>
                            <option value="Panbrioche">Panbrioche</option>
                            <option value="Rewena">Rewena</option>
                            <option value="Shirmal">Shirmal</option>
                            <option value="Tunnbröd">Tunnbröd</option>
                            <option value="Vánočka">Vánočka</option>
                            <option value="Zopf">Zopf</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
