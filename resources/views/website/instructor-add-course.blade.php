@extends('website.layouts.instructor-dash')
@section('add-course')
    active
@endsection
@section('content')
<!-- Main Content -->
{{--<div class="main-content">--}}
<br>

<br>
<div class="container" style="width: 70%; margin-left: 300px">
    <center>
        <header>
            <h1>Add New Course</h1>
        </header>
    </center>
<form id="addCourseForm" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Course Details -->
    <div class="form-group">
        <label for="title">Course Title</label>
        <input type="text" name="title" id="title" required>

    </div>
    <div class="form-group">
        <label for="description">Course Description</label>
        <textarea name="description" id="description" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="objectives">Course Objectives</label>
        <textarea name="objectives" id="objectives" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" id="category" required>
        @foreach($categories as $category)
                <option value="{{ $category->id }}">{{$category->name}}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" required>
    </div>
    <div class="form-group">
        <label for="image">Course Image</label>
        <input type="file" name="image" id="image" required>
    </div>
    <div class="form-group">
        <label for="numSections">Number of Sections</label>
        <input type="number" name="num_sections" id="numSections" required>
    </div>

    <!-- Section Titles and Videos -->
    <div id="sectionContainer"></div>

    <!-- Submit Button -->
    <button type="submit" class="submit-btn">Submit Course</button>
</form>
</div>

<script>
    document.getElementById('numSections').addEventListener('input', function() {
        const sectionContainer = document.getElementById('sectionContainer');
        sectionContainer.innerHTML = ''; // Clear existing sections

        const numSections = parseInt(this.value);
        if (!isNaN(numSections) && numSections > 0) {
            for (let i = 1; i <= numSections; i++) {
                const sectionDiv = document.createElement('div');
                sectionDiv.classList.add('section-group');

                // Add Section Title
                sectionDiv.innerHTML = `
                        <h4>Section ${i}</h4>
                        <div class="form-group">
                            <label for="section_title_${i}">Section Title</label>
                            <input type="text" name="sections[${i}][title]" id="section_title_${i}" required>
                        </div>
                        <div class="form-group">
                            <label for="section_videos_${i}">Upload Videos</label>
                            <input type="file" name="sections[${i}][videos][]" id="section_videos_${i}" multiple required>
                        </div>
                    `;
                sectionContainer.appendChild(sectionDiv);
            }
        }
    });
</script>
<br><br>
@endsection
