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

        <!-- Create Button -->
        <div class="button-container">
            {{-- <a href="{{ route('faqs.create') }}" class="btn create-btn"><i class="fas fa-plus"></i> Create New FAQ</a> --}}
        </div>
        <!-- Create Button -->
        <div class="button-container">
            <a href="{{ route('faqs.create') }}" class="btn create-btn"><i class="fas fa-plus"></i> Create New FAQ</a>
        </div>
        <!-- Data Table -->
        <table class="styled-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->id }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        <a href="{{ route('faqs.edit', $faq->id) }}" class="btn edit-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
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
