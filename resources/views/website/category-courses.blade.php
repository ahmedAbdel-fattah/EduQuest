@extends('website.layouts.app')
@section('content')
    <h1>{{ $category->name }}</h1>
    <ul>
    @if($courses)
        @foreach($courses as $course)
            <li>{{ $course->image }}</li>
            <li>{{ $course->title }}</li>
            <li>{{ $course->description }}</li>
        @endforeach
    @else
        <p>No courses available.</p>
    @endif
    </ul>
@endsection
