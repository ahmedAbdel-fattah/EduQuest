@extends('admin.layouts.dash')
@section('adVideo')
active
@endsection
@section('activity-title')
AdVideo
@endsection
@section('content')
@php
// Define the variable to hide the div in the layout
$hideSpecialDiv = true;
@endphp

<form class="container" action="{{ route('about.storeVideo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="form-label">Description</label>
        <input type="text" name="description" class="single-input">
    </div>

    <div class="form-group">
        <label class="form-label">Video</label>
        <input type="file" name="video" accept="video/*" id="videoInput" class="form-control" style="display:block;">
    </div>

    <!-- عنصر الفيديو لعرض الفيديو المختار -->
    <div class="form-group">
        <video id="videoPreview" width="320" height="240" controls style="display:none;">
            <source id="videoSource" src="" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <button class="m-3 w-25 btn btn-primary">Add</button>
</form>

<script>
    // JavaScript لتحميل الفيديو المختار وعرضه
    document.getElementById('videoInput').addEventListener('change', function(event) {
        const videoFile = event.target.files[0]; // الحصول على الملف المختار

        if (videoFile) {
            const videoPreview = document.getElementById('videoPreview'); // عنصر الفيديو
            const videoSource = document.getElementById('videoSource'); // مصدر الفيديو

            // إنشاء رابط لعرض الفيديو
            const videoURL = URL.createObjectURL(videoFile);
            videoSource.src = videoURL;
            videoPreview.style.display = 'block'; // عرض عنصر الفيديو

            videoPreview.load(); // إعادة تحميل الفيديو الجديد
        }
    });
</script>


@endsection
