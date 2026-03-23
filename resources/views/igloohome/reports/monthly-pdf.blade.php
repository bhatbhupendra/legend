<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Igloohome Report</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        color: #1f2937;
    }

    h1,
    h2,
    h3 {
        margin: 0 0 10px;
    }

    .section {
        margin-bottom: 22px;
    }

    .grid {
        width: 100%;
        border-collapse: collapse;
    }

    .grid th,
    .grid td {
        border: 1px solid #d1d5db;
        padding: 6px 8px;
        vertical-align: top;
    }

    .grid th {
        background: #f3f4f6;
        text-align: left;
    }

    .cards {
        width: 100%;
        border-collapse: separate;
        border-spacing: 8px;
    }

    .card {
        border: 1px solid #d1d5db;
        background: #f9fafb;
        padding: 10px;
        border-radius: 8px;
    }

    .big {
        font-size: 16px;
        font-weight: 700;
    }

    .muted {
        color: #6b7280;
    }

    .small {
        font-size: 10px;
    }
    </style>
</head>

<body>

    <h1>Igloohome Monthly Inventory Report</h1>
    <p class="muted">Period: {{ $report['monthLabel'] }}</p>

    <div class="section">
        <h2>1. Inventory Snapshot</h2>
        <table class="cards" width="100%">
            <tr>
                <td class="card">
                    <div class="small muted">Total Products</div>
                    <div class="big">{{ $report['inventory']['totalProducts'] }}</div>
                </td>
                <td class="card">
                    <div class="small muted">Active Products</div>
                    <div class="big">{{ $report['inventory']['activeProducts'] }}</div>
                </td>
                <td class="card">
                    <div class="small muted">Inactive Products</div>
                    <div class="big">{{ $report['inventory']['inactiveProducts'] }}</div>
                </td>
            </tr>
            <tr>
                <td class="card">
                    <div class="small muted">Low Stock Products</div>
                    <div class="big">{{ $report['inventory']['lowStockCount'] }}</div>
                </td>
                <td class="card">
                    <div class="small muted">Total Units in Stock</div>
                    <div class="big">{{ $report['inventory']['totalUnits'] }}</div>
                </td>
                <td class="card">
                    <div class="small muted">Inventory Value</div>
                    <div class="big">{{ number_format($report['inventory']['inventoryValue'], 2) }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>2. Movement Summary</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>Metric</th>
                    <th>This Month</th>
                    <th>Previous Month</th>
                    <th>Difference</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Movements</td>
                    <td>{{ $report['movementSummary']['totalMovements'] }}</td>
                    <td>{{ $report['previousMovementSummary']['totalMovements'] }}</td>
                    <td>{{ $report['movementSummary']['totalMovements'] - $report['previousMovementSummary']['totalMovements'] }}
                    </td>
                </tr>
                <tr>
                    <td>Total In</td>
                    <td>{{ $report['movementSummary']['totalIn'] }}</td>
                    <td>{{ $report['previousMovementSummary']['totalIn'] }}</td>
                    <td>{{ $report['movementSummary']['totalIn'] - $report['previousMovementSummary']['totalIn'] }}</td>
                </tr>
                <tr>
                    <td>Total Out</td>
                    <td>{{ $report['movementSummary']['totalOut'] }}</td>
                    <td>{{ $report['previousMovementSummary']['totalOut'] }}</td>
                    <td>{{ $report['movementSummary']['totalOut'] - $report['previousMovementSummary']['totalOut'] }}
                    </td>
                </tr>
                <tr>
                    <td>Net</td>
                    <td>{{ $report['movementSummary']['net'] }}</td>
                    <td>{{ $report['previousMovementSummary']['net'] }}</td>
                    <td>{{ $report['movementSummary']['net'] - $report['previousMovementSummary']['net'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>3. Monthly Comparison (Last 6 Months)</h2>

        @php
        $data = $report['monthlyComparison'];
        $max = collect($data)->flatMap(fn($row) => [$row['in'], $row['out']])->max() ?: 1;
        $chartWidth = 520;
        $chartHeight = 180;
        $left = 40;
        $bottom = 25;
        $usableHeight = 120;
        $step = 75;
        @endphp

        <svg width="{{ $chartWidth }}" height="{{ $chartHeight }}" xmlns="http://www.w3.org/2000/svg">
            <line x1="{{ $left }}" y1="10" x2="{{ $left }}" y2="{{ 10 + $usableHeight }}" stroke="#444" />
            <line x1="{{ $left }}" y1="{{ 10 + $usableHeight }}" x2="{{ $chartWidth - 10 }}"
                y2="{{ 10 + $usableHeight }}" stroke="#444" />

            @foreach($data as $i => $row)
            @php
            $groupX = $left + 18 + ($i * $step);
            $inHeight = ($row['in'] / $max) * $usableHeight;
            $outHeight = ($row['out'] / $max) * $usableHeight;
            @endphp

            <rect x="{{ $groupX }}" y="{{ 10 + $usableHeight - $inHeight }}" width="18" height="{{ $inHeight }}"
                fill="#3b82f6" />
            <rect x="{{ $groupX + 24 }}" y="{{ 10 + $usableHeight - $outHeight }}" width="18" height="{{ $outHeight }}"
                fill="#ef4444" />

            <text x="{{ $groupX - 2 }}" y="{{ 10 + $usableHeight + 14 }}" font-size="9">{{ $row['label'] }}</text>
            @endforeach

            <rect x="360" y="15" width="12" height="12" fill="#3b82f6" />
            <text x="378" y="25" font-size="10">Stock In</text>

            <rect x="440" y="15" width="12" height="12" fill="#ef4444" />
            <text x="458" y="25" font-size="10">Stock Out</text>
        </svg>

        <table class="grid" width="100%" style="margin-top:10px;">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Net</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['monthlyComparison'] as $row)
                <tr>
                    <td>{{ $row['label'] }}</td>
                    <td>{{ $row['in'] }}</td>
                    <td>{{ $row['out'] }}</td>
                    <td>{{ $row['net'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>4. Top Incoming Products</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Total In</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['topIncomingProducts'] as $row)
                <tr>
                    <td>{{ optional($row->product)->sku }}</td>
                    <td>{{ optional($row->product)->name_en }}</td>
                    <td>{{ $row->total_qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>5. Top Outgoing Products</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Total Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['topOutgoingProducts'] as $row)
                <tr>
                    <td>{{ optional($row->product)->sku }}</td>
                    <td>{{ optional($row->product)->name_en }}</td>
                    <td>{{ $row->total_qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>6. Low Stock Products</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Buy Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['lowStockProducts'] as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name_en }}</td>
                    <td>{{ $product->color }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ number_format($product->buy_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>7. Products Without Movement This Month</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['productsWithoutMovement'] as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name_en }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>8. Movement Status Summary</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['statusSummary'] as $row)
                <tr>
                    <td>{{ $row->status ?: 'N/A' }}</td>
                    <td>{{ $row->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>9. Carrier Summary</h2>
        <table class="grid" width="100%">
            <thead>
                <tr>
                    <th>Carrier</th>
                    <th>Total Shipments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['carrierSummary'] as $row)
                <tr>
                    <td>{{ $row->carrier }}</td>
                    <td>{{ $row->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>