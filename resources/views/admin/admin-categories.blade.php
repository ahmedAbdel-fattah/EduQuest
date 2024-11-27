@extends('admin.layouts.dash')
@section('categories')
    active
@endsection
@section('activity-title')
    Categories
@endsection
@section('content')
    @php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp
        <div class="button-container">
            <a  href="{{ route('category_add') }}" class="btn create-btn"><i class="fas fa-plus"></i> Add Category</a>
        </div>
    <div class="container">

        <h1 class="table-title">Categories</h1>



            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('category_edit', $category->id) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="edit"><i class="fas fa-edit"></i></a>
                            <form method="GET" style="display:inline;" action="{{ route('category_delete', $category->id) }}">
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
    </div>
    </div>
@endsection
