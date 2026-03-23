@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit User</h3>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-2">
        <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2">

        <input type="password" name="password" placeholder="New Password (optional)" class="form-control mb-2">

        <select name="role" class="form-control mb-2">
            <option value="user" {{ $user->role=='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="owner" {{ $user->role=='owner' ? 'selected' : '' }}>Owner</option>
        </select>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection