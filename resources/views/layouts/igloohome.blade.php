<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igloohome Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    /* ════════════════════════════════════════════
       IGLOOHOME LAYOUT — Matching Dashboard Style
       ════════════════════════════════════════════ */

    /* ── Reset Bootstrap interference on layout shell ── */
    body {
        padding-right: 0 !important;
    }

    .igl-shell,
    .igl-sidebar,
    .igl-main {
        float: none !important;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    :root {
        --sidebar-bg: #1a1d23;
        --sidebar-width: 230px;
        --sidebar-border: rgba(255, 255, 255, .07);
        --sidebar-text: rgba(255, 255, 255, .6);
        --sidebar-active: rgba(255, 255, 255, .1);
        --sidebar-hover: rgba(255, 255, 255, .06);
        --sidebar-accent: #4361ee;
        --body-bg: #f0f2f5;
        --topbar-bg: #1a1d23;
        --topbar-height: 54px;
        --content-pad: 22px;
        --radius: 10px;
        --shadow: 0 2px 16px rgba(0, 0, 0, .07);
        --font: 'DM Sans', system-ui, sans-serif;
    }

    html,
    body {
        height: 100%;
        margin: 0 !important;
        padding: 0 !important;
        background: var(--body-bg);
        font-family: var(--font);
        font-size: 14px;
        color: #1e2329;
        overflow-x: hidden;
    }

    /* ── Layout shell — strict flex row, beats Bootstrap ── */
    .igl-shell {
        display: flex !important;
        flex-direction: row !important;
        align-items: stretch !important;
        min-height: 100vh;
        width: 100%;
    }

    /* ════════════════════
       SIDEBAR
    ════════════════════ */
    .igl-sidebar {
        width: var(--sidebar-width) !important;
        min-width: var(--sidebar-width) !important;
        max-width: var(--sidebar-width) !important;
        background: var(--sidebar-bg);
        min-height: 100vh;
        height: 100vh;
        display: flex !important;
        flex-direction: column;
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        position: sticky;
        top: 0;
        align-self: flex-start;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 100;
        box-shadow: 2px 0 20px rgba(0, 0, 0, .18);
    }

    /* Brand / logo area */
    .igl-sidebar-brand {
        padding: 20px 20px 18px;
        border-bottom: 1px solid var(--sidebar-border);
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
        user-select: none;
    }

    .igl-sidebar-brand-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(67, 97, 238, .35);
    }

    .igl-sidebar-brand-text {
        display: flex;
        flex-direction: column;
        gap: 1px;
        overflow: hidden;
    }

    .igl-sidebar-brand-text strong {
        color: #ffffff;
        font-size: 13.5px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }

    .igl-sidebar-brand-text span {
        color: rgba(255, 255, 255, .35);
        font-size: 10.5px;
        font-weight: 500;
        white-space: nowrap;
    }

    /* Section label */
    .igl-sidebar-section {
        padding: 18px 20px 6px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        color: rgba(255, 255, 255, .25);
    }

    /* Nav links */
    .igl-sidebar-nav {
        padding: 6px 10px;
        flex: 1;
    }

    .igl-nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 7px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        transition: background .15s, color .15s;
        margin-bottom: 2px;
        position: relative;
    }

    .igl-nav-link:hover {
        background: var(--sidebar-hover);
        color: rgba(255, 255, 255, .85);
    }

    .igl-nav-link.active {
        background: var(--sidebar-active);
        color: #ffffff;
        font-weight: 600;
    }

    /* Active left-bar indicator */
    .igl-nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 20%;
        bottom: 20%;
        width: 3px;
        background: var(--sidebar-accent);
        border-radius: 0 3px 3px 0;
    }

    .igl-nav-icon {
        width: 17px;
        height: 17px;
        opacity: .7;
        flex-shrink: 0;
        transition: opacity .15s;
    }

    .igl-nav-link:hover .igl-nav-icon,
    .igl-nav-link.active .igl-nav-icon {
        opacity: 1;
    }

    /* Nav divider */
    .igl-nav-divider {
        height: 1px;
        background: var(--sidebar-border);
        margin: 8px 2px;
    }

    /* Sidebar footer */
    .igl-sidebar-footer {
        padding: 14px 18px;
        border-top: 1px solid var(--sidebar-border);
        font-size: 11px;
        color: rgba(255, 255, 255, .2);
        text-align: center;
    }

    /* ════════════════════
       MAIN BODY
    ════════════════════ */
    .igl-main {
        flex: 1 1 0% !important;
        min-width: 0;
        max-width: calc(100% - var(--sidebar-width));
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* ── Top bar ── */
    .igl-topbar {
        height: var(--topbar-height);
        background: var(--topbar-bg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 22px;
        gap: 12px;
        flex-shrink: 0;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
        box-shadow: 0 1px 8px rgba(0, 0, 0, .15);
    }

    .igl-topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .igl-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
    }

    .igl-breadcrumb a {
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
        font-weight: 500;
        transition: color .15s;
    }

    .igl-breadcrumb a:hover {
        color: rgba(255, 255, 255, .7);
    }

    .igl-breadcrumb .sep {
        color: rgba(255, 255, 255, .2);
        font-size: 11px;
    }

    .igl-breadcrumb .current {
        color: rgba(255, 255, 255, .75);
        font-weight: 600;
    }

    .igl-topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }


    .igl-topbar-loged-user-details {
        color: #ffffff;
        font-size: 13.5px;
        font-weight: 700;
        text-align: end;
    }


    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .4;
        }
    }

    /* Topbar avatar / user */
    .igl-topbar-user {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        border: 2px solid rgba(255, 255, 255, .15);
        transition: border-color .15s;
    }

    .igl-topbar-user:hover {
        border-color: rgba(255, 255, 255, .4);
    }

    /* ── Content area ── */
    .igl-content {
        flex: 1;
        padding: var(--content-pad);
        overflow-y: auto;
    }

    /* ── Alert styling — matching panel style ── */
    .igl-alert {
        border-radius: var(--radius);
        border: none;
        padding: 12px 18px;
        font-size: 13.5px;
        font-weight: 500;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 16px;
        box-shadow: var(--shadow);
    }

    .igl-alert.success {
        background: #f0fdf4;
        color: #15803d;
        border-left: 4px solid #16a34a;
    }

    .igl-alert.danger {
        background: #fef2f2;
        color: #b91c1c;
        border-left: 4px solid #ef4444;
    }

    .igl-alert-icon {
        flex-shrink: 0;
        margin-top: 1px;
    }

    .igl-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        color: inherit;
        opacity: .5;
        padding: 0;
        font-size: 16px;
        line-height: 1;
        transition: opacity .15s;
        flex-shrink: 0;
    }

    .igl-alert-close:hover {
        opacity: 1;
    }

    /* ── Scrollbar styling ── */
    .igl-sidebar::-webkit-scrollbar,
    .igl-content::-webkit-scrollbar {
        width: 5px;
    }

    .igl-sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .igl-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, .1);
        border-radius: 10px;
    }

    .igl-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .igl-content::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }

    /* ── Responsive: collapse sidebar on small screens ── */
    @media (max-width: 768px) {
        .igl-sidebar {
            position: fixed !important;
            transform: translateX(-100%);
            transition: transform .25s ease;
            z-index: 999;
            width: var(--sidebar-width) !important;
        }

        .igl-sidebar.open {
            transform: translateX(0);
        }

        .igl-sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 998;
        }

        .igl-sidebar-overlay.show {
            display: block;
        }

        .igl-mobile-toggle {
            display: flex !important;
        }

        .igl-content {
            padding: 16px;
        }

        .igl-main {
            max-width: 100% !important;
        }
    }

    .igl-mobile-toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 7px;
        cursor: pointer;
        color: #fff;
        margin-right: 4px;
    }
    </style>
