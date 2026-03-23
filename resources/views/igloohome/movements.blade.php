@extends('layouts.igloohome')

@section('content')

{{-- ==================== ENHANCED TABLE SECTION ==================== --}}
<style>
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

.etbl-wrapper {
    background: var(--tbl-bg);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

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
    width: 240px;
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

.etbl-scroll {
    overflow-x: auto;
}

.etbl-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    min-width: 1450px;
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

.etbl-table thead th.no-sort {
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

.etbl-checkbox {
    width: 16px;
    height: 16px;
    accent-color: var(--tbl-accent);
    cursor: pointer;
}

.movement-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 12px;
    font-weight: 700;
}

.movement-badge.in {
    background: #dcfce7;
    color: #15803d;
}

.movement-badge.out {
    background: #fee2e2;
    color: #b91c1c;
}

.movement-badge.in::before,
.movement-badge.out::before {
    content: '';
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
}

.movement-badge.in::before {
    background: #16a34a;
}

.movement-badge.out::before {
    background: #dc2626;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 12px;
    font-weight: 700;
    text-transform: capitalize;
}

.status-pill.initialized {
    background: #e0f2fe;
    color: #0369a1;
}

.status-pill.processing {
    background: #fef3c7;
    color: #b45309;
}

.status-pill.packed {
    background: #ede9fe;
    color: #6d28d9;
}

.status-pill.shipped {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-pill.delivered {
    background: #dcfce7;
    color: #15803d;
}

.status-pill.completed {
    background: #dcfce7;
    color: #166534;
}

.status-pill.cancelled {
    background: #fee2e2;
    color: #b91c1c;
}

.status-pill.returned {
    background: #fef2f2;
    color: #991b1b;
}

.qty-badge {
    font-family: 'Consolas', 'Courier New', monospace;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 12px;
    color: #334155;
    font-weight: 700;
}

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
</style>

<div class="table-box">
    <div class="etbl-wrapper" id="htbl-main">

        {{-- ── TOP BAR ── --}}
        <div class="etbl-topbar">
            <div class="etbl-title">
                Stock History - {{ $product->name_en }}
                <span class="etbl-count" id="htbl-total-count">{{ $movements->total() }} total</span>
            </div>

            <div class="etbl-topbar-right">
                <div class="etbl-search-wrap">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input class="etbl-search" id="htbl-search" type="text" placeholder="Search history..."
                        oninput="htblSearch(this.value)">
                </div>

                <button class="etbl-btn-icon" onclick="window.location.reload()" title="Refresh">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="23 4 23 10 17 10" />
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ── FILTER BAR ── --}}
        <div class="etbl-filterbar" id="htbl-filterbar">
            <span style="font-size:12px;color:#6b7280;font-weight:600;margin-right:2px;">Filter:</span>

            <button class="etbl-filter-chip active" onclick="htblFilter(this, 'all')">All</button>

            <button class="etbl-filter-chip" onclick="htblFilter(this, 'in')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M12 19V5"></path>
                    <path d="m5 12 7-7 7 7"></path>
                </svg>
                IN
            </button>

            <button class="etbl-filter-chip" onclick="htblFilter(this, 'out')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M12 5v14"></path>
                    <path d="m19 12-7 7-7-7"></path>
                </svg>
                OUT
            </button>

            <button class="etbl-filter-chip" onclick="htblFilter(this, 'completed')">Completed</button>
            <button class="etbl-filter-chip" onclick="htblFilter(this, 'processing')">Processing</button>
            <button class="etbl-filter-chip" onclick="htblFilter(this, 'cancelled')">Cancelled</button>

            <button class="etbl-btn-reset ms-auto" onclick="htblReset()">Reset All</button>
        </div>

        {{-- ── QUICK SORT ── --}}
        <div class="etbl-col-controls">
            <label>Sort by:</label>

            <button class="etbl-col-sort-btn active" id="sort-movement_date" onclick="htblSort('movement_date', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Date
            </button>

            <button class="etbl-col-sort-btn" id="sort-order_id" onclick="htblSort('order_id', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Order ID
            </button>

            <button class="etbl-col-sort-btn" id="sort-type" onclick="htblSort('type', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Type
            </button>

            <button class="etbl-col-sort-btn" id="sort-qty" onclick="htblSort('qty', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Qty
            </button>

            <button class="etbl-col-sort-btn" id="sort-status" onclick="htblSort('status', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
                Status
            </button>
        </div>

        {{-- ── INFO BAR ── --}}
        <div class="etbl-infobar">
            <div class="etbl-infobar-left">
                Showing <strong id="htbl-showing">{{ $movements->count() }}</strong>
                of <strong>{{ $movements->total() }}</strong> history records
                <span id="htbl-filter-label"></span>
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
            <table class="etbl-table" id="htbl-table">
                <thead>
                    <tr>
                        <th class="no-sort">
                            <input type="checkbox" class="etbl-checkbox" id="htbl-select-all"
                                onclick="toggleHistorySelectAll(this)" title="Select all">
                        </th>

                        <th onclick="htblSortTh('order_id')" id="th-order_id">
                            <span class="th-inner">
                                Order ID
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

                        <th onclick="htblSortTh('movement_date')" id="th-movement_date" class="sort-asc">
                            <span class="th-inner">
                                Date
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

                        <th onclick="htblSortTh('type')" id="th-type">
                            <span class="th-inner">
                                Type
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

                        <th onclick="htblSortTh('qty')" id="th-qty">
                            <span class="th-inner">
                                Qty
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

                        <th onclick="htblSortTh('stock_before')" id="th-stock_before">
                            <span class="th-inner">
                                Before
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

                        <th onclick="htblSortTh('stock_after')" id="th-stock_after">
                            <span class="th-inner">
                                After
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

                        <th onclick="htblSortTh('status')" id="th-status">
                            <span class="th-inner">
                                Status
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

                        <th onclick="htblSortTh('requested_by')" id="th-requested_by">
                            <span class="th-inner">
                                Requested By
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

                        <th onclick="htblSortTh('shipped_by')" id="th-shipped_by">
                            <span class="th-inner">
                                Shipped By
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

                        <th onclick="htblSortTh('shipped_to')" id="th-shipped_to">
                            <span class="th-inner">
                                Shipped To
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

                        <th onclick="htblSortTh('shipped_on')" id="th-shipped_on">
                            <span class="th-inner">
                                Shipped On
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

                        <th onclick="htblSortTh('done_by')" id="th-done_by">
                            <span class="th-inner">
                                Done By
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

                        <th onclick="htblSortTh('note')" id="th-note">
                            <span class="th-inner">
                                Remark
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
                    </tr>
                </thead>

                <tbody id="htbl-tbody">
                    @forelse($movements as $movement)
                    <tr data-order_id="{{ strtolower($movement->order_id ?? '-') }}"
                        data-movement_date="{{ $movement->movement_date ?? '' }}"
                        data-type="{{ strtolower($movement->type ?? '-') }}" data-qty="{{ $movement->qty ?? 0 }}"
                        data-stock_before="{{ $movement->stock_before ?? 0 }}"
                        data-stock_after="{{ $movement->stock_after ?? 0 }}"
                        data-status="{{ strtolower($movement->status ?? '-') }}"
                        data-requested_by="{{ strtolower($movement->requested_by ?? '-') }}"
                        data-shipped_by="{{ strtolower($movement->shipped_by ?? '-') }}"
                        data-shipped_to="{{ strtolower($movement->shipped_to ?? '-') }}"
                        data-shipped_on="{{ strtolower($movement->shipped_on ?? '-') }}"
                        data-done_by="{{ strtolower($movement->user->name ?? 'n/a') }}"
                        data-note="{{ strtolower($movement->note ?? '-') }}">
                        <td>
                            <input type="checkbox" class="etbl-checkbox htbl-row-check" value="{{ $movement->id }}">
                        </td>

                        <td>{{ $movement->order_id ?? '-' }}</td>
                        <td>{{ $movement->movement_date ?? '-' }}</td>

                        <td>
                            @if($movement->type === 'in')
                            <span class="movement-badge in">IN</span>
                            @else
                            <span class="movement-badge out">OUT</span>
                            @endif
                        </td>

                        <td><span class="qty-badge">{{ $movement->qty }}</span></td>
                        <td>{{ $movement->stock_before ?? '-' }}</td>
                        <td>{{ $movement->stock_after ?? '-' }}</td>

                        <td>
                            <span class="status-pill {{ strtolower($movement->status ?? 'initialized') }}">
                                {{ $movement->status ?? '-' }}
                            </span>
                        </td>

                        <td>{{ $movement->requested_by ?? '-' }}</td>
                        <td>{{ $movement->shipped_by ?? '-' }}</td>
                        <td>{{ $movement->shipped_to ?? '-' }}</td>
                        <td>{{ $movement->shipped_on ?? '-' }}</td>
                        <td>{{ $movement->user->name ?? 'N/A' }}</td>
                        <td>{{ $movement->note ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr id="htbl-empty-row">
                        <td colspan="14">
                            <div class="etbl-empty">
                                <svg width="48" height="48" fill="none" stroke="#6b7280" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <path d="M3 9h18M9 21V9" />
                                </svg>
                                <p>No stock history found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="htbl-no-results" style="display:none;">
                        <td colspan="14">
                            <div class="etbl-empty">
                                <svg width="48" height="48" fill="none" stroke="#6b7280" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.35-4.35" />
                                </svg>
                                <p>No history records match your search.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- ── BOTTOM / PAGINATION ── --}}
        <div class="etbl-bottombar">
            <div class="page-info">
                Page {{ $movements->currentPage() }} of {{ $movements->lastPage() }}
                &nbsp;·&nbsp;
            </div>
            <div>
                {{ $movements->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
</div>

{{-- ==================== TABLE JS ==================== --}}
<script>
(function() {
    let currentSort = {
        col: 'movement_date',
        dir: 'asc'
    };
    let currentFilter = 'all';
    let currentSearch = '';

    function rows() {
        return Array.from(document.querySelectorAll('#htbl-tbody tr[data-order_id]'));
    }

    function applyVisibility() {
        const q = currentSearch.trim().toLowerCase();
        const fl = currentFilter;
        let visible = 0;

        rows().forEach(tr => {
            const orderId = tr.dataset.order_id || '';
            const movementDate = tr.dataset.movement_date || '';
            const type = tr.dataset.type || '';
            const qty = tr.dataset.qty || '';
            const stockBefore = tr.dataset.stock_before || '';
            const stockAfter = tr.dataset.stock_after || '';
            const status = tr.dataset.status || '';
            const requestedBy = tr.dataset.requested_by || '';
            const shippedBy = tr.dataset.shipped_by || '';
            const shippedTo = tr.dataset.shipped_to || '';
            const shippedOn = tr.dataset.shipped_on || '';
            const doneBy = tr.dataset.done_by || '';
            const note = tr.dataset.note || '';

            const matchSearch = !q ||
                orderId.includes(q) ||
                movementDate.includes(q) ||
                type.includes(q) ||
                qty.toString().includes(q) ||
                stockBefore.toString().includes(q) ||
                stockAfter.toString().includes(q) ||
                status.includes(q) ||
                requestedBy.includes(q) ||
                shippedBy.includes(q) ||
                shippedTo.includes(q) ||
                shippedOn.includes(q) ||
                doneBy.includes(q) ||
                note.includes(q);

            const matchFilter =
                fl === 'all' ||
                type === fl ||
                status === fl;

            const show = matchSearch && matchFilter;
            tr.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('htbl-showing').textContent = visible;
        document.getElementById('htbl-no-results').style.display = visible === 0 ? '' : 'none';
    }

    window.htblSearch = function(val) {
        currentSearch = val;
        applyVisibility();
    };

    window.htblFilter = function(btn, filter) {
        document.querySelectorAll('#htbl-filterbar .etbl-filter-chip').forEach(b => b.classList.remove(
            'active'));
        btn.classList.add('active');
        currentFilter = filter;

        let label = '';
        if (filter !== 'all') {
            label = `— filtered by: ${filter.charAt(0).toUpperCase() + filter.slice(1)}`;
        }
        document.getElementById('htbl-filter-label').textContent = label;

        applyVisibility();
    };

    window.htblReset = function() {
        currentSearch = '';
        currentFilter = 'all';
        document.getElementById('htbl-search').value = '';
        document.querySelectorAll('#htbl-filterbar .etbl-filter-chip').forEach((b, i) => {
            b.classList.toggle('active', i === 0);
        });
        document.getElementById('htbl-filter-label').textContent = '';
        applyVisibility();
    };

    function sortRows(col, dir) {
        const tbody = document.getElementById('htbl-tbody');
        const visible = rows().filter(r => r.style.display !== 'none');

        visible.sort((a, b) => {
            let va = a.dataset[col] || '';
            let vb = b.dataset[col] || '';

            if (['qty', 'stock_before', 'stock_after'].includes(col)) {
                va = parseInt(va) || 0;
                vb = parseInt(vb) || 0;
            }

            if (va < vb) return dir === 'asc' ? -1 : 1;
            if (va > vb) return dir === 'asc' ? 1 : -1;
            return 0;
        });

        visible.forEach(r => tbody.appendChild(r));
    }

    window.htblSort = function(col, btn) {
        document.querySelectorAll('.etbl-col-sort-btn').forEach(b => b.classList.remove('active'));
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

    window.htblSortTh = function(col) {
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

        document.querySelectorAll('.etbl-col-sort-btn').forEach(b => b.classList.remove('active'));
        const syncBtn = document.getElementById('sort-' + col);
        if (syncBtn) syncBtn.classList.add('active');
    };

    function updateThClasses() {
        ['order_id', 'movement_date', 'type', 'qty', 'stock_before', 'stock_after', 'status', 'requested_by',
            'shipped_by', 'shipped_to', 'shipped_on', 'done_by', 'note'
        ].forEach(c => {
            const th = document.getElementById('th-' + c);
            if (!th) return;
            th.classList.remove('sort-asc', 'sort-desc');
            if (c === currentSort.col) th.classList.add('sort-' + currentSort.dir);
        });
    }

    window.toggleHistorySelectAll = function(cb) {
        document.querySelectorAll('.htbl-row-check').forEach(c => {
            const tr = c.closest('tr');
            if (tr && tr.style.display !== 'none') c.checked = cb.checked;
        });
    };

    updateThClasses();
})();
</script>
{{-- ==================== END TABLE SECTION ==================== --}}
@endsection