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

    <table class="styled-table">
        <thead >
            <tr >
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Role</th>
                <th>Links</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($developers as $developer)
            <tr>
                <td>{{ $developer->id }}</td>
                <td>
                    <div class="cat-icon">
                        <img style="width: 80px;" src="{{asset($developer->image)}}" alt="">
                    </div>
                </td>
                <td>{{ $developer->name }}</td>
                <td>{{ $developer->role }}</td>
                <td>
                    <div>
                        <a class="m-1" href="{{$developer->facebook}}"><i class="fab fa-facebook-f"></i></a>
                        <a class="m-1" href="{{$developer->linkedin}}"><i class="fab fa-linkedin"></i></a>
                        <a class="m-1" href="mailto:{{$developer->twitter}}"><i class="fa-solid fa-envelope"></i></i></a>
                        <a class="m-1" href="{{$developer->github}}"><i class="fab fa-github"></i></a>
                    </div>
                </td>
                <td >
                    <div class="d-flex ">
                        <div >
                            <a href="{{route('developer.edit',$developer->id)}}"
                                class="genric-btn success w-50 mt-5 me-3"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                        <form action="{{route('developer.destroy',$developer->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="genric-btn danger w-50"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        <a href="{{route('developer.create')}}" class="btn btn-success mt-5">Add Developer</a>
    </div>

@endsection