@extends('layouts.wellway')

@section('content')
<div class="table-box">
    <h4 class="mb-3">Stock History - {{ $product->name_en }}</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Status</th>
                    <th>Requested By</th>
                    <th>Shipped By</th>
                    <th>Shipped To</th>
                    <th>Shipped On</th>
                    <th>Done By</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $movement)
                <tr>
                    <td>{{ $movement->order_id ?? '-' }}</td>
                    <td>{{ $movement->movement_date }}</td>
                    <td>
                        @if($movement->type === 'in')
                        <span class="badge bg-success">IN</span>
                        @else
                        <span class="badge bg-danger">OUT</span>
                        @endif
                    </td>
                    <td>{{ $movement->qty }}</td>
                    <td>{{ $movement->stock_before ?? '-' }}</td>
                    <td>{{ $movement->stock_after ?? '-' }}</td>
                    <td>{{ $movement->status ?? '-' }}</td>
                    <td>{{ $movement->requested_by ?? '-' }}</td>
                    <td>{{ $movement->shipped_by ?? '-' }}</td>
                    <td>{{ $movement->shipped_to ?? '-' }}</td>
                    <td>{{ $movement->shipped_on ?? '-' }}</td>
                    <td>{{ $movement->user->name ?? 'N/A' }}</td>
                    <td>{{ $movement->note ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center">No stock history found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $movements->links() }}
</div>
@endsection