@extends('website.layouts.instructor-dash')
@section('students')
    active
@endsection
@section('content')
    <br>
    <br>

    <div class="container" style="width: 910px; margin-left: 320px">
        <center>
            <header>
                <h1>Students Enrolled</h1>
            </header>
        </center>
        <table class="students-table">
            <thead>
            <tr>
                <th>
                    <center>
                        Course Name & view Action
                    </center>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    @foreach($courses as $course)
                        <div class="course-header">
                            <h2 class="stu-h2"><span>{{$course->title}}</span></h2>
                            <center><a href="#" class="toggle-link" data-table="table-{{$loop->iteration}}">View Students</a></center>
                        </div>
                        <table class="students-table hidden" id="table-{{$loop->iteration}}">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($course->enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->student->email }}</td>
                                    <td><a href="mailto:{{ $enrollment->student->email }}" class="email-btn">Contact</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br><hr>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>

    </div>

    <br><br>
    @section('custom-js')
        <script src="{{asset('js/table-toggle.js')}}"></script>
    @endsection
@endsection
