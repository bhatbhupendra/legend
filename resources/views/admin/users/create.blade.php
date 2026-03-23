@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create User</h3>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>

        <select name="role" class="form-control mb-2">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
        </select>

        <button class="btn btn-success">Create</button>
    </form>
</div>
@endsection