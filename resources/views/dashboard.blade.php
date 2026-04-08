@extends('layouts.app')

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     IGLOOHOME-STYLE INVENTORY DASHBOARD
══════════════════════════════════════════════════════════════ --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

:root {
    --bg-main: #f3f4f6;
    --bg-card: #ffffff;
    --bg-card2: #f8fafc;
    --bg-hover: #f1f5f9;

    --border: #dbe1e8;
    --border-light: #e5eaf0;

    --text-primary: #1f2937;
    --text-muted: #6b7280;
    --text-dim: #94a3b8;

    --accent-green: #198754;
    --accent-blue: #0d6efd;
    --accent-orange: #fd7e14;
    --accent-cyan: #0dcaf0;
    --accent-yellow: #ffc107;
    --accent-purple: #6f42c1;
    --accent-red: #dc3545;

    --table-head-bg: #1f2937;
    --table-head-text: #ffffff;
    --sidebar-btn-bg: #ffffff;
    --sidebar-btn-border: #3b82f6;
}

* {
    box-sizing: border-box;
}

.igh-wrap {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg-main);
    color: var(--text-primary);
    min-height: 100vh;
    padding-bottom: 40px;
    margin: -1.5rem;
}

/* ── Header ── */
.igh-header {
    background: var(--bg-card);
    border-bottom: 1px solid var(--border);
    padding: 16px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
}

.igh-header-left h2 {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-primary);
}

.igh-header-left p {
    font-size: .78rem;
    color: var(--text-muted);
    margin: 2px 0 0;
}

.igh-header-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* ── Buttons ── */
.igh-btn {
    font-family: 'DM Sans', sans-serif;
    font-size: .8rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 7px 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: .18s ease;
    text-decoration: none;
}

.igh-btn:hover {
    transform: translateY(-1px);
}

.igh-btn-green {
    background: var(--accent-green);
    color: #fff;
}

.igh-btn-blue {
    background: var(--accent-blue);
    color: #fff;
}

.igh-btn-orange {
    background: var(--accent-orange);
    color: #fff;
}

.igh-btn-cyan {
    background: var(--accent-cyan);
    color: #fff;
}

.igh-btn-ghost {
    background: #fff;
    color: var(--text-primary);
    border: 1px solid var(--border);
}

.igh-btn-ghost:hover {
    background: #f8fafc;
}

.igh-btn-sm {
    font-size: .73rem;
    padding: 5px 11px;
}

.igh-btn-dashed {
    background: #fff;
    border: 1.5px dashed #cbd5e1;
    color: var(--text-muted);
    font-size: .75rem;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: .15s ease;
    font-family: 'DM Sans', sans-serif;
    width: 100%;
    display: block;
    text-align: center;
}

.igh-btn-dashed:hover {
    border-color: var(--accent-blue);
    color: var(--accent-blue);
    background: #eff6ff;
}

/* ── KPI Strip ── */
.color-bar {
    height: 3px;
    width: 100%;
    border-radius: 3px 3px 0 0;
}

.cb-blue { background: var(--accent-blue); }
.cb-green { background: var(--accent-green); }
.cb-red { background: var(--accent-red); }
.cb-yellow { background: var(--accent-yellow); }
.cb-cyan { background: var(--accent-cyan); }
.cb-purple { background: var(--accent-purple); }
.cb-gray { background: var(--text-dim); }

.igh-kpi-strip {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    border-bottom: 1px solid var(--border);
}

