@extends('layouts.igloohome')

@section('content')

{{-- ==================== SUMMARY DASHBOARD SECTION ==================== --}}
<style>
/* ── Summary Panel ── */
.dash-panel {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0, 0, 0, .07);
    overflow: hidden;
    margin-bottom: 22px;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* Panel Header */
.dash-panel-header {
    background: #1a1d23;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.dash-panel-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.dash-panel-title {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    margin: 0;
}

.dash-panel-subtitle {
    color: rgba(255, 255, 255, .45);
    font-size: 12px;
    margin: 0;
}

.dash-panel-header-right {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

/* Header action buttons */
.dash-hdr-btn {
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    transition: opacity .15s, transform .1s;
}

.dash-hdr-btn:hover {
    opacity: .85;
    transform: translateY(-1px);
}

.dash-hdr-btn.primary {
    background: #4361ee;
    color: #fff;
}

.dash-hdr-btn.success {
    background: #16a34a;
    color: #fff;
}

.dash-hdr-btn.warning {
    background: #d97706;
    color: #fff;
}

.dash-hdr-btn.secondary {
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .2);
    color: #fff;
}

.dash-hdr-btn.secondary:hover {
    background: rgba(255, 255, 255, .2);
}

/* KPI Cards Row */
.dash-kpi-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 0;
    border-bottom: 1px solid #e2e6ea;
}

.dash-kpi-card {
    padding: 18px 20px;
    border-right: 1px solid #e2e6ea;
    position: relative;
    transition: background .12s;
}

.dash-kpi-card:last-child {
    border-right: none;
}

.dash-kpi-card:hover {
    background: #f7f8fa;
}

/* Accent bar on top of each KPI card */
.dash-kpi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    border-radius: 0;
}

.dash-kpi-card.blue::before {
    background: #4361ee;
}

.dash-kpi-card.green::before {
    background: #16a34a;
}

.dash-kpi-card.red::before {
    background: #dc2626;
}

.dash-kpi-card.amber::before {
    background: #d97706;
}

.dash-kpi-card.teal::before {
    background: #0891b2;
}

.dash-kpi-card.purple::before {
    background: #7c3aed;
}

.dash-kpi-card.slate::before {
    background: #475569;
}

.dash-kpi-card.placeholder::before {
    background: #d1d5db;
}

.dash-kpi-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.dash-kpi-icon.blue {
    background: #eff6ff;
    color: #4361ee;
}

.dash-kpi-icon.green {
    background: #f0fdf4;
    color: #16a34a;
}

.dash-kpi-icon.red {
    background: #fff1f2;
    color: #dc2626;
}

.dash-kpi-icon.amber {
    background: #fffbeb;
    color: #d97706;
}

.dash-kpi-icon.teal {
    background: #ecfeff;
    color: #0891b2;
}

.dash-kpi-icon.purple {
    background: #f5f3ff;
    color: #7c3aed;
}

.dash-kpi-icon.slate {
    background: #f8fafc;
    color: #475569;
}

.dash-kpi-icon.placeholder {
    background: #f1f5f9;
    color: #94a3b8;
}

.dash-kpi-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #6b7280;
    margin-bottom: 4px;
}

.dash-kpi-value {
    font-size: 24px;
    font-weight: 700;
    color: #1e2329;
    line-height: 1.1;
}

.dash-kpi-value.placeholder-val {
    color: #cbd5e1;
    font-size: 20px;
    letter-spacing: 2px;
}

.dash-kpi-meta {
    font-size: 11.5px;
    color: #9ca3af;
    margin-top: 3px;
}

.dash-kpi-meta .up {
    color: #16a34a;
    font-weight: 600;
}

.dash-kpi-meta .down {
    color: #dc2626;
    font-weight: 600;
}

/* Info + Buttons Row */
.dash-info-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0;
    border-bottom: 1px solid #e2e6ea;
}

.dash-info-block {
    flex: 1 1 220px;
    padding: 16px 20px;
    border-right: 1px solid #e2e6ea;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.dash-info-block:last-child {
    border-right: none;
}

.dash-info-block-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #9ca3af;
    margin-bottom: 4px;
}

.dash-info-line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    color: #374151;
}

.dash-info-line span.label {
    color: #6b7280;
}

.dash-info-line span.val {
    font-weight: 600;
    color: #1e2329;
}

.dash-info-line span.placeholder-line {
    background: #f1f5f9;
    border-radius: 4px;
    width: 80px;
    height: 14px;
    display: inline-block;
}

/* Buttons block */
.dash-btn-block {
    flex: 1 1 260px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.dash-btn-block-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #9ca3af;
    margin-bottom: 2px;
}

.dash-btn-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.dash-action-btn {
    border-radius: 6px;
    padding: 7px 15px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    transition: opacity .15s, transform .1s, box-shadow .15s;
    white-space: nowrap;
}

.dash-action-btn:hover {
    opacity: .88;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, .10);
}

.dash-action-btn.solid-blue {
    background: #4361ee;
    color: #fff;
    border-color: #4361ee;
}

.dash-action-btn.solid-green {
    background: #16a34a;
    color: #fff;
    border-color: #16a34a;
}

.dash-action-btn.solid-amber {
    background: #d97706;
    color: #fff;
    border-color: #d97706;
}

.dash-action-btn.solid-red {
    background: #dc2626;
    color: #fff;
    border-color: #dc2626;
}

.dash-action-btn.solid-teal {
    background: #0891b2;
    color: #fff;
    border-color: #0891b2;
}

.dash-action-btn.outline-blue {
    background: #eff6ff;
    color: #4361ee;
    border-color: #93c5fd;
}

.dash-action-btn.outline-gray {
    background: #f8fafc;
    color: #475569;
    border-color: #cbd5e1;
}

.dash-action-btn.placeholder-btn {
    background: #f1f5f9;
    color: #94a3b8;
    border-color: #e2e8f0;
    cursor: default;
    font-style: italic;
}

.dash-action-btn.placeholder-btn:hover {
    transform: none;
    box-shadow: none;
    opacity: 1;
}

/* Status / Notice strip */
.dash-notice-strip {
    background: #f8f9fb;
    padding: 11px 20px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    border-bottom: 1px solid #e2e6ea;
}

.dash-notice-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    color: #374151;
}

.dash-notice-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.dash-notice-dot.green {
    background: #16a34a;
}

.dash-notice-dot.red {
    background: #dc2626;
}

.dash-notice-dot.amber {
    background: #d97706;
}

.dash-notice-dot.blue {
    background: #4361ee;
}

.dash-notice-dot.gray {
    background: #d1d5db;
}

.dash-notice-item strong {
    color: #1e2329;
}

.dash-notice-placeholder {
    color: #d1d5db;
    font-style: italic;
    font-size: 12px;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .dash-kpi-row {
        grid-template-columns: repeat(2, 1fr);
    }

    .dash-info-block,
    .dash-btn-block {
        border-right: none;
        border-bottom: 1px solid #e2e6ea;
    }
}
</style>

<div class="dash-panel">

    {{-- ── PANEL HEADER ── --}}
    <div class="dash-panel-header">
        <div class="dash-panel-header-left">
            <div>
                <p class="dash-panel-title">📦 Igloohome Inventory Dashboard</p>
                <p class="dash-panel-subtitle">Real-time product & stock overview</p>
            </div>
        </div>
        <div class="dash-panel-header-right">
            {{-- Replace href with your actual routes --}}
            <a href="{{ route('igloohome.create') }}" class="dash-hdr-btn success">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add Product
            </a>
            <a href="{{ route('igloohome.products.export.excel', request()->query()) }}" class="dash-hdr-btn primary">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    {{-- ── KPI CARDS ── --}}
    <div class="dash-kpi-row">

        {{-- Card 1: Total Products (real data) --}}
        <div class="dash-kpi-card blue">
            <div class="dash-kpi-icon blue">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="14" rx="2" />
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                </svg>
            </div>
            <div class="dash-kpi-label">Total Products</div>
            <div class="dash-kpi-value">{{ $summary['total_products'] }}</div>
            <div class="dash-kpi-meta">All SKUs registered</div>
        </div>

        {{-- Card 2: Total Stock (real data) --}}
        <div class="dash-kpi-card green">
            <div class="dash-kpi-icon green">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
            </div>
            <div class="dash-kpi-label">Total Stock</div>
            <div class="dash-kpi-value">{{ $summary['total_stock'] }}</div>
            <div class="dash-kpi-meta">Units across all SKUs</div>
        </div>

        {{-- Card 3: Low Stock (real data) --}}
        <div class="dash-kpi-card red">
            <div class="dash-kpi-icon red">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path
                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
            </div>
            <div class="dash-kpi-label">Low Stock</div>
            <div class="dash-kpi-value">{{ $summary['low_stock'] }}</div>
            <div class="dash-kpi-meta">Items needing restock</div>
        </div>

        {{-- Card 4: PLACEHOLDER — e.g. Total Cost / Value --}}
        <div class="dash-kpi-card amber">
            <div class="dash-kpi-icon amber">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <line x1="12" y1="1" x2="12" y2="23" />
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                </svg>
            </div>
            <div class="dash-kpi-label">Total Value</div>
            <div class="dash-kpi-value">¥ {{ number_format($summary['total_value'], 2) }}</div>
            <div class="dash-kpi-meta">Total value in Yen</div>
        </div>

        {{-- Card 5: PLACEHOLDER — e.g. Total Sales / Revenue --}}
        <div class="dash-kpi-card teal">
            <div class="dash-kpi-icon teal">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                    <polyline points="17 6 23 6 23 12" />
                </svg>
            </div>
            <div class="dash-kpi-label">Total Sales</div>
            {{-- Replace with: {{ $summary['total_sales'] }} --}}
            <div class="dash-kpi-value placeholder-val">—</div>
            <div class="dash-kpi-meta">Replace with real value</div>
        </div>

        {{-- Card 6: PLACEHOLDER — e.g. Out of Stock / Pending Orders --}}
        <div class="dash-kpi-card purple">
            <div class="dash-kpi-icon purple">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                </svg>
            </div>
            <div class="dash-kpi-label">Pending Orders</div>
            {{-- Replace with: {{ $summary['pending_orders'] }} --}}
            <div class="dash-kpi-value placeholder-val">—</div>
            <div class="dash-kpi-meta">Replace with real value</div>
        </div>



    </div>{{-- /dash-kpi-row --}}

    {{-- ── INFO + BUTTONS ROW ── --}}
    <div class="dash-info-row">

        {{-- Info Block 1: Inventory Details (real + placeholder) --}}
        <div class="dash-info-block">
            <div class="dash-info-block-title">Inventory Details</div>
            <div class="dash-info-line">
                <span class="label">Active SKUs</span>
                <span class="val">{{ $summary['total_products'] }}</span>
            </div>
            <div class="dash-info-line">
                <span class="label">Avg. Stock / SKU</span>
                <span class="val">
                    {{ $summary['total_products'] > 0 ? round($summary['total_stock'] / $summary['total_products'], 1) : 0 }}
                </span>
            </div>
            <div class="dash-info-line">
                <span class="label">Stock Health</span>
                <span class="val" style="color:#16a34a;">
                    {{ $summary['total_products'] > 0 ? round((($summary['total_products'] - $summary['low_stock']) / $summary['total_products']) * 100) : 0 }}%
                    OK
                </span>
            </div>
            {{-- Placeholder rows --}}
            <div class="dash-info-line">
                <span class="label" style="color:#d1d5db;">-------</span>
                <span class="placeholder-line"></span>
            </div>
        </div>

        {{-- Info Block 2: Low Stock List (all placeholder) --}}
        <div class="dash-info-block">
            <div class="dash-info-block-title">Low Stock Items</div>
            @forelse($products as $product)
            @if($product->stock <= 5) <div class="dash-info-line">
                <span class="label">{{ $product->name_en }}</span>
                <span class="val" style="color:#bf404c;">{{ $product->stock }}</span>
        </div>
        @endif
        @empty
        <p>None</p>
        @endforelse
    </div>

    {{-- Info Block 3: Recent Activity (placeholder) --}}
    <div class="dash-info-block">
        <div class="dash-info-block-title">----------</div>
        <div class="dash-info-line">
            <span class="label" style="color:#d1d5db;">-------</span>
            <span class="placeholder-line"></span>
        </div>
        <div class="dash-info-line">
            <span class="label" style="color:#d1d5db;">-------</span>
            <span class="placeholder-line"></span>
        </div>
        <div class="dash-info-line">
            <span class="label" style="color:#d1d5db;">-------</span>
            <span class="placeholder-line"></span>
        </div>
        <div class="dash-info-line">
            <span class="label" style="color:#d1d5db;">--------</span>
            <span class="placeholder-line"></span>
        </div>
        <div class="dash-info-line">
            <span class="label" style="color:#d1d5db;">-------</span>
            <span class="placeholder-line"></span>
        </div>
    </div>

    {{-- Buttons Block --}}
    <div class="dash-btn-block">
        <div class="dash-btn-block-title">Quick Actions</div>

        {{-- Real buttons (wire up routes) --}}
        <div class="dash-btn-row">
            <a href="{{ route('igloohome.create') }}" class="dash-action-btn solid-green">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                New Product
            </a>
            <a href="{{ route('igloohome.products.export.excel', request()->query()) }}" class="dash-hdr-btn primary">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Export Excel
            </a>
        </div>

        <div class="dash-btn-row">

            <a href="{{ route('igloohome.allMovements') }}" class="dash-action-btn solid-teal">
                {{-- Replace href with your movement history route --}}
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="12 8 12 12 14 14" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
                Movement Log
            </a>
            <a href="{{ route('igloohome.reports.monthly.pdf') }}" class="dash-action-btn solid-amber">
                {{-- Replace href with your low-stock report route --}}
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path
                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                </svg>
                ReportsMonthly PDF
            </a>
        </div>
    </div>

</div>{{-- /dash-info-row --}}

{{-- ── NOTICE / STATUS STRIP ── --}}
<div class="dash-notice-strip">
    <div class="dash-notice-item">
        <span class="dash-notice-dot green"></span>
        <span>System <strong>Online</strong></span>
    </div>
    <div class="dash-notice-item">
        <span class="dash-notice-dot red"></span>
        <span><strong>{{ $summary['low_stock'] }}</strong> items below threshold</span>
    </div>
    <div class="dash-notice-item">
        <span class="dash-notice-dot blue"></span>
        <span>Last synced: <strong>{{ now()->format('d M Y, H:i') }}</strong></span>
    </div>
    {{-- Placeholder notices — replace with real conditions --}}
    <div class="dash-notice-item">
        <span class="dash-notice-dot gray"></span>
        <span class="dash-notice-placeholder">＋ Add your status notice here</span>
    </div>
    <div class="dash-notice-item">
        <span class="dash-notice-dot gray"></span>
        <span class="dash-notice-placeholder">＋ Add your status notice here</span>
    </div>
</div>

</div>{{-- /dash-panel --}}
@endsection