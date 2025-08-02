@extends('layouts.master')

@section('content')
<div class="content-header">
    <h3>Employee List</h3>
    <a href="{{route('admin.employee.create')}}" class="btn btn-primary">Create</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- ✅ Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="userTable">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>
                        @if ($user->image)
                            <img src="{{ asset('storage/'.$user->image) }}" alt="image" width="40" height="40">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.hr.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ route('admin.hr.destroy', $user->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
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
        $('#userTable').DataTable({
            "pageLength": 10,
            "order": [[0, "asc"]],
        });
    });
</script>
@endpush