@media(max-width:1100px) {
    .igh-kpi-strip {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media(max-width:700px) {
    .igh-kpi-strip {
        grid-template-columns: repeat(2, 1fr);
    }
}

.kpi-card {
    background: var(--bg-card);
    border-right: 1px solid var(--border);
    padding: 20px 18px 18px;
    transition: .15s ease;
}

.kpi-card:hover {
    background: var(--bg-hover);
}

.kpi-card:last-child {
    border-right: none;
}

.kpi-card .kpi-label {
    font-size: .63rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin: 10px 0 6px;
}

.kpi-card .kpi-value {
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1;
    margin: 0 0 5px;
    color: var(--text-primary);
}

.kpi-card .kpi-sub {
    font-size: .72rem;
    color: var(--text-muted);
}

.kpi-card .kpi-icon {
    font-size: 1.1rem;
    opacity: .75;
}

.kpi-placeholder {
    background: #f8fafc;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.kpi-placeholder .kph-label {
    font-size: .7rem;
    color: var(--text-dim);
    font-weight: 700;
    letter-spacing: .06em;
    margin-top: auto;
    padding-top: 16px;
}

.kpi-placeholder .kph-bar {
    width: 28px;
    height: 2px;
    background: #dbe1e8;
    margin: 6px 0;
}

.kpi-placeholder .kph-link {
    font-size: .72rem;
    color: var(--accent-blue);
    text-decoration: none;
    opacity: .8;
}

/* ── Body ── */
.igh-body {
    padding: 22px 28px;
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.igh-mid-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 260px;
    gap: 14px;
}

@media(max-width:1200px) {
    .igh-mid-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media(max-width:700px) {
    .igh-mid-grid {
        grid-template-columns: 1fr;
    }
}

.igh-panel {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
}

.igh-panel-header {
    padding: 11px 16px;
    border-bottom: 1px solid var(--border);
    font-size: .63rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-muted);
    background: #fff;
}

.igh-panel-body {
    padding: 12px 16px;
}

.detail-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 7px 0;
    border-bottom: 1px solid var(--border-light);
    font-size: .82rem;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row .dr-label {
    color: var(--text-muted);
}

.detail-row .dr-value {
    font-weight: 600;
    font-family: 'DM Mono', monospace;
    font-size: .8rem;
    color: var(--text-primary);
}

.detail-row .dr-value.ok {
    color: var(--accent-green);
}

.detail-row .dr-ph {
    width: 90px;
    height: 9px;
    background: #e5e7eb;
    border-radius: 4px;
}

/* Quick actions */
.qa-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

/* ── Product + Notes side-by-side ── */
.prd-notes-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 14px;
    align-items: start;
}

@media(max-width:1100px) {
    .prd-notes-grid {
        grid-template-columns: 1fr;
    }
}

/* ── Bottom row ── */
.bottom-row-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 14px;
    align-items: start;
}

@media(max-width:900px) {
    .bottom-row-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media(max-width:600px) {
    .bottom-row-grid {
        grid-template-columns: 1fr;
    }
}

/* ── Product table ── */
.igh-product-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
}

.prd-header {
    padding: 13px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    background: #fff;
}

.prd-header h6 {
    font-size: .65rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin: 0;
}

.igh-search {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 7px;
    color: var(--text-primary);
    font-size: .8rem;
    padding: 6px 12px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    width: 180px;
    transition: border-color .15s, box-shadow .15s;
}

.igh-search:focus {
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.igh-search::placeholder {
    color: var(--text-dim);
}

.prd-scroll {
    max-height: 520px;
    overflow-y: auto;
    background: #fff;
}

.prd-scroll::-webkit-scrollbar {
    width: 6px;
}

.prd-scroll::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.igh-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .82rem;
}

.igh-table thead tr {
    border-bottom: 1px solid var(--border);
    background: var(--table-head-bg);
}

.igh-table thead th {
    padding: 11px 14px;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--table-head-text);
    text-align: left;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
}

.igh-table thead th:last-child {
    border-right: none;
}

.igh-table thead th.c {
    text-align: center;
}

.igh-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: background .12s;
    background: #fff;
}

.igh-table tbody tr:hover {
    background: var(--bg-hover);
}

.igh-table tbody tr:last-child {
    border-bottom: none;
}

.igh-table td {
    padding: 9px 14px;
    color: var(--text-primary);
    border-right: 1px solid var(--border-light);
}

.igh-table td:last-child {
    border-right: none;
}

.igh-table td.c {
    text-align: center;
}

.igh-table td.mono {
    font-family: 'DM Mono', monospace;
    font-size: .75rem;
    color: var(--text-muted);
}

.badge-in {
    background: rgba(25, 135, 84, .12);
    color: var(--accent-green);
    border-radius: 20px;
    padding: 2px 9px;
    font-size: .67rem;
    font-weight: 600;
}

.badge-low {
    background: rgba(255, 193, 7, .15);
    color: #9a6700;
    border-radius: 20px;
    padding: 2px 9px;
    font-size: .67rem;
    font-weight: 600;
}

.badge-out {
    background: rgba(220, 53, 69, .12);
    color: var(--accent-red);
    border-radius: 20px;
    padding: 2px 9px;
    font-size: .67rem;
    font-weight: 600;
}

.go-btn {
    background: var(--accent-green);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: .7rem;
    font-weight: 700;
    padding: 7px 13px;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    letter-spacing: .04em;
    transition: .12s ease;
    text-decoration: none;
    display: inline-block;
    white-space: nowrap;
}

.go-btn:hover {
    background: #157347;
    transform: translateY(-1px);
    color: #fff;
}

.prd-footer {
    padding: 10px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: .75rem;
    color: var(--text-muted);
    background: #fff;
}

