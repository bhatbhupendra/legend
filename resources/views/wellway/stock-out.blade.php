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
    --ui-warning: #d97706;
    --ui-warning-dark: #b45309;
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

.eform-control,
.eform-select,
.eform-textarea {
    border: 1px solid #d1d5db;
    border-radius: var(--radius-sm);
    min-height: 42px;
    padding: 10px 12px;
    font-size: 13.5px;
    color: var(--ui-text);
    background: #fff;
    transition: border-color .15s, box-shadow .15s;
}

.eform-textarea {
    min-height: 100px;
    resize: vertical;
}

.eform-control:focus,
.eform-select:focus,
.eform-textarea:focus {
    border-color: var(--ui-accent);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, .10);
    outline: none;
}

.eform-control::placeholder,
.eform-textarea::placeholder {
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
    background: linear-gradient(135deg, #fffaf5 0%, #fff7ed 100%);
    border: 1px solid #f8dcc2;
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
    border: 1px solid #fde3c8;
    border-radius: 12px;
    padding: 14px;
}

.eform-stock-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ffedd5;
    color: var(--ui-warning-dark);
    border-radius: 999px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
}

.eform-stock-badge::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--ui-warning);
    display: inline-block;
}

.eform-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--ui-text);
    margin-bottom: 4px;
}

.eform-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
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

.eform-highlight-box {
    margin-top: 12px;
    background: #fff7ed;
    border: 1px dashed #fdba74;
    border-radius: 10px;
    padding: 10px 12px;
}

.eform-highlight-label {
    font-size: 11px;
    color: var(--ui-muted);
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: .4px;
    margin-bottom: 4px;
}

.eform-highlight-value {
    font-size: 18px;
    font-weight: 800;
    color: var(--ui-warning-dark);
}

