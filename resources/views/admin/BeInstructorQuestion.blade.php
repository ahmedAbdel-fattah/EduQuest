@extends('admin.layouts.dash')
@section('instructor-questions')
    active
@endsection
@section('activity-title')
    Instructor Questions
@endsection
@section('content')
@php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp

<!-- Create Button -->
<div class="button-container">
    <a href="{{ route('instructor-questions.create') }}" class="btn create-btn"><i class="fas fa-plus"></i> Create New Question</a>
</div>
<!-- Create Button -->
    <div class="container">
        <h1 class="table-title">Instructor Questions Management</h1>


        <!-- Data Table -->
        <table class="styled-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>choices</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->question_title }}</td>
                    <td>
                        {{
                        $data->choice1.'   , '.$data->choice2.'   , '.$data->choice3;

                        }}</td>
                    {{-- <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td> --}}
                    <td>
                        <a href="{{ route('instructor-questions.edit', $data->id) }}" class="btn edit-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="edit"><i class="fas fa-edit"></i></a>
                        <form action="{{route('instructor-questions.destroy',$data->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="remove"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