/* ── Right Sidebar ── */
.dash-sidebar {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

/* Sidebar panel base */
.sb-panel-hdr {
    padding: 11px 16px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
}

.sb-panel-hdr .sb-title {
    font-size: .63rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 6px;
}

.sb-panel-hdr .sb-badge {
    font-size: .65rem;
    font-weight: 700;
    padding: 1px 7px;
    border-radius: 20px;
}

.sb-panel-hdr .sb-link {
    font-size: .7rem;
    color: var(--accent-blue);
    text-decoration: none;
    opacity: .8;
}

.sb-panel-hdr .sb-link:hover {
    opacity: 1;
}

.sb-body {
    padding: 14px 16px;
    background: #fff;
}

/* Reminders */
.reminder-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 9px 0;
    border-bottom: 1px solid var(--border-light);
}

.reminder-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.ri-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 5px;
}

.ri-dot-red {
    background: var(--accent-red);
}

.ri-dot-yellow {
    background: var(--accent-yellow);
}

.ri-dot-blue {
    background: var(--accent-blue);
}

.ri-dot-gray {
    background: var(--text-dim);
}

.ri-title {
    font-size: .8rem;
    font-weight: 500;
    line-height: 1.3;
    color: var(--text-primary);
}

.ri-due {
    font-size: .68rem;
    color: var(--text-muted);
    margin-top: 2px;
}

/* Notes */
.note-chip {
    border-radius: 8px;
    padding: 9px 11px;
    margin-bottom: 8px;
    border-left: 3px solid;
}

.note-chip:last-of-type {
    margin-bottom: 0;
}

.note-chip.nc-yellow {
    background: rgba(255, 193, 7, .10);
    border-color: var(--accent-yellow);
}

.note-chip.nc-blue {
    background: rgba(13, 110, 253, .08);
    border-color: var(--accent-blue);
}

.note-chip.nc-green {
    background: rgba(25, 135, 84, .08);
    border-color: var(--accent-green);
}

.note-chip .nc-text {
    font-size: .78rem;
    line-height: 1.45;
    color: var(--text-primary);
}

.note-chip .nc-date {
    font-size: .66rem;
    color: var(--text-muted);
    margin-top: 4px;
}

.note-input {
    width: 100%;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 7px;
    color: var(--text-primary);
    font-size: .78rem;
    padding: 8px 10px;
    font-family: 'DM Sans', sans-serif;
    resize: none;
    outline: none;
    margin-top: 10px;
    transition: border-color .15s, box-shadow .15s;
}

