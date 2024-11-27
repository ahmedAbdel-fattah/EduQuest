@extends('admin.layouts.dash')
@section('categories')
    active
@endsection
@section('activity-title')
    edit category
@endsection
@php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp
@section('content')

    <div class="container">
          <h2>Update_category</h2>
          <form action="{{ route('category_update', $category->id) }}" method="POST">
          @csrf
          <div class="form-group">

              <label for="name">category name</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ $category->description }}">
            </div>
                {{-- <div class="form-group">
            <label>image</label>
            <input type="file" id="image" name="image" class="form-control" value="{{ $category->image }}">
                </div> --}}

                <div class="form-group">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Upload Image
                    </label>
                    <input id="image" type="file" accept="image/*" value="{{ $category->image }}"/>
                </div>

                <div id="image-preview" style="margin-top: 10px; width:200px;">
                    <img id="preview-img" src="{{asset('/public/images/' . $category->image)}}" alt="Preview" style="max-width: 100%; ">
                </div>


            <div class="form-actions">

                <button type="submit" class="submit-btn">Update</button>
            </div>
          </form>
    </div>
    <script>
        // استهداف المدخل وحاوية الصورة
        // استهداف المدخل، حاوية الصورة وزر إعادة التعيين
        var fileInput = document.getElementById('image');
        var previewImg = document.getElementById('preview-img');
        var resetBtn = document.getElementById('reset-btn');

        // عندما يختار الأدمن صورة
        fileInput.addEventListener('change', function() {
            var file = this.files[0];

            // التأكد من اختيار صورة
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // عرض الصورة المختارة في الحاوية
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = 'none'; // إخفاء الصورة إذا لم يتم اختيار ملف
            }
        });

        // عند الضغط على زر إعادة التعيين
        resetBtn.addEventListener('click', function() {
            // إعادة تعيين حقل الإدخال
            fileInput.value = null;

            // إخفاء الصورة
            previewImg.style.display = 'none';
        });
    </script>
    @endsection
