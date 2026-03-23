@extends('layouts.wellway')

@section('content')
<div class="box-panel">
    <h5 class="mb-3">Summary</h5>
    <div class="summary-grid">
        <div class="summary-card">
            <div class="fw-bold">Total Products</div>
            <div class="fs-4">{{ $summary['total_products'] }}</div>
        </div>
        <div class="summary-card">
            <div class="fw-bold">Total Stock</div>
            <div class="fs-4">{{ $summary['total_stock'] }}</div>
        </div>
        <div class="summary-card">
            <div class="fw-bold">Low Stock</div>
            <div class="fs-4">{{ $summary['low_stock'] }}</div>
        </div>
    </div>
</div>


<div class="table-box">
    <h5 class="mb-3">Table showing data of Wellway Product</h5>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>English Name</th>
                    <th>Japanese Name</th>
                    <th>Color</th>
                    <th>Hinge</th>
                    <th>Stock</th>
                    <th width="340">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name_en }}</td>
                    <td>{{ $product->name_jp }}</td>
                    <td>{{ $product->color }}</td>
                    <td>{{ $product->hinge }}</td>
                    <td>
                        @if($product->stock <= 5) <span class="badge bg-danger stock-badge">{{ $product->stock }}</span>
                            @else
                            <span class="badge bg-success stock-badge">{{ $product->stock }}</span>
                            @endif
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('wellway.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-primary btn-custom">Edit</a>
                            <a href="{{ route('wellway.stockin.form', $product->id) }}"
                                class="btn btn-sm btn-outline-success btn-custom">Stock In</a>
                            <a href="{{ route('wellway.stockout.form', $product->id) }}"
                                class="btn btn-sm btn-outline-warning btn-custom">Stock Out</a>
                            <a href="{{ route('wellway.movements', $product->id) }}"
                                class="btn btn-sm btn-outline-secondary btn-custom">History</a>

                            <form action="{{ route('wellway.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-custom">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection