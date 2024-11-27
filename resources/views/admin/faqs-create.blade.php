@extends('admin.layouts.dash')
@section('faqs')
    active
@endsection
@section('activity-title')
    FAQs
@endsection
@section('content')
@php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp
    <div class="container">
        <h2>Create New FAQ</h2>

        <!-- Form for Creating or Editing an Entry -->
        <form action="{{ route('faqs.store') }}" method="POST">
            <!-- Input for Name -->
            @csrf
            <div class="form-group">
                <label for="question">question</label>
                <input type="text" name="question" id="question" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="answer">answer</label>
                <input type="text" name="answer" id="answer" class="form-control" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit</button>
                <button type="reset" class="reset-btn">Reset</button>
            </div>
        </form>
    </div>

@endsection
