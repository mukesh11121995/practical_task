@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Role: {{ $role->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Role Name:</label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
        </div>

        <h5 class="mt-3">Permissions:</h5>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            class="form-check-input"
                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Role</button>
    </form>
</div>
@endsection
