@extends('layouts.wellway')

@section('content')
<div class="table-box">
    <h4 class="mb-3">All Stock Movements</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Status</th>
                    <th>Shipped To</th>
                    <th>Done By</th>
                    <th>Remark</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $movement)
                <tr>
                    <td>{{ $movement->product->name_en ?? '-' }}</td>
                    <td>{{ $movement->order_id ?? '-' }}</td>
                    <td>{{ $movement->movement_date ?? '-' }}</td>
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

                    <td>
                        <form action="{{ route('wellway.movements.updateStatus', $movement->id) }}" method="POST"
                            class="d-flex gap-2 align-items-center">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="form-select form-select-sm" style="min-width: 160px;">
                                <option value="initialized" {{ $movement->status == 'initialized' ? 'selected' : '' }}>
                                    Initialized</option>
                                <option value="processing" {{ $movement->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="packed" {{ $movement->status == 'packed' ? 'selected' : '' }}>Packed
                                </option>
                                <option value="shipped" {{ $movement->status == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="delivered" {{ $movement->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="completed" {{ $movement->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $movement->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                                <option value="returned" {{ $movement->status == 'returned' ? 'selected' : '' }}>
                                    Returned</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-dark">Update</button>
                        </form>
                    </td>

                    <td>{{ $movement->shipped_to ?? '-' }}</td>
                    <td>{{ $movement->user->name ?? 'N/A' }}</td>
                    <td>{{ $movement->note ?? '-' }}</td>

                    <td>
                        <a href="{{ route('wellway.movements.edit', $movement->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">No stock movements found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $movements->links() }}
</div>
@endsection