@extends('layouts.igloohome')

@section('content')

{{-- ==================== ENHANCED TABLE SECTION ==================== --}}
<style>
/* ── Variables ── */
:root {
    --tbl-bg: #ffffff;
    --tbl-header-bg: #1a1d23;
    --tbl-header-text: #ffffff;
    --tbl-row-odd: #ffffff;
    --tbl-row-even: #f7f8fa;
    --tbl-row-hover: #eef2ff;
    --tbl-border: #e2e6ea;
    --tbl-text: #1e2329;
    --tbl-muted: #6b7280;
    --tbl-accent: #4361ee;
    --badge-success: #16a34a;
    --badge-danger: #dc2626;
    --badge-warning: #d97706;
    --badge-info: #0284c7;
    --radius-sm: 6px;
    --radius-md: 10px;
    --shadow-card: 0 2px 16px rgba(0, 0, 0, .07);
}

/* ── Wrapper ── */
.etbl-wrapper {
    background: var(--tbl-bg);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ── Top bar ── */
.etbl-topbar {
    background: var(--tbl-header-bg);
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.etbl-title {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
}

.etbl-title span.etbl-count {
    background: rgba(255, 255, 255, .15);
    border-radius: 20px;
    padding: 1px 9px;
    font-size: 12px;
    font-weight: 500;
    margin-left: 8px;
}

.etbl-topbar-right {
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

/* Search */
.etbl-search-wrap {
    position: relative;
}

.etbl-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    pointer-events: none;
}

.etbl-search {
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .2);
    border-radius: var(--radius-sm);
    color: #fff;
    padding: 7px 12px 7px 34px;
    font-size: 13px;
    width: 220px;
    outline: none;
    transition: background .2s, border .2s;
}

.etbl-search::placeholder {
    color: rgba(255, 255, 255, .5);
}

.etbl-search:focus {
    background: rgba(255, 255, 255, .2);
    border-color: rgba(255, 255, 255, .4);
}


/* Reset btn */
.etbl-btn-reset {
    background: #ef4444;
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    padding: 7px 14px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}

.etbl-btn-reset:hover {
    background: #dc2626;
}

/* Icon btn */
.etbl-btn-icon {
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .2);
    color: #fff;
    border-radius: var(--radius-sm);
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background .2s;
}

.etbl-btn-icon:hover {
    background: rgba(255, 255, 255, .22);
}

/* ── Filter bar ── */
.etbl-filterbar {
    background: #f1f3f5;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    border-bottom: 1px solid var(--tbl-border);
}

.etbl-filter-chip {
    background: #fff;
    border: 1px solid #d1d5db;
    border-radius: 20px;
    padding: 5px 13px;
    font-size: 12.5px;
    font-weight: 500;
    color: var(--tbl-text);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    user-select: none;
    transition: border-color .15s, background .15s;
}

.etbl-filter-chip:hover {
    border-color: var(--tbl-accent);
    color: var(--tbl-accent);
}

.etbl-filter-chip.active {
    background: var(--tbl-accent);
    border-color: var(--tbl-accent);
    color: #fff;
}

.etbl-filter-chip svg {
    width: 13px;
    height: 13px;
}

/* ── Column header sort controls ── */
.etbl-col-controls {
    padding: 8px 18px;
    background: #f8f9fb;
    border-bottom: 1px solid var(--tbl-border);
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.etbl-col-controls label {
    font-size: 12px;
    color: var(--tbl-muted);
    font-weight: 500;
    margin-right: 4px;
}

.etbl-col-sort-btn {
    background: #fff;
    border: 1px solid #d1d5db;
    border-radius: var(--radius-sm);
    padding: 4px 11px;
    font-size: 12px;
    cursor: pointer;
    color: var(--tbl-text);
    transition: border-color .15s, background .15s;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.etbl-col-sort-btn:hover,
.etbl-col-sort-btn.active {
    border-color: var(--tbl-accent);
    background: #eef2ff;
    color: var(--tbl-accent);
}

.etbl-col-sort-btn svg {
    width: 12px;
    height: 12px;
}

/* ── Results info bar ── */
.etbl-infobar {
    padding: 8px 18px;
    background: #fff;
    border-bottom: 1px solid var(--tbl-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
}

.etbl-infobar-left {
    font-size: 12.5px;
    color: var(--tbl-muted);
}

.etbl-infobar-left strong {
    color: var(--tbl-text);
}

.etbl-per-page {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    color: var(--tbl-muted);
}

.etbl-per-page select {
    border: 1px solid #d1d5db;
    border-radius: var(--radius-sm);
    padding: 3px 8px;
    font-size: 12.5px;
    color: var(--tbl-text);
    background: #fff;
    outline: none;
}

/* ── Table ── */
.etbl-scroll {
    overflow-x: auto;
}

.etbl-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}

.etbl-table thead tr {
    background: var(--tbl-header-bg);
}

.etbl-table thead th {
    color: #c9cdd6;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 13px 14px;
    white-space: nowrap;
    border: none;
    user-select: none;
    cursor: pointer;
}

.etbl-table thead th:first-child {
    width: 42px;
    text-align: center;
    cursor: default;
}

.etbl-table thead th .th-inner {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.etbl-table thead th .sort-arrows {
    display: inline-flex;
    flex-direction: column;
    gap: 1px;
    opacity: .5;
}

.etbl-table thead th .sort-arrows svg {
    width: 8px;
    height: 8px;
}

.etbl-table thead th.sort-asc .sort-arrows,
.etbl-table thead th.sort-desc .sort-arrows {
    opacity: 1;
    color: #a5b4fc;
}

.etbl-table tbody tr {
    border-bottom: 1px solid var(--tbl-border);
    transition: background .12s;
}

.etbl-table tbody tr:nth-child(even) td {
    background: var(--tbl-row-even);
}

.etbl-table tbody tr:hover td {
    background: var(--tbl-row-hover);
}

.etbl-table tbody td {
    padding: 12px 14px;
    color: var(--tbl-text);
    vertical-align: middle;
    white-space: nowrap;
}

.etbl-table tbody td:first-child {
    text-align: center;
}

/* Checkbox */
.etbl-checkbox {
    width: 16px;
    height: 16px;
    accent-color: var(--tbl-accent);
    cursor: pointer;
}

/* SKU badge */
.sku-badge {
    font-family: 'Consolas', 'Courier New', monospace;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 12px;
    color: #334155;
    font-weight: 600;
}

/* Stock badge */
.stock-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 20px;
    padding: 3px 11px;
    font-size: 12px;
    font-weight: 700;
}

.stock-pill.low {
    background: #fee2e2;
    color: var(--badge-danger);
}

.stock-pill.ok {
    background: #dcfce7;
    color: var(--badge-success);
}

.stock-pill.low::before,
.stock-pill.ok::before {
    content: '';
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
}

.stock-pill.low::before {
    background: var(--badge-danger);
}

.stock-pill.ok::before {
    background: var(--badge-success);
}

/* Action buttons */
.etbl-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.etbl-act-btn {
    border-radius: var(--radius-sm);
    padding: 4px 11px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid transparent;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: opacity .15s, transform .1s;
}

.etbl-act-btn:hover {
    opacity: .85;
    transform: translateY(-1px);
}

.etbl-act-btn.edit {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1d4ed8;
}

.etbl-act-btn.stockin {
    background: #f0fdf4;
    border-color: #86efac;
    color: #15803d;
}

.etbl-act-btn.stockout {
    background: #fffbeb;
    border-color: #fcd34d;
    color: #b45309;
}

.etbl-act-btn.history {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #475569;
}

.etbl-act-btn.delete {
    background: #fff1f2;
    border-color: #fca5a5;
    color: #b91c1c;
}

/* No results row */
.etbl-empty {
    text-align: center;
    padding: 48px 0;
    color: var(--tbl-muted);
}

.etbl-empty svg {
    opacity: .35;
    margin-bottom: 10px;
}

.etbl-empty p {
    margin: 0;
    font-size: 14px;
}

/* ── Bottom bar ── */
.etbl-bottombar {
    padding: 12px 18px;
    background: #f8f9fb;
    border-top: 1px solid var(--tbl-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.etbl-bottombar .page-info {
    font-size: 12.5px;
    color: var(--tbl-muted);
}

/* Highlight on search match */
mark.etbl-hl {
    background: #fef08a;
    color: inherit;
    border-radius: 2px;
    padding: 0 1px;
}

/* Color dot */
.color-dot {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.color-dot span {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, .1);
    display: inline-block;
    flex-shrink: 0;
}
</style>

<div class="table-box">
    <div class="etbl-wrapper" id="etbl-main">

        {{-- ── TOP BAR ── --}}
        <div class="etbl-topbar">
            <div class="etbl-title">
                Igloohome Products
                <span class="etbl-count" id="etbl-total-count">{{ $products->total() }} total</span>
            </div>
            <div class="etbl-topbar-right">

                {{--Export--}}
                <a href="{{ route('igloohome.products.export.excel', request()->query()) }}"
                    class="dash-hdr-btn primary">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2"
                        viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Export Excel
                </a>

                {{-- Search --}}
                <div class="etbl-search-wrap">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input class="etbl-search" id="etbl-search" type="text" placeholder="Search product…"
                        oninput="etblSearch(this.value)">
                </div>

                {{-- Refresh --}}
                <button class="etbl-btn-icon" onclick="window.location.reload()" title="Refresh">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="23 4 23 10 17 10" />
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ── FILTER CHIPS ── --}}
        <div class="etbl-filterbar" id="etbl-filterbar">
            <span style="font-size:12px;color:#6b7280;font-weight:600;margin-right:2px;">Filter:</span>

            <button class="etbl-filter-chip active" data-filter="all" onclick="etblFilter(this,'all')">
                All
            </button>
            <button class="etbl-filter-chip" data-filter="low" onclick="etblFilter(this,'low')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path
                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                </svg>
                Low Stock
            </button>
            <button class="etbl-filter-chip" data-filter="ok" onclick="etblFilter(this,'ok')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                In Stock
            </button>

            <button class="etbl-btn-reset ms-auto" onclick="etblReset()">Reset All</button>
        </div>

        {{-- ── SORT QUICK-CONTROLS ── --}}
        <div class="etbl-col-controls">
            <label>Sort by:</label>
            <button class="etbl-col-sort-btn active" id="sort-sku" onclick="etblSort('sku',this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                SKU
            </button>
            <button class="etbl-col-sort-btn" id="sort-name_en" onclick="etblSort('name_en',this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Name (EN)
            </button>
            <button class="etbl-col-sort-btn" id="sort-color" onclick="etblSort('color',this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Color
            </button>
            <button class="etbl-col-sort-btn" id="sort-stock" onclick="etblSort('stock',this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Stock
            </button>
        </div>

        {{-- ── INFO BAR ── --}}
        <div class="etbl-infobar">
            <div class="etbl-infobar-left">
                Showing <strong id="etbl-showing">{{ $products->count() }}</strong>
                of <strong>{{ $products->total() }}</strong> products
                <span id="etbl-filter-label"></span>
            </div>
            <div class="etbl-per-page">
                <span>Rows per page:</span>
                <select onchange="window.location.href='?per_page='+this.value">
                    @foreach([10, 25, 50, 100] as $pp)
                    <option value="{{ $pp }}" {{ request('per_page', 10) == $pp ? 'selected' : '' }}>{{ $pp }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ── TABLE ── --}}
        <div class="etbl-scroll">
            <table class="etbl-table" id="etbl-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="etbl-checkbox" id="etbl-select-all"
                                onclick="toggleSelectAll(this)" title="Select all">
                        </th>
                        <th onclick="etblSortTh('sku')" class="sort-asc" id="th-sku">
                            <span class="th-inner">
                                SKU
                                <span class="sort-arrows">
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 6l5-6 5 6z" fill="currentColor" />
                                    </svg>
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 0l5 6 5-6z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th onclick="etblSortTh('name_en')" id="th-name_en">
                            <span class="th-inner">
                                English Name
                                <span class="sort-arrows">
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 6l5-6 5 6z" fill="currentColor" />
                                    </svg>
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 0l5 6 5-6z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th onclick="etblSortTh('name_jp')" id="th-name_jp">
                            <span class="th-inner">
                                Japanese Name
                                <span class="sort-arrows">
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 6l5-6 5 6z" fill="currentColor" />
                                    </svg>
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 0l5 6 5-6z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th onclick="etblSortTh('color')" id="th-color">
                            <span class="th-inner">
                                Color
                                <span class="sort-arrows">
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 6l5-6 5 6z" fill="currentColor" />
                                    </svg>
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 0l5 6 5-6z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th onclick="etblSortTh('stock')" id="th-stock">
                            <span class="th-inner">
                                Stock
                                <span class="sort-arrows">
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 6l5-6 5 6z" fill="currentColor" />
                                    </svg>
                                    <svg viewBox="0 0 10 6">
                                        <path d="M0 0l5 6 5-6z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="etbl-tbody">
                    @forelse($products as $product)
                    <tr data-sku="{{ strtolower($product->sku) }}" data-name_en="{{ strtolower($product->name_en) }}"
                        data-name_jp="{{ strtolower($product->name_jp) }}"
                        data-color="{{ strtolower($product->color) }}" data-stock="{{ $product->stock }}"
                        data-stock-status="{{ $product->stock <= 5 ? 'low' : 'ok' }}">
                        <td>
                            <input type="checkbox" class="etbl-checkbox etbl-row-check" value="{{ $product->id }}">
                        </td>
                        <td><span class="sku-badge">{{ $product->sku }}</span></td>
                        <td>{{ $product->name_en }}</td>
                        <td>{{ $product->name_jp }}</td>
                        <td>
                            <div class="color-dot">
                                <span style="background:{{ strtolower($product->color) }};"></span>
                                {{ $product->color }}
                            </div>
                        </td>
                        <td>
                            @if($product->stock <= 5) <span class="stock-pill low">{{ $product->current_stock }}</span>
                                @else
                                <span class="stock-pill ok">{{ $product->current_stock }}</span>
                                @endif
                        </td>
                        <td>
                            <div class="etbl-actions">
                                <a href="{{ route('igloohome.edit', $product->id) }}" class="etbl-act-btn edit">
                                    ✏️ Edit
                                </a>
                                <a href="{{ route('igloohome.stockin.form', $product->id) }}"
                                    class="etbl-act-btn stockin">
                                    ↑ In
                                </a>
                                <a href="{{ route('igloohome.stockout.form', $product->id) }}"
                                    class="etbl-act-btn stockout">
                                    ↓ Out
                                </a>
                                <a href="{{ route('igloohome.movements', $product->id) }}" class="etbl-act-btn history">
                                    🕓 History
                                </a>
                                <form action="{{ route('igloohome.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this product?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="etbl-act-btn delete">🗑 Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="etbl-empty-row">
                        <td colspan="7">
                            <div class="etbl-empty">
                                <svg width="48" height="48" fill="none" stroke="#6b7280" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <path d="M3 9h18M9 21V9" />
                                </svg>
                                <p>No products found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- JS no-results row (hidden by default) --}}
                    <tr id="etbl-no-results" style="display:none;">
                        <td colspan="7">
                            <div class="etbl-empty">
                                <svg width="48" height="48" fill="none" stroke="#6b7280" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.35-4.35" />
                                </svg>
                                <p>No products match your search.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- ── BOTTOM / PAGINATION ── --}}
        <div class="etbl-bottombar">
            <div class="page-info">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                &nbsp;·&nbsp;
                <span id="etbl-selected-info">0 selected</span>
            </div>
            <div>
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>

    </div>{{-- /etbl-wrapper --}}
