<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirm Enrollment</title>
    <link rel="stylesheet" href="{{asset('css/get-account.css')}}">
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Confirm Enrollment</h1>
        <div class="buttons">
            <form method="post" action="{{route('free.enroll')}}">
                @csrf
                <input type="number" value="{{$id}}" hidden readonly name="id">
                <button type="submit" class="btn">Confirm</button>
            </form>
            <a href="{{route('course_details',$id)}}" class="btn btn-outline">Cancel</a>
        </div>
    </div>
</div>
</body>
</html>
