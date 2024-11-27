@extends('admin.layouts.dash')
@section('Developers')
    active
@endsection
@section('activity-title')
    Courses
@endsection
@section('content')
    @php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp

    <form class="container" action="{{ route('developer.update', $developer->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ $developer->name }}" class="single-input">
        </div>
        <div class="form-group">
            <label class="form-label">Role</label>
            <input type="text" name="role" value="{{ $developer->role }}" class="single-input">
        </div>
        <div class="form-group "">
            <label class=" form-label">Image</label>
            <input type="file" name="image" value="{{ asset($developer->image) }}" class="single-input">
        </div>
        <div class="form-group">
            <label class="form-label">Facebook Link</label>
            <input type="text" name="facebook" value="{{ $developer->facebook }}" class="single-input">
        </div>
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ $developer->email }}" class="single-input">
        </div>
        <div class="form-group">
            <label class="form-label">linkedin Link</label>
            <input type="text" name="linkedin" value="{{ $developer->linkedin }}" class="single-input">
        </div>
        <div class="form-group">
            <label class="form-label">Github Link</label>
            <input type="text" name="github" value="{{ $developer->github }}" class="single-input">
        </div>
        <button class="m-3 w-25 btn btn-primary">Update</button>
    </form>
@endsection
