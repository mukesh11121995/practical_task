@extends('layouts.master')

@section('content')
    <!-- Your page content goes here -->

    <h3>Roles</h3>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-success mb-2">Create Role</a>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="RoleTable">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                            <td>
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete role?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#RoleTable').DataTable({
            "pageLength": 10,
            "order": [[0, "asc"]],
        });
    });
</script>
@endpush