.eform-stock-warning {
    margin-top: 10px;
    font-size: 12px;
    font-weight: 700;
    color: var(--ui-danger);
    display: none;
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

.eform-btn-warning {
    background: var(--ui-warning);
    color: #fff;
    border-color: var(--ui-warning);
}

.eform-btn-warning:hover {
    background: var(--ui-warning-dark);
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
                <h4 class="eform-title mb-0">Stock Out / Sell - {{ $product->name_en }}</h4>
                <div class="eform-subtitle">
                    Record outgoing stock, sales, or shipments with tracking details
                </div>
            </div>

            <div class="eform-top-actions">
                <span class="eform-top-badge">OUT Movement</span>
            </div>
        </div>

        <div class="eform-infobar">
            <span class="eform-info-chip"><strong>Product:</strong> {{ $product->name_en }}</span>
            <span class="eform-info-chip"><strong>SKU:</strong> {{ $product->sku ?? '-' }}</span>
            <span class="eform-info-chip"><strong>Current Stock:</strong> {{ $product->stock ?? 0 }}</span>
        </div>

        <form action="{{ route('wellway.stockout', $product->id) }}" method="POST">
            @csrf

            <div class="eform-body">
                <div class="row g-3">
                    <div class="col-lg-8">

                        <div class="eform-section">
                            <div class="eform-section-head">
                                📦 Movement Information
                            </div>
                            <div class="eform-section-body">
                                <div class="row">
                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Order ID</label>
                                        <input type="text" name="order_id" id="order_id"
                                            class="form-control eform-control" value="{{ old('order_id') }}"
                                            placeholder="Enter order ID" oninput="updateStockOutPreview()">
                                        @error('order_id')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Quantity Sold / Shipped <span
                                                class="eform-required">*</span></label>
                                        <input type="number" name="qty" id="qty" class="form-control eform-control"
                                            min="1" value="{{ old('qty') }}" required placeholder="0"
                                            oninput="updateStockOutPreview()">
                                        @error('qty')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Movement Date <span
                                                class="eform-required">*</span></label>
                                        <input type="date" name="movement_date" id="movement_date"
                                            class="form-control eform-control"
                                            value="{{ old('movement_date', date('Y-m-d')) }}" required
                                            oninput="updateStockOutPreview()">
                                        @error('movement_date')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Requested By</label>
                                        <input type="text" name="requested_by" id="requested_by"
                                            class="form-control eform-control" value="{{ old('requested_by') }}"
                                            placeholder="Requested by" oninput="updateStockOutPreview()">
                                        @error('requested_by')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped By</label>
                                        <input type="text" name="shipped_by" id="shipped_by"
                                            class="form-control eform-control" value="{{ old('shipped_by') }}"
                                            placeholder="Shipped by" oninput="updateStockOutPreview()">
                                        @error('shipped_by')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped To</label>
                                        <input type="text" name="shipped_to" id="shipped_to"
                                            class="form-control eform-control" value="{{ old('shipped_to') }}"
                                            placeholder="Destination" oninput="updateStockOutPreview()">
                                        @error('shipped_to')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped On</label>
                                        <input type="date" name="shipped_on" id="shipped_on"
                                            class="form-control eform-control" value="{{ old('shipped_on') }}"
                                            oninput="updateStockOutPreview()">
                                        @error('shipped_on')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Status</label>
                                        <select name="status" id="status" class="form-select eform-select"
                                            onchange="updateStockOutPreview()">
                                            <option value="">Select Status</option>
                                            <option value="initialized"
                                                {{ old('status') == 'initialized' ? 'selected' : '' }}>Initialized
                                            </option>
                                            <option value="processing"
                                                {{ old('status') == 'processing' ? 'selected' : '' }}>Processing
                                            </option>
                                            <option value="packed" {{ old('status') == 'packed' ? 'selected' : '' }}>
                                                Packed</option>
                                            <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>
                                                Shipped</option>
                                            <option value="delivered"
                                                {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="completed"
                                                {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled"
                                                {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="returned"
                                                {{ old('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                                        </select>
                                        @error('status')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Tracking Number</label>
                                        <input type="text" name="tracking_number" id="tracking_number"
                                            class="form-control eform-control" value="{{ old('tracking_number') }}"
                                            placeholder="Tracking number" oninput="updateStockOutPreview()">
                                        @error('tracking_number')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">Carrier</label>
                                        <input type="text" name="carrier" id="carrier"
                                            class="form-control eform-control" value="{{ old('carrier') }}"
                                            placeholder="Courier / carrier" oninput="updateStockOutPreview()">
                                        @error('carrier')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 eform-field">
                                        <label class="eform-label">Reference Document</label>
                                        <input type="text" name="reference_document" id="reference_document"
                                            class="form-control eform-control" value="{{ old('reference_document') }}"
                                            placeholder="Invoice / PO / Ref document" oninput="updateStockOutPreview()">
                                        @error('reference_document')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 eform-field">
                                        <label class="eform-label">Remark</label>
                                        <textarea name="note" id="note" class="form-control eform-textarea" rows="3"
                                            placeholder="Add notes or remarks..."
                                            oninput="updateStockOutPreview()">{{ old('note') }}</textarea>
                                        @error('note')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="eform-preview">
                            <div class="eform-preview-title">Live Preview</div>

                            <div class="eform-preview-card">
                                <div class="eform-stock-badge">Stock Out</div>

                                <div class="eform-name">{{ $product->name_en }}</div>

                                <div class="eform-meta">
                                    <span class="eform-pill">
                                        Order: <strong id="preview-order-id">{{ old('order_id') ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Qty: <strong id="preview-qty">{{ old('qty') ?: '0' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Date: <strong
                                            id="preview-date">{{ old('movement_date', date('Y-m-d')) }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Status: <strong id="preview-status">{{ old('status') ?: 'Not set' }}</strong>
                                    </span>
                                </div>

                                <div class="eform-highlight-box">
                                    <div class="eform-highlight-label">Estimated Stock After</div>
                                    <div class="eform-highlight-value" id="preview-stock-after">
                                        {{ max(0, (int)($product->stock ?? 0) - (int) old('qty', 0)) }}
                                    </div>
                                    <div class="eform-stock-warning" id="preview-stock-warning">
                                        Warning: quantity is greater than available stock.
                                    </div>
                                </div>

                                <div class="eform-meta mt-3">
                                    <span class="eform-pill">
                                        To: <strong id="preview-shipped-to">{{ old('shipped_to') ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Carrier: <strong id="preview-carrier">{{ old('carrier') ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Tracking: <strong
                                            id="preview-tracking">{{ old('tracking_number') ?: '-' }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="eform-footer">
                <div class="eform-footer-note">
                    Please verify shipment and quantity details before removing stock.
                </div>

                <div class="eform-btn-group">
                    <a href="{{ route('wellway.index') }}" class="eform-btn eform-btn-secondary">
                        ↩ Cancel
                    </a>
                    <button type="submit" class="eform-btn eform-btn-warning">
                        ➖ Remove Stock
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function updateStockOutPreview() {
    const currentStock = {
        {
            (int)($product - > stock ?? 0)
        }
    };
    const orderId = document.getElementById('order_id')?.value || '-';
    const qtyRaw = document.getElementById('qty')?.value || 0;
    const qty = parseInt(qtyRaw) || 0;
    const movementDate = document.getElementById('movement_date')?.value || '-';
    const status = document.getElementById('status')?.value || 'Not set';
    const shippedTo = document.getElementById('shipped_to')?.value || '-';
    const carrier = document.getElementById('carrier')?.value || '-';
    const tracking = document.getElementById('tracking_number')?.value || '-';

    const estimated = currentStock - qty;
    const warningEl = document.getElementById('preview-stock-warning');

    document.getElementById('preview-order-id').textContent = orderId;
    document.getElementById('preview-qty').textContent = qty || 0;
    document.getElementById('preview-date').textContent = movementDate;
    document.getElementById('preview-status').textContent = status;
    document.getElementById('preview-shipped-to').textContent = shippedTo;
    document.getElementById('preview-carrier').textContent = carrier;
    document.getElementById('preview-tracking').textContent = tracking;
    document.getElementById('preview-stock-after').textContent = estimated < 0 ? estimated : estimated;

    if (qty > currentStock) {
        warningEl.style.display = 'block';
    } else {
        warningEl.style.display = 'none';
    }
}
</script>
@endsection