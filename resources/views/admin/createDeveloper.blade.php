@extends('admin.layouts.dash')
@section('Developers')
    active
@endsection
@section('activity-title')
Developers
@endsection
@section('content')
@php
// Define the variable to hide the div in the layout
$hideSpecialDiv = true;
@endphp

<form class="container" action="{{ route('developer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="form-label">Name</label>
        <input type="text" name="name"  class="single-input">
    </div>
    <div class="form-group">
        <label class="form-label">Role</label>
        <input type="text" name="role"  class="single-input">
    </div>
    <div class="form-group ">
        <label class="form-label">Image</label>
        <input  type="file" name="image" class="single-input">
    </div>
    <div class="form-group">
        <label class="form-label">Facebook Link</label>
        <input type="text" name="facebook" class="single-input">
    </div>
    <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="single-input">
    </div>
    <div class="form-group">
        <label class="form-label">linkedin Link</label>
        <input type="text" name="linkedin" class="single-input">
    </div>
    <div class="form-group">
        <label class="form-label">Github Link</label>
        <input type="text" name="github"  class="single-input">
    </div>
    <button class="m-3 w-25 btn btn-primary">Add</button>
</form>

@endsection
