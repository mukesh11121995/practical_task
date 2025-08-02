@extends('layouts.master')

@section('content')
<div class="content-header mb-3">
    <h3>Create User</h3>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('admin.hr.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="form-group col-md-6 mb-3">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group col-md-6 mb-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 mb-3">
            <label for="gender">Gender <span class="text-danger">*</span></label>
            <select name="gender" class="form-control" required>
                <option value="">-- Select Gender --</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group col-md-6 mb-3">
            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
            @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 mb-3">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group col-md-6 mb-3">
            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password" required>
            @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 mb-3">
            <label for="image">Profile Image <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control" required>
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
@endsection
