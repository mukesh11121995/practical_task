@extends('layouts.master')
@section('content')

<h3>Create Permission Group</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.permissions.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Permission Base Name (e.g., user, post)</label>
        <input type="text" name="module" class="form-control" placeholder="Enter base name (e.g., user)" value="{{ old('module') }}">
    </div>
    <button class="btn btn-primary">Create Permissions</button>
</form>

@endsection