</head>

<body>

    <!-- Mobile overlay -->
    <div class="igl-sidebar-overlay" id="igl-overlay" onclick="closeSidebar()"></div>

    <div class="igl-shell">

        <!-- ════════════════ SIDEBAR ════════════════ -->
        <aside class="igl-sidebar" id="igl-sidebar">

            <!-- Brand -->
            <a href="{{ route('igloohome.index') }}" class="igl-sidebar-brand">
                <div class="igl-sidebar-brand-icon">📦</div>
                <div class="igl-sidebar-brand-text">
                    <strong>Igloohome</strong>
                    <span>Inventory System</span>
                </div>
            </a>

            <!-- Nav -->
            <div class="igl-sidebar-nav">
                <div class="igl-sidebar-section">Legend</div>

                <a href="{{ route('dashboard') }}" class="igl-nav-link">
                    <svg class="igl-nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                    Legend Dashboard
                </a>

                <div class="igl-sidebar-section">Main Menu</div>

                <a href="{{ route('igloohome.index') }}"
                    class="igl-nav-link {{ request()->routeIs('igloohome.index') ? 'active' : '' }}">
                    <svg class="igl-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <!-- Rounded square -->
                        <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>

                        <!-- Upward trend line -->
                        <polyline points="7,14 11,10 14,13 18,8"></polyline>

                        <!-- Circle at the end -->
                        <circle cx="18" cy="8" r="1.5" fill="currentColor" stroke="none"></circle>
                    </svg>
                    Overview
                </a>

                <a href="{{ route('igloohome.products') }}"
                    class="igl-nav-link {{ request()->routeIs('igloohome.products') ? 'active' : '' }}">
                    <svg class="igl-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <!-- Top face -->
                        <polygon points="12 3 20 7 12 11 4 7"></polygon>

                        <!-- Left face -->
                        <polygon points="4 7 12 11 12 21 4 17"></polygon>

                        <!-- Right face -->
                        <polygon points="20 7 12 11 12 21 20 17"></polygon>

                        <!-- Top detail lines -->
                        <line x1="8" y1="5" x2="16" y2="9"></line>
                        <line x1="6" y1="6" x2="14" y2="10"></line>
                    </svg>
                    Iglohome Products
                </a>

                <a href="{{ route('igloohome.create') }}"
                    class="igl-nav-link {{ request()->routeIs('igloohome.create') ? 'active' : '' }}">
                    <svg class="igl-nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="16" />
                        <line x1="8" y1="12" x2="16" y2="12" />
                    </svg>
                    Add Product
                </a>

                <div class="igl-nav-divider"></div>
                <div class="igl-sidebar-section">Reports</div>

                <a href="{{ route('igloohome.allMovements') }}"
                    class="igl-nav-link {{ request()->routeIs('igloohome.allMovements') ? 'active' : '' }}">
                    <svg class="igl-nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="12 8 12 12 14 14" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    Movements
                </a>


                <div class="igl-nav-divider"></div>
                <div class="igl-sidebar-section">More</div>

                <a href="{{ route('users.index') }}" class="igl-nav-link">
                    <svg class="igl-nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M20 21a8 8 0 1 0-16 0" />
                    </svg>
                    Users
                </a>

                <a href="{{route('profile.edit')}}" class="igl-nav-link">
                    <svg class="igl-nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                    </svg>
                    Settings
                </a>


            </div>

            <!-- Sidebar footer -->
            <div class="igl-sidebar-footer">
                Igloohome &copy; {{ date('Y') }}
            </div>

        </aside>
        <!-- /sidebar -->

        <!-- ════════════════ MAIN ════════════════ -->
        <div class="igl-main">

            <!-- ── Top bar ── -->
            <header class="igl-topbar">
                <div class="igl-topbar-left">
                    <!-- Mobile hamburger -->
                    <button class="igl-mobile-toggle" onclick="openSidebar()" aria-label="Open menu">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2"
                            viewBox="0 0 24 24">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>

                    <!-- Breadcrumb -->
                    <nav class="igl-breadcrumb">
                        <a href="{{ route('igloohome.index') }}">Igloohome</a>
                        <span class="sep">›</span>
                        <span class="current">
                            @if(request()->routeIs('igloohome.index')) Overview
                            @elseif(request()->routeIs('igloohome.create')) Add Product
                            @elseif(request()->routeIs('igloohome.allMovements')) Movements
                            @elseif(request()->routeIs('igloohome.edit')) Edit Product
                            @else Dashboard
                            @endif
                        </span>
                    </nav>
                </div>

                <div class="igl-topbar-right">

                    <div class="igl-topbar-loged-user-details">
                        <div class="fw-semibold" style="">
                            {{ auth()->user()->name ?? 'User' }}</div>
                        <small class="">{{ auth()->user()->email ?? '' }}</small>
                    </div>

                    <!-- User avatar (placeholder — wire to auth()->user() if needed) -->
                    <div class="igl-topbar-user" title="Logged in user">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>
            </header>

            <!-- ── Content ── -->
            <main class="igl-content">

                {{-- Success alert --}}
                @if(session('success'))
                <div class="igl-alert success" id="igl-success-alert">
                    <span class="igl-alert-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </span>
                    <span>{{ session('success') }}</span>
                    <button class="igl-alert-close" onclick="this.closest('.igl-alert').remove()"
                        aria-label="Close">✕</button>
                </div>
                @endif

                {{-- Validation errors --}}
                @if($errors->any())
                <div class="igl-alert danger">
                    <span class="igl-alert-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </span>
                    <div>
                        @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button class="igl-alert-close" onclick="this.closest('.igl-alert').remove()"
                        aria-label="Close">✕</button>
                </div>
                @endif

                {{-- Page content --}}
                @yield('content')

            </main>
        </div>
        <!-- /main -->

    </div>
    <!-- /shell -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    /* Mobile sidebar toggle */
    function openSidebar() {
        document.getElementById('igl-sidebar').classList.add('open');
        document.getElementById('igl-overlay').classList.add('show');
    }

    function closeSidebar() {
        document.getElementById('igl-sidebar').classList.remove('open');
        document.getElementById('igl-overlay').classList.remove('show');
    }

    /* Auto-dismiss success alerts after 4 s */
    (function() {
        const el = document.getElementById('igl-success-alert');
        if (!el) return;
        setTimeout(() => {
            el.style.transition = 'opacity .4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 420);
        }, 4000);
    })();
    </script>
</body>

</html>