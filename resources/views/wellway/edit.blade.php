@extends('layouts.wellway')

@section('content')
<style>
:root {
    --ui-bg: #ffffff;
    --ui-header-bg: #1a1d23;
    --ui-header-text: #ffffff;
    --ui-border: #e2e6ea;
    --ui-text: #1e2329;
    --ui-muted: #6b7280;
    --ui-accent: #4361ee;
    --ui-danger: #dc2626;
    --ui-soft: #f8f9fb;
    --radius-sm: 6px;
    --radius-md: 10px;
    --shadow-card: 0 2px 16px rgba(0, 0, 0, .07);
}

.eform-wrapper {
    background: var(--ui-bg);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.eform-topbar {
    background: var(--ui-header-bg);
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.eform-title {
    color: var(--ui-header-text);
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}

.eform-subtitle {
    color: rgba(255, 255, 255, .65);
    font-size: 12.5px;
    margin-top: 2px;
}

.eform-top-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.eform-top-badge {
    background: rgba(255, 255, 255, .12);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .16);
    border-radius: 999px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
}

.eform-infobar {
    background: var(--ui-soft);
    border-bottom: 1px solid var(--ui-border);
    padding: 10px 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px 16px;
    align-items: center;
}

.eform-info-chip {
    font-size: 12.5px;
    color: var(--ui-muted);
    background: #fff;
    border: 1px solid var(--ui-border);
    border-radius: 999px;
    padding: 6px 12px;
}

.eform-info-chip strong {
    color: var(--ui-text);
}

.eform-body {
    padding: 22px 20px 20px;
}

.eform-section {
    background: #fff;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    margin-bottom: 16px;
    overflow: hidden;
}

.eform-section-head {
    background: var(--ui-soft);
    border-bottom: 1px solid var(--ui-border);
    padding: 11px 16px;
    font-size: 13px;
    font-weight: 700;
    color: var(--ui-text);
    display: flex;
    align-items: center;
    gap: 8px;
}

.eform-section-body {
    padding: 16px;
}

.eform-label {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ui-text);
    margin-bottom: 7px;
    display: inline-block;
}

.eform-required {
    color: var(--ui-danger);
    margin-left: 3px;
}

.eform-control {
    border: 1px solid #d1d5db;
    border-radius: var(--radius-sm);
    min-height: 42px;
    padding: 10px 12px;
    font-size: 13.5px;
    color: var(--ui-text);
    background: #fff;
    transition: border-color .15s, box-shadow .15s;
}

.eform-control:focus {
    border-color: var(--ui-accent);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, .10);
    outline: none;
}

.eform-control::placeholder {
    color: #9ca3af;
}

.eform-hint {
    display: block;
    margin-top: 6px;
    font-size: 11.5px;
    color: var(--ui-muted);
}

.eform-field {
    margin-bottom: 16px;
}

.eform-error {
    margin-top: 6px;
    font-size: 12px;
    color: var(--ui-danger);
    font-weight: 600;
}

.eform-preview {
    background: linear-gradient(135deg, #f8faff 0%, #eef2ff 100%);
    border: 1px solid #dbe4ff;
    border-radius: var(--radius-md);
    padding: 14px 16px;
    height: 100%;
}

.eform-preview-title {
    font-size: 12px;
    font-weight: 700;
    color: var(--ui-muted);
    text-transform: uppercase;
    letter-spacing: .4px;
    margin-bottom: 10px;
}

.eform-preview-card {
    background: #fff;
    border: 1px solid #dbe4ff;
    border-radius: 12px;
    padding: 14px;
}

.eform-sku {
    display: inline-block;
    font-family: 'Consolas', 'Courier New', monospace;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 3px 8px;
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 10px;
}

.eform-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--ui-text);
    margin-bottom: 4px;
}

.eform-name-jp {
    font-size: 13px;
    color: var(--ui-muted);
    margin-bottom: 10px;
}

