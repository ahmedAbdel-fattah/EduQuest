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
    <div class="container">
        <div class="main-content">
            <div class="d-block justify-content-center">
                <div class="button-container mb-4">
                    <a href="{{route('adVideo-add')}}" class="btn create-btn"><i class="fas fa-plus"></i> Add Video</a>
                </div>

                @foreach ($adVideo as $video)
                    <div class="video-item mb-5" style="text-align: center">
                        <!-- فيديو -->
                        <video width="600" controls>
                            <source src="{{ asset('videos/'.$video->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- أزرار التعديل والحذف -->
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="{{ route('video.edit', $video->id) }}" class="btn edit-btn">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('delete_advideo', $video->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



</div>


@endsection
