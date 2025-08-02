@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Create Role</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Role Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <h5 class="mt-3">Assign Permissions:</h5>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input">
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Role</button>
    </form>
</div>
@endsection
