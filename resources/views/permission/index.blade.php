@extends('layouts.master')
@section('content')

<h4>Permissions</h4>
<a href="{{ route('admin.permissions.create') }}" class="btn btn-success mb-2">Create Permission</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Permission Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $permission->name }}</td>
            <td>
                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Delete this permission?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
