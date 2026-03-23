@extends('layouts.wellway')

@section('content')

<div class="box-panel">

    <h4 class="mb-4">Edit Stock Movement</h4>

    <form action="{{ route('wellway.movements.update', $movement->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="form-label">Order ID</label>
                <input type="text" name="order_id" class="form-control"
                    value="{{ old('order_id',$movement->order_id) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Movement Date</label>
                <input type="date" name="movement_date" class="form-control"
                    value="{{ old('movement_date',$movement->movement_date) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Requested By</label>
                <input type="text" name="requested_by" class="form-control"
                    value="{{ old('requested_by',$movement->requested_by) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Shipped By</label>
                <input type="text" name="shipped_by" class="form-control"
                    value="{{ old('shipped_by',$movement->shipped_by) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Shipped To</label>
                <input type="text" name="shipped_to" class="form-control"
                    value="{{ old('shipped_to',$movement->shipped_to) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Shipped On</label>
                <input type="date" name="shipped_on" class="form-control"
                    value="{{ old('shipped_on',$movement->shipped_on) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="initialized" {{ $movement->status=='initialized'?'selected':'' }}>Initialized
                    </option>

                    <option value="processing" {{ $movement->status=='processing'?'selected':'' }}>Processing</option>

                    <option value="packed" {{ $movement->status=='packed'?'selected':'' }}>Packed</option>

                    <option value="shipped" {{ $movement->status=='shipped'?'selected':'' }}>Shipped</option>

                    <option value="delivered" {{ $movement->status=='delivered'?'selected':'' }}>Delivered</option>

                    <option value="completed" {{ $movement->status=='completed'?'selected':'' }}>Completed</option>

                    <option value="cancelled" {{ $movement->status=='cancelled'?'selected':'' }}>Cancelled</option>

                    <option value="returned" {{ $movement->status=='returned'?'selected':'' }}>Returned</option>

                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Tracking Number</label>
                <input type="text" name="tracking_number" class="form-control"
                    value="{{ old('tracking_number',$movement->tracking_number) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Carrier</label>
                <input type="text" name="carrier" class="form-control" value="{{ old('carrier',$movement->carrier) }}">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Remark</label>
                <textarea name="note" class="form-control">{{ old('note',$movement->note) }}</textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-dark">
            Update Movement
        </button>

        <a href="{{ route('wellway.allMovements') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection