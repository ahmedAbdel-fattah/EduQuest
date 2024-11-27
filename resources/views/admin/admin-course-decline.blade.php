<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Course Decline</title>
    <link rel="stylesheet" href="{{asset('css/get-account.css')}}">
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Decline Course</h1>
        <div class="buttons">
            <form action="{{ route('admin.submit.decline') }}" method="POST">
                @csrf
                <input type="text" id="user_id" name="user_id" value="{{ $userId }}" hidden>
                <input type="text" id="course_id" name="course_id" value="{{ $courseId }}" hidden>
                <label for="decline_reason">Decline Reason:</label>
                <textarea id="decline_reason" name="decline_reason" rows="5" placeholder="Enter your reason for declining the course..."></textarea>
                <button type="submit" class="btn">Confirm</button>
                <a href="{{route('declined-courses')}}" class="btn btn-outline">Cancel</a>
            </form>

        </div>
    </div>
</div>
</body>
</html>
