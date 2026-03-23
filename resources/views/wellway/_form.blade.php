<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Product name in English</label>
        <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $product->name_en ?? '') }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Product name in Japanese</label>
        <input type="text" name="name_jp" class="form-control" value="{{ old('name_jp', $product->name_jp ?? '') }}">
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label">Color</label>
        <input type="text" name="color" class="form-control" value="{{ old('color', $product->color ?? '') }}">
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label">Hinge</label>
        <input type="text" name="hinge" class="form-control" value="{{ old('hinge', $product->hinge ?? '') }}">
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label">Buy Price</label>
        <input type="number" step="0.01" name="buy_price" class="form-control"
            value="{{ old('buy_price', $product->buy_price ?? '') }}">
    </div>

    @if(!isset($product))
    <div class="col-md-3 mb-3">
        <label class="form-label">Opening Stock</label>
        <input type="number" name="opening_stock" class="form-control" value="{{ old('opening_stock', 0) }}" min="0">
    </div>
    @endif

    @if(isset($product))
    <div class="col-md-3 mb-3 form-check mt-4 ms-3">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
            {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
        <label for="is_active" class="form-check-label">Active</label>
    </div>
    @endif
</div>