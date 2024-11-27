@extends('admin.layouts.dash')

@section('settings')
    active
@endsection
@section('activity-title')
    Settings
@endsection
@section('content')
@php
    // Define the variable to hide the div in the layout
    $hideSpecialDiv = true;
@endphp
<body>

    <!-- Main Wrapper -->
    <div class="button-container">
        <a href="{{ route('settings.create') }}" class="btn create-btn" ><i class="fas fa-plus"></i>Add Contact Info</a>
    </div>
    <div id="container" class="container">

            <!-- Add Contact Info Button -->
            <h1 class="table-title">Contact Information</h1>
            <!-- Contact Information Management Section -->

                    <table class="styled-table" >
                        <thead >
                            <tr>
                                <th style="padding: 12px 15px;">Address</th>
                                <th style="padding: 12px 15px;">Phone</th>
                                <th style="padding: 12px 15px;">Email</th>
                                <th style="padding: 12px 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->address }}</td>
                                    <td>{{ $setting->phone }}</td>
                                    <td>{{ $setting->email }}</td>
                                    <td>
                                        <a href="{{ route('settings.edit', $setting) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('settings.destroy', $setting) }}" method="POST" style="display:inline; ">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="remove"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



    </div>

</body>
@endsection
