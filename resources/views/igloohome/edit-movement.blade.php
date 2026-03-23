@extends('layouts.igloohome')

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
    --ui-soft-2: #f1f3f5;
    --ui-success: #16a34a;
    --ui-warning: #d97706;
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

.movement-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 999px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
}

.movement-type-badge.in {
    background: #dcfce7;
    color: #15803d;
}

.movement-type-badge.out {
    background: #ffedd5;
    color: #b45309;
}

.movement-type-badge.in::before,
.movement-type-badge.out::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.movement-type-badge.in::before {
    background: #16a34a;
}

.movement-type-badge.out::before {
    background: #d97706;
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

.status-preview {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 20px;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 700;
    text-transform: capitalize;
}

.status-preview.initialized {
    background: #e0f2fe;
    color: #0369a1;
}

.status-preview.processing {
    background: #fef3c7;
    color: #b45309;
}

.status-preview.packed {
    background: #ede9fe;
    color: #6d28d9;
}

.status-preview.shipped {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-preview.delivered {
    background: #dcfce7;
    color: #15803d;
}

.status-preview.completed {
    background: #dcfce7;
    color: #166534;
}

.status-preview.cancelled {
    background: #fee2e2;
    color: #b91c1c;
}

.status-preview.returned {
    background: #fef2f2;
    color: #991b1b;
}

.eform-highlight-box {
    margin-top: 12px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
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
    font-size: 16px;
    font-weight: 800;
    color: #111827;
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
                <h4 class="eform-title mb-0">Edit Stock Movement</h4>
                <div class="eform-subtitle">
                    Update shipment, tracking, status, and movement details
                </div>
            </div>

            <div class="eform-top-actions">
                <span class="eform-top-badge">Movement Edit</span>
            </div>
        </div>

        <div class="eform-infobar">
            <span class="eform-info-chip"><strong>Product:</strong> {{ $movement->product->name_en ?? '-' }}</span>
            <span class="eform-info-chip"><strong>Type:</strong> {{ strtoupper($movement->type ?? '-') }}</span>
            <span class="eform-info-chip"><strong>Qty:</strong> {{ $movement->qty ?? 0 }}</span>
            <span class="eform-info-chip"><strong>Current Status:</strong> {{ $movement->status ?? '-' }}</span>
        </div>

        <form action="{{ route('igloohome.movements.update', $movement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="eform-body">
                <div class="row g-3">
                    <div class="col-lg-8">

                        <div class="eform-section">
                            <div class="eform-section-head">
                                📦 Movement Details
                            </div>
                            <div class="eform-section-body">
                                <div class="row">
                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Order ID</label>
                                        <input type="text" name="order_id" id="order_id"
                                            class="form-control eform-control"
                                            value="{{ old('order_id', $movement->order_id) }}"
                                            placeholder="Enter order ID" oninput="updateMovementPreview()">
                                        @error('order_id')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Movement Date</label>
                                        <input type="date" name="movement_date" id="movement_date"
                                            class="form-control eform-control"
                                            value="{{ old('movement_date', $movement->movement_date) }}"
                                            oninput="updateMovementPreview()">
                                        @error('movement_date')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Requested By</label>
                                        <input type="text" name="requested_by" id="requested_by"
                                            class="form-control eform-control"
                                            value="{{ old('requested_by', $movement->requested_by) }}"
                                            placeholder="Requested by" oninput="updateMovementPreview()">
                                        @error('requested_by')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped By</label>
                                        <input type="text" name="shipped_by" id="shipped_by"
                                            class="form-control eform-control"
                                            value="{{ old('shipped_by', $movement->shipped_by) }}"
                                            placeholder="Shipped by" oninput="updateMovementPreview()">
                                        @error('shipped_by')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped To</label>
                                        <input type="text" name="shipped_to" id="shipped_to"
                                            class="form-control eform-control"
                                            value="{{ old('shipped_to', $movement->shipped_to) }}"
                                            placeholder="Destination" oninput="updateMovementPreview()">
                                        @error('shipped_to')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Shipped On</label>
                                        <input type="date" name="shipped_on" id="shipped_on"
                                            class="form-control eform-control"
                                            value="{{ old('shipped_on', $movement->shipped_on) }}"
                                            oninput="updateMovementPreview()">
                                        @error('shipped_on')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Status</label>
                                        <select name="status" id="status" class="form-select eform-select"
                                            onchange="updateMovementPreview()">
                                            <option value="initialized"
                                                {{ old('status', $movement->status) == 'initialized' ? 'selected' : '' }}>
                                                Initialized</option>
                                            <option value="processing"
                                                {{ old('status', $movement->status) == 'processing' ? 'selected' : '' }}>
                                                Processing</option>
                                            <option value="packed"
                                                {{ old('status', $movement->status) == 'packed' ? 'selected' : '' }}>
                                                Packed</option>
                                            <option value="shipped"
                                                {{ old('status', $movement->status) == 'shipped' ? 'selected' : '' }}>
                                                Shipped</option>
                                            <option value="delivered"
                                                {{ old('status', $movement->status) == 'delivered' ? 'selected' : '' }}>
                                                Delivered</option>
                                            <option value="completed"
                                                {{ old('status', $movement->status) == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled"
                                                {{ old('status', $movement->status) == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                            <option value="returned"
                                                {{ old('status', $movement->status) == 'returned' ? 'selected' : '' }}>
                                                Returned</option>
                                        </select>
                                        @error('status')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Tracking Number</label>
                                        <input type="text" name="tracking_number" id="tracking_number"
                                            class="form-control eform-control"
                                            value="{{ old('tracking_number', $movement->tracking_number) }}"
                                            placeholder="Tracking number" oninput="updateMovementPreview()">
                                        @error('tracking_number')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Carrier</label>
                                        <input type="text" name="carrier" id="carrier"
                                            class="form-control eform-control"
                                            value="{{ old('carrier', $movement->carrier) }}" placeholder="Carrier"
                                            oninput="updateMovementPreview()">
                                        @error('carrier')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 eform-field">
                                        <label class="eform-label">Reference Document</label>
                                        <input type="text" name="reference_document" id="reference_document"
                                            class="form-control eform-control"
                                            value="{{ old('reference_document', $movement->reference_document) }}"
                                            placeholder="Reference document" oninput="updateMovementPreview()">
                                        @error('reference_document')
                                        <div class="eform-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 eform-field">
                                        <label class="eform-label">Remark</label>
                                        <textarea name="note" id="note" class="form-control eform-textarea" rows="3"
                                            placeholder="Add notes or remarks..."
                                            oninput="updateMovementPreview()">{{ old('note', $movement->note) }}</textarea>
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
                                <div class="movement-type-badge {{ ($movement->type ?? '') === 'in' ? 'in' : 'out' }}">
                                    {{ strtoupper($movement->type ?? 'movement') }}
                                </div>

                                <div class="eform-name">{{ $movement->product->name_en ?? 'Product' }}</div>

                                <div class="eform-meta">
                                    <span class="eform-pill">
                                        Order: <strong
                                            id="preview-order-id">{{ old('order_id', $movement->order_id) ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Qty: <strong>{{ $movement->qty ?? 0 }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Date: <strong
                                            id="preview-date">{{ old('movement_date', $movement->movement_date) ?: '-' }}</strong>
                                    </span>
                                </div>

                                <div class="eform-highlight-box">
                                    <div class="eform-highlight-label">Status Preview</div>
                                    <div>
                                        <span
                                            class="status-preview {{ strtolower(old('status', $movement->status ?? 'initialized')) }}"
                                            id="preview-status-class">
                                            <span
                                                id="preview-status">{{ old('status', $movement->status) ?: 'initialized' }}</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="eform-meta mt-3">
                                    <span class="eform-pill">
                                        To: <strong
                                            id="preview-shipped-to">{{ old('shipped_to', $movement->shipped_to) ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Carrier: <strong
                                            id="preview-carrier">{{ old('carrier', $movement->carrier) ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Tracking: <strong
                                            id="preview-tracking">{{ old('tracking_number', $movement->tracking_number) ?: '-' }}</strong>
                                    </span>
                                </div>

                                <div class="eform-meta mt-3">
                                    <span class="eform-pill">
                                        Requested: <strong
                                            id="preview-requested-by">{{ old('requested_by', $movement->requested_by) ?: '-' }}</strong>
                                    </span>
                                    <span class="eform-pill">
                                        Shipped By: <strong
                                            id="preview-shipped-by">{{ old('shipped_by', $movement->shipped_by) ?: '-' }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="eform-footer">
                <div class="eform-footer-note">
                    Review the shipment and tracking details before updating this movement.
                </div>

                <div class="eform-btn-group">
                    <a href="{{ route('igloohome.allMovements') }}" class="eform-btn eform-btn-secondary">
                        ↩ Cancel
                    </a>
                    <button type="submit" class="eform-btn eform-btn-primary">
                        💾 Update Movement
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function updateMovementPreview() {
    const orderId = document.getElementById('order_id')?.value || '-';
    const movementDate = document.getElementById('movement_date')?.value || '-';
    const requestedBy = document.getElementById('requested_by')?.value || '-';
    const shippedBy = document.getElementById('shipped_by')?.value || '-';
    const shippedTo = document.getElementById('shipped_to')?.value || '-';
    const status = document.getElementById('status')?.value || 'initialized';
    const tracking = document.getElementById('tracking_number')?.value || '-';
    const carrier = document.getElementById('carrier')?.value || '-';

    document.getElementById('preview-order-id').textContent = orderId;
    document.getElementById('preview-date').textContent = movementDate;
    document.getElementById('preview-requested-by').textContent = requestedBy;
    document.getElementById('preview-shipped-by').textContent = shippedBy;
    document.getElementById('preview-shipped-to').textContent = shippedTo;
    document.getElementById('preview-carrier').textContent = carrier;
    document.getElementById('preview-tracking').textContent = tracking;
    document.getElementById('preview-status').textContent = status;

    const statusClassEl = document.getElementById('preview-status-class');
    statusClassEl.className = 'status-preview ' + status;
}
</script>
@endsection