@extends('layouts.master')
@section('content')

<div class="container">
    <h3 class="mb-4">Edit HR</h3>

    <form action="{{ route('admin.hr.update',$id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$user->name}}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{$user->email}}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-control" required>
                        <option value="">-- Select Gender --</option>
                        <option value="male" @if($user->gender == 'male')  selected @endif>Male</option>
                        <option value="female" @if($user->gender == 'female') ? selected @endif>Female</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" value="{{$user->dob}}" required>
                </div>

            </div>
            {{-- <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Profile Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div> --}}
            {{-- <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password" required>
                </div>

            </div> --}}
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save HR</button>
    </form>
</div>

@endsection
