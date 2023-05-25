

    <div class="col-7 add_more{{ $count }}">
        <div class="fv-row mb-5 fv-plugins-icon-container">
            <select class="form-control form-control-solid mb-3 mb-lg-0" name="product_name">
                <option label="&nbsp;"></option>
               @foreach ($products as $product)
               <option value="{{ $product->id }}">{{ $product->productname }}</option>
               @endforeach
            </select>
            <div class="fv-plugins-message-container invalid-feedback"></div>
            @error('product_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-5 add_more{{ $count }}">
        <div class="fv-row mb-5 fv-plugins-icon-container ">
            <div class="d-flex">
                <input type="text" name="quantity" class="form-control form-control-solid mb-3 mb-lg-0 me-2">
                <i class="bi bi-trash mt-2" onclick="removeClubField({{ $count }})"></i>
            </div>
            <div class="fv-plugins-message-container invalid-feedback"></div>
            @error('sale_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