.eform-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.eform-pill {
    background: #fff;
    border: 1px solid var(--ui-border);
    border-radius: 999px;
    padding: 5px 10px;
    font-size: 12px;
    color: var(--ui-text);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.eform-color-dot {
    width: 11px;
    height: 11px;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, .12);
    display: inline-block;
}

.eform-check-card {
    background: var(--ui-soft);
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 42px;
}

.eform-check-card input[type="checkbox"] {
    width: 17px;
    height: 17px;
    accent-color: var(--ui-accent);
    margin-top: 0;
    cursor: pointer;
}

.eform-check-card label {
    margin: 0;
    font-size: 13px;
    font-weight: 600;
    color: var(--ui-text);
    cursor: pointer;
}

.eform-footer {
    border-top: 1px solid var(--ui-border);
    background: var(--ui-soft);
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.eform-footer-note {
    font-size: 12px;
    color: var(--ui-muted);
}

.eform-btn-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.eform-btn {
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: all .15s ease;
    cursor: pointer;
}

.eform-btn:hover {
    transform: translateY(-1px);
    opacity: .95;
}

.eform-btn-primary {
    background: var(--ui-header-bg);
    color: #fff;
    border-color: var(--ui-header-bg);
}

.eform-btn-primary:hover {
    background: #111318;
    color: #fff;
}

.eform-btn-secondary {
    background: #fff;
    color: var(--ui-text);
    border-color: #d1d5db;
}

.eform-btn-secondary:hover {
    background: #f9fafb;
    color: var(--ui-text);
}
</style>

<div class="box-panel">
    <div class="eform-wrapper">

        <div class="eform-topbar">
            <div>
                <h4 class="eform-title mb-0">Edit Wellway Product</h4>
                <div class="eform-subtitle">
                    Update product details with the same clean inventory UI
                </div>
            </div>

            <div class="eform-top-actions">
                <span class="eform-top-badge">Update Mode</span>
            </div>
        </div>

        <div class="eform-infobar">
            <span class="eform-info-chip"><strong>Module:</strong> Wellway Inventory</span>
            <span class="eform-info-chip"><strong>Form:</strong> Product Edit</span>
            <span class="eform-info-chip"><strong>Status:</strong>
                {{ old('is_active', $product->is_active) ? 'Active' : 'Inactive' }}</span>
        </div>

        <form action="{{ route('wellway.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="eform-body">
                <div class="row g-3">
                    <div class="col-lg-8">

                        <div class="eform-section">
                            <div class="eform-section-head">
                                📦 Product Information
                            </div>
                            <div class="eform-section-body">
                                <div class="row">
                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">SKU <span class="eform-required">*</span></label>
                                        <input type="text" name="sku" id="sku" class="form-control eform-control"
                                            value="{{ old('sku', $product->sku ?? '') }}"
                                            placeholder="Enter product SKU" required
                                            oninput="updateEditProductPreview()">
                                        <small class="eform-hint">Unique stock keeping unit code.</small>
                                        @error('sku')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">Product name in English <span
                                                class="eform-required">*</span></label>
                                        <input type="text" name="name_en" id="name_en"
                                            class="form-control eform-control"
                                            value="{{ old('name_en', $product->name_en ?? '') }}"
                                            placeholder="Enter English product name" required
                                            oninput="updateEditProductPreview()">
                                        <small class="eform-hint">Main product display name.</small>
                                        @error('name_en')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">Product name in Japanese</label>
                                        <input type="text" name="name_jp" id="name_jp"
                                            class="form-control eform-control"
                                            value="{{ old('name_jp', $product->name_jp ?? '') }}"
                                            placeholder="Enter Japanese product name"
                                            oninput="updateEditProductPreview()">
                                        <small class="eform-hint">Optional localized name.</small>
                                        @error('name_jp')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">Color</label>
                                        <input type="text" name="color" id="color" class="form-control eform-control"
                                            value="{{ old('color', $product->color ?? '') }}"
                                            placeholder="Example: Black, Silver, White"
                                            oninput="updateEditProductPreview()">
                                        <small class="eform-hint">Use simple CSS-friendly names for preview.</small>
                                        @error('color')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eform-section">
                            <div class="eform-section-head">
                                💰 Pricing & Status
                            </div>
                            <div class="eform-section-body">
                                <div class="row">
                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Buy Price</label>
                                        <input type="number" step="0.01" name="buy_price" id="buy_price"
                                            class="form-control eform-control"
                                            value="{{ old('buy_price', $product->buy_price ?? '') }}" placeholder="0.00"
                                            oninput="updateEditProductPreview()">
                                        @error('buy_price')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label d-block">Product Status</label>
                                        <div class="eform-check-card">
                                            <input type="checkbox" name="is_active" class="form-check-input"
                                                id="is_active"
                                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                                onchange="updateEditProductPreview()">
                                            <label for="is_active">Active</label>
                                        </div>
                                        <small class="eform-hint">Uncheck to mark product inactive.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="eform-preview">
                            <div class="eform-preview-title">Live Preview</div>

                            <div class="eform-preview-card">
                                <div class="eform-sku" id="preview-sku">
                                    {{ old('sku', $product->sku ?? 'SKU-000') ?: 'SKU-000' }}
                                </div>

                                <div class="eform-name" id="preview-name-en">
                                    {{ old('name_en', $product->name_en ?? 'Product Name') ?: 'Product Name' }}
                                </div>

                                <div class="eform-name-jp" id="preview-name-jp">
                                    {{ old('name_jp', $product->name_jp ?? 'Japanese Name') ?: 'Japanese Name' }}
                                </div>

                                <div class="eform-meta">
                                    <span class="eform-pill">
                                        <span class="eform-color-dot" id="preview-color-dot"
                                            style="background: {{ strtolower(old('color', $product->color ?? '#d1d5db')) }};"></span>
                                        <span
                                            id="preview-color">{{ old('color', $product->color ?? 'No color') ?: 'No color' }}</span>
                                    </span>

                                    <span class="eform-pill">
                                        Buy: <strong
                                            id="preview-buy">{{ old('buy_price', $product->buy_price ?? '0.00') ?: '0.00' }}</strong>
                                    </span>

                                    <span class="eform-pill">
                                        Status: <strong
                                            id="preview-status">{{ old('is_active', $product->is_active) ? 'Active' : 'Inactive' }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="eform-footer">
                <div class="eform-footer-note">
                    Please review product information before updating.
                </div>

                <div class="eform-btn-group">
                    <a href="{{ route('wellway.index') }}" class="eform-btn eform-btn-secondary">
                        ↩ Cancel
                    </a>
                    <button type="submit" class="eform-btn eform-btn-primary">
                        💾 Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function updateEditProductPreview() {
    const sku = document.getElementById('sku')?.value || 'SKU-000';
    const nameEn = document.getElementById('name_en')?.value || 'Product Name';
    const nameJp = document.getElementById('name_jp')?.value || 'Japanese Name';
    const color = document.getElementById('color')?.value || 'No color';
    const buy = document.getElementById('buy_price')?.value || '0.00';
    const isActive = document.getElementById('is_active')?.checked ? 'Active' : 'Inactive';

    document.getElementById('preview-sku').textContent = sku;
    document.getElementById('preview-name-en').textContent = nameEn;
    document.getElementById('preview-name-jp').textContent = nameJp;
    document.getElementById('preview-color').textContent = color;
    document.getElementById('preview-buy').textContent = buy;
    document.getElementById('preview-status').textContent = isActive;

    const colorDot = document.getElementById('preview-color-dot');
    if (colorDot) {
        colorDot.style.background = color;
    }
}
</script>
@endsection