@extends('admin.layouts.dash')

@section('settings')
    active
@endsection
@section('activity-title')
create setting
@endsection
@section('content')
@php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp

<body id="welcome">
    <!-- Main Wrapper -->
    <div id="main-wrapper">
        <div class="main-content">

            <!-- Add Contact Info Section -->
            <section id="add-contact-info">
                <div class="content-header">
                    <h1>Add Contact Info</h1>
                </div>
                <form action="{{ route('settings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    </div>
                    <div class="form-actions">

                        <button type="submit" class="submit-btn">Add</button>
                        <button type="reset" class="reset-btn">reset</button>
                    </div>
                </form>
            </section>

        </div>
    </div>

</body>
@endsection