.note-input:focus {
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.note-input::placeholder {
    color: var(--text-dim);
}

/* Info summary */
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 7px 0;
    border-bottom: 1px solid var(--border-light);
    font-size: .79rem;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row .ir-label {
    color: var(--text-muted);
}

.info-row .ir-val {
    font-weight: 600;
    font-family: 'DM Mono', monospace;
    font-size: .76rem;
    color: var(--text-primary);
}

.info-row .ir-val.danger {
    color: var(--accent-red);
}

.info-row .ir-val.ok {
    color: var(--accent-green);
}

/* Placeholder slot */
.sb-placeholder {
    border: 1.5px dashed #cbd5e1;
    border-radius: 10px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 6px;
    cursor: pointer;
    transition: .15s ease;
    min-height: 80px;
    background: #fff;
}

.sb-placeholder:hover {
    border-color: var(--accent-blue);
    background: #eff6ff;
}

.sb-placeholder i {
    font-size: 1.3rem;
    color: var(--text-dim);
}

.sb-placeholder span {
    font-size: .72rem;
    color: var(--text-dim);
}

/* ── Status bar ── */
.igh-statusbar {
    background: var(--bg-card);
    border-top: 1px solid var(--border);
    padding: 9px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: .75rem;
    flex-wrap: wrap;
}

.sdot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

.sdot-green { background: var(--accent-green); }
.sdot-red { background: var(--accent-red); }
.sdot-blue { background: var(--accent-blue); }
.sdot-gray { background: var(--text-dim); }

.si {
    display: flex;
    align-items: center;
    gap: 6px;
}

.si .lbl {
    color: var(--text-muted);
}

.si .val {
    font-weight: 600;
    color: var(--text-primary);
}

.si .add {
    color: var(--text-dim);
    cursor: pointer;
}

.si .add:hover {
    color: var(--accent-blue);
}
</style>

<div class="igh-wrap">

    {{-- ══ HEADER ══ --}}
    <div class="igh-header">
        <div class="igh-header-left">
            <h2>📦 Igloohome Inventory Dashboard</h2>
            <p>Real-time product &amp; stock overview</p>
        </div>
        <div class="igh-header-actions">
            <a href="{{ route('dashboard') }}" class="igh-link">
                <button class="igh-btn igh-btn-green">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </a>

            <a href="{{ route('users.index') }}" class="igh-link">
                <button class="igh-btn igh-btn-green">
                    <i class="bi bi-people"></i> Manage Users
                </button>
            </a>

            <a href="{{ route('profile.edit') }}" class="igh-link">
                <button class="igh-btn igh-btn-blue">
                    <i class="bi bi-person"></i> Profile
                </button>
            </a>
        </div>
    </div>

    {{-- ══ BODY ══ --}}
    <div class="igh-body">
        <div class="prd-notes-grid">

            {{-- LEFT: Product Table --}}
            <div class="igh-product-section">
                <div class="prd-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <h6>Product Area</h6>
                        <span style="font-size:.72rem;color:var(--text-muted);">Quick access — all products</span>
                    </div>

                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <input type="text" class="igh-search" id="ighSearch" placeholder="Search products…">

                        <button class="igh-btn igh-btn-green igh-btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-lg"></i> New Product
                        </button>

                        <button class="igh-btn igh-btn-ghost igh-btn-sm">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>

                <div class="prd-scroll">
                    <table class="igh-table" id="ighTable">
                        <thead>
                            <tr>
                                <th style="padding-left:20px;">#</th>
                                <th>Product Name</th>
                                <th class="c">SKU</th>
                                <th class="c">Stock</th>
                                <th class="c">Status</th>
                                <th class="c">Category</th>
                                <th class="c">Cost</th>
                                <th class="c">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                                @php
                                    $bc = match($p['status']) {
                                        'In Stock' => 'badge-in',
                                        'Low Stock' => 'badge-low',
                                        'Out of Stock' => 'badge-out',
                                        default => '',
                                    };
                                @endphp
                                <tr class="prd-row">
                                    <td style="color:var(--text-dim);font-size:.72rem;padding-left:20px;">{{ $p['id'] }}</td>
                                    <td style="font-weight:500;">{{ $p['name_en'] }} ({{ $p['name_jp'] }})</td>
                                    <td class="c mono">{{ $p['sku'] }}</td>
                                    <td class="c" style="font-family:'DM Mono',monospace;font-size:.8rem;">00</td>
                                    <td class="c"><span class="{{ $bc }}">{{ $p['status'] }}</span></td>
                                    <td class="c" style="color:var(--text-muted);font-size:.76rem;">{{ $p['category'] }}</td>
                                    <td class="c" style="font-family:'DM Mono',monospace;font-size:.78rem;color:#9a6700;">
                                        {{ $p['description'] }}
                                    </td>
                                    <td class="c">
                                        <a href="{{ url('/'.$p['redirect_id']) }}" class="go-btn">
                                            {{ $p['name_en'] }} Dashboard
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="prd-footer">
                    <span>{{ count($products) }} products listed</span>
                    <a href="{{ url('/products') }}" class="igh-btn igh-btn-ghost igh-btn-sm">View All Products →</a>
                </div>
            </div>

            {{-- RIGHT: Notes panel --}}
            <div class="igh-panel">
                <div class="sb-panel-hdr">
                    <span class="sb-title">
                        <i class="bi bi-journal-text" style="color:var(--accent-green)"></i> Notes
                    </span>
                    <button class="igh-btn igh-btn-ghost igh-btn-sm" style="padding:3px 9px;">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>

                <div class="sb-body">
                    <div class="note-chip nc-yellow">
                        <div class="nc-text">Discuss bulk pricing for Q2 on Tuesday.</div>
                        <div class="nc-date">Mar 18 · Admin</div>
                    </div>

                    <div class="note-chip nc-blue">
                        <div class="nc-text">Prepare all PO receipts.</div>
                        <div class="nc-date">Mar 17 · Admin</div>
                    </div>

                    <div class="note-chip nc-green">
                        <div class="nc-text">Generate Report.</div>
                        <div class="nc-date">Mar 15 · Admin</div>
                    </div>

                    <textarea class="note-input" rows="2" placeholder="Add a quick note…"></textarea>

                    <button class="igh-btn igh-btn-green igh-btn-sm" style="width:100%;margin-top:8px;justify-content:center;">
                        <i class="bi bi-check-lg"></i> Save Note
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.pop-up-add-product-modal')

<script>
document.getElementById('ighSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#ighTable .prd-row').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

@endsection