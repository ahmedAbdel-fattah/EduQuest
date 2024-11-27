
@extends('website.layouts.instructor-dash')
@section('dashboard')
    active
@endsection
@section('content')
<div class="main-content">


    <div class="container" style="width: 970px; margin-left: 50px">

        <center>
            <header>
                <h1>Performance Analysis</h1>
            </header>
        </center>
        <div class="courses-container">
            <div class="metrics">
                <div class="metric">
                    <h3>Total Students</h3>
                    <p>150</p>
                </div>
                <div class="metric">
                    <h3>Average Score</h3>
                    <p>85%</p>
                </div>
                <div class="metric">
                    <h3>Courses Completed</h3>
                    <p>30</p>
                </div>
                <div class="metric">
                    <h3>Feedback Rating</h3>
                    <p>4.5/5</p>
                </div>
            </div>

            <div class="charts">
                <div class="chart-container">
                    <h2>Student Performance</h2>
                    <canvas id="studentPerformanceChart"></canvas>
                </div>
                <div class="chart-container">
                    <h2>Course Completion Rate</h2>
                    <canvas id="courseCompletionChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

    @section('custom-js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset('js/dash-analysis.js')}}"></script>
    @endsection
@endsection
