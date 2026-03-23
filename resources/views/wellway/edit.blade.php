@extends('layouts.wellway')

@section('content')
<div class="box-panel">
    <h4 class="mb-3">Edit Wellway Product</h4>

    <form action="{{ route('wellway.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('wellway._form')
        <button type="submit" class="btn btn-dark btn-custom">Update Product</button>
        <a href="{{ route('wellway.index') }}" class="btn btn-outline-secondary btn-custom">Cancel</a>
    </form>
</div>
@endsection