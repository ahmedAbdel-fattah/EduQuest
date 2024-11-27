@extends('admin.layouts.dash')
@section('instructor-questions')
    active
@endsection
@section('activity-title')
instructor_question_edit
@endsection
@section('content')
@php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp
    <div class="container">
        <h2>Edit FAQ</h2>

        <!-- Form for Creating or Editing an Entry -->
        <form action="{{ route('instructor-questions.update', $data->id) }}" method="POST">
            <!-- Input for Name -->
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="question">question</label>
                <input type="text" name="question" id="question" class="form-control" value="{{ $data->question_title }}" required>
            </div>

            <div class="choices-group">
            <div class="form-group">
            <div class="col-md-3">
                <label for="choice1">choice 1</label>
                <input type="text" name="choice1" id="choice1" value="{{ $data->choice1 }}" class="form-control" placeholder="Enter choice 1" required>
            </div>
        </div>
        <div class="form-group">
        <div class="col-md-3">
            <label for="choice2">choice 2</label>
            <input type="text" name="choice2" id="choice2" value="{{ $data->choice2 }}" class="form-control" placeholder="Enter choice 2" required>
        </div>
        </div>
            <div class="form-group">
            <div class="col-md-3">
                <label for="choice3">choice 3</label>
            <input type="text" name="choice3" id="choice3" value="{{ $data->choice3 }}" class="form-control" placeholder="Enter choice 3" required>
        </div>
        </div>
        </div>


            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit</button>
                {{-- <button type="reset" class="reset-btn">Reset</button> --}}
            </div>
        </form>
    </div>

@endsection