</div>

{{-- ==================== TABLE JS ==================== --}}
<script>
(function() {
    /* ── State ── */
    let currentSort = {
        col: 'sku',
        dir: 'asc'
    };
    let currentFilter = 'all';
    let currentSearch = '';

    /* ── Helpers ── */
    function rows() {
        return Array.from(document.querySelectorAll('#etbl-tbody tr[data-sku]'));
    }

    function applyVisibility() {
        const q = currentSearch.trim().toLowerCase();
        const fl = currentFilter;
        let visible = 0;

        rows().forEach(tr => {
            const sku = tr.dataset.sku || '';
            const nameEn = tr.dataset.name_en || '';
            const nameJp = tr.dataset.name_jp || '';
            const color = tr.dataset.color || '';
            const status = tr.dataset.stockStatus || tr.dataset['stock-status'] || '';

            const matchSearch = !q ||
                sku.includes(q) || nameEn.includes(q) ||
                nameJp.includes(q) || color.includes(q);

            const matchFilter = fl === 'all' || status === fl;

            const show = matchSearch && matchFilter;
            tr.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('etbl-showing').textContent = visible;
        document.getElementById('etbl-no-results').style.display = visible === 0 ? '' : 'none';
    }

    /* ── Search ── */
    window.etblSearch = function(val) {
        currentSearch = val;
        applyVisibility();
    };

    /* ── Filter chips ── */
    window.etblFilter = function(btn, filter) {
        document.querySelectorAll('#etbl-filterbar .etbl-filter-chip').forEach(b => b.classList.remove(
            'active'));
        btn.classList.add('active');
        currentFilter = filter;
        document.getElementById('etbl-filter-label').textContent =
            filter === 'all' ? '' : `— filtered by: ${filter === 'low' ? 'Low Stock' : 'In Stock'}`;
        applyVisibility();
    };

    /* ── Reset ── */
    window.etblReset = function() {
        currentSearch = '';
        currentFilter = 'all';
        document.getElementById('etbl-search').value = '';
        document.querySelectorAll('#etbl-filterbar .etbl-filter-chip').forEach((b, i) => {
            b.classList.toggle('active', i === 0);
        });
        document.getElementById('etbl-filter-label').textContent = '';
        applyVisibility();
    };

    /* ── Sort (client-side, visible rows only) ── */
    function sortRows(col, dir) {
        const tbody = document.getElementById('etbl-tbody');
        const visible = rows().filter(r => r.style.display !== 'none');

        visible.sort((a, b) => {
            let va = a.dataset[col] || '';
            let vb = b.dataset[col] || '';
            if (col === 'stock') {
                va = parseInt(va) || 0;
                vb = parseInt(vb) || 0;
            }
            if (va < vb) return dir === 'asc' ? -1 : 1;
            if (va > vb) return dir === 'asc' ? 1 : -1;
            return 0;
        });

        visible.forEach(r => tbody.appendChild(r));
    }

    window.etblSort = function(col, btn) {
        const allBtns = document.querySelectorAll('.etbl-col-sort-btn');
        allBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        if (currentSort.col === col) {
            currentSort.dir = currentSort.dir === 'asc' ? 'desc' : 'asc';
        } else {
            currentSort = {
                col,
                dir: 'asc'
            };
        }
        sortRows(currentSort.col, currentSort.dir);
        updateThClasses();
    };

    window.etblSortTh = function(col) {
        if (currentSort.col === col) {
            currentSort.dir = currentSort.dir === 'asc' ? 'desc' : 'asc';
        } else {
            currentSort = {
                col,
                dir: 'asc'
            };
        }
        sortRows(currentSort.col, currentSort.dir);
        updateThClasses();

        /* sync quick-sort buttons */
        document.querySelectorAll('.etbl-col-sort-btn').forEach(b => b.classList.remove('active'));
        const syncBtn = document.getElementById('sort-' + col);
        if (syncBtn) syncBtn.classList.add('active');
    };

    function updateThClasses() {
        ['sku', 'name_en', 'name_jp', 'color', 'stock'].forEach(c => {
            const th = document.getElementById('th-' + c);
            if (!th) return;
            th.classList.remove('sort-asc', 'sort-desc');
            if (c === currentSort.col) th.classList.add('sort-' + currentSort.dir);
        });
    }

    /* ── Select all ── */
    window.toggleSelectAll = function(cb) {
        document.querySelectorAll('.etbl-row-check').forEach(c => {
            const tr = c.closest('tr');
            if (tr && tr.style.display !== 'none') c.checked = cb.checked;
        });

    };
    /* ── Init sort indicators ── */
    updateThClasses();
})();
</script>
{{-- ==================== END TABLE SECTION ==================== --}}
@endsection