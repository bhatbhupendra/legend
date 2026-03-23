@extends('layouts.wellway')

@section('content')
<div class="box-panel">
    <h4 class="mb-3">Create Wellway Product</h4>

    <form action="{{ route('wellway.store') }}" method="POST">
        @csrf
        @include('wellway._form')
        <button type="submit" class="btn btn-dark btn-custom">Save Product</button>
        <a href="{{ route('wellway.index') }}" class="btn btn-outline-secondary btn-custom">Cancel</a>
    </form>
</div>
@endsection