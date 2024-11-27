@extends('admin.layouts.dash')
@section('users')
    active
@endsection
@section('activity-title')

    users
@endsection

@section('content')
    @php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp



    <div class="container">
        <h1 class="table-title">current users</h1>

        <!-- Create Button -->
        <div class="button-container">
            {{-- <a href="{{ route('faqs.create') }}" class="btn create-btn"><i class="fas fa-plus"></i> Create New FAQ</a> --}}
        </div>
        <!-- Create Button -->
        {{-- <div class="button-container">
            <a href="{{ route('faqs.create') }}" class="btn create-btn"><i class="fas fa-plus"></i> Create New FAQ</a>
        </div> --}}
        <!-- Data Table -->
        <style>
            .green-500 {
                background-color: #48bb78;
                /* لون أخضر */
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
            }

            .red-500 {
                background-color: #f56565;
                /* لون أحمر */
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
            }

            .bg-2 {
                font-size: 14px;
                font-weight: bold;
            }

            .filter{
                text-align: right;
            }
            .filter select{
                background-color: #31353b;
                color: white;
                border: none;
                cursor: pointer;

            }
            .filter label{
                color: #c8c8c8;
            }
        </style>

@if (session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    <div class="filter">
        <select name="filter" id="filter" onchange="filterTable()">
            <option value="all">All</option>
            <option value="students">Students</option>
            <option value="instructors">Instructors</option>
            <option value="admins">Admins</option>
        </select>
        <label for="filter"><i class="fas fa-filter"></i></label>
    </div>

    <table id="userTable" class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>created at</th>
                <th>Role</th>
                <th>Last Seen</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $data)
            <tr data-role="{{ strtolower($data->is_admin == 1 ? 'admin' : ($data->is_instructor == 1 ? 'instructor' : 'student')) }}">


                    <td>{{ $data->name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        @if ($data->is_admin == 1)
                            admin
                        @elseif ($data->is_instructor == 0 && $data->is_admin == 0)
                            student

                        @elseif ($data->is_instructor == 1 && $data->is_admin == 0)
                            instructor
                        @endif
                    </td>
                    <td>
                        @php
                            if ($data->last_seen !== null) {
                                $diffInMinutes = Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($data->last_seen));
                                $status = $diffInMinutes <= 2 ? 'Online' : 'Offline';
                                $statusColor = $diffInMinutes <= 2 ? 'green-500' : 'red-500';
                            } else {
                                $status = 'Status Unavailable';
                                $statusColor = 'gray-500';
                            }
                        @endphp

                        @if($data->last_seen !== null)
                            {{ Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </td>
                    <td>
                        <span class="bg-2 {{ $statusColor }}">
                            {{ $status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.user_data', $data->id) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="view"><i class="fas fa-eye"></i></a>
                        {{-- <form action="{{ route('users.destroy', $data->id) }}" onsubmit="return confirmDelete()" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form> --}}

                        @if ($data->is_admin == 0)
                            <a href="{{ route('dashboard.add_admin', $data->id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="add admin"><i class="fas fa-plus"></i></a>
                        @elseif ($data->is_admin == 1)
                            <a href="{{ route('dashboard.drop_admin', $data->id) }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="remove admin"><i class="fas fa-trash"></i></a>
                        @endif
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>






    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to remove this user?');
        }
    </script>
@endsection
