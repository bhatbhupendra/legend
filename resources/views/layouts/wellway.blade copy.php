<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Inventory System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    body {
        background: #f5f6f8;
        font-family: Arial, sans-serif;
    }

    .main-wrapper {
        min-height: 100vh;
    }

    .sidebar {
        width: 220px;
        background: #fff;
        border-right: 2px solid #111;
        min-height: 100vh;
        padding: 20px 0;
    }

    .sidebar .menu-title {
        font-size: 14px;
        font-weight: 600;
        color: #555;
        padding: 14px 24px;
        border-bottom: 2px solid #111;
    }

    .sidebar a {
        display: block;
        padding: 14px 24px;
        color: #333;
        text-decoration: none;
        border-bottom: 1px solid #ddd;
        font-weight: 500;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #ececec;
    }

    .content-area {
        flex: 1;
        padding: 20px;
    }

    .box-panel {
        background: #fff;
        border: 2px solid #111;
        padding: 18px;
        margin-bottom: 20px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .summary-card {
        border: 2px solid #111;
        background: #f8f8f8;
        padding: 15px;
        text-align: center;
    }

    .table-box {
        background: #fff;
        border: 2px solid #111;
        padding: 18px;
    }

    .btn-custom {
        border: 2px solid #111;
        border-radius: 0;
        font-weight: 600;
    }

    .table thead th {
        background: #efefef;
        border-bottom: 2px solid #111 !important;
    }

    .stock-badge {
        font-size: 12px;
        padding: 6px 10px;
    }
    </style>
</head>

<body class="bg-light">

    @include('partials.topbar')
    @include('partials.navbar')

    <div class="d-flex main-wrapper">
        <div class="sidebar">
            <div class="menu-title">Wellway Menu</div>
            <a href="{{ route('wellway.index') }}"
                class="{{ request()->routeIs('wellway.index') ? 'active' : '' }}">Overview</a>
            <a href="{{ route('wellway.create') }}"
                class="{{ request()->routeIs('wellway.create') ? 'active' : '' }}">Add Product</a>
            <a href="{{ route('wellway.movements.all') }}"
                class="{{ request()->routeIs('wellway.movements.all') ? 'active' : '' }}">
                Movements
            </a>
        </div>

        <div class="content-area">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>

</html>