@extends('admin.layouts.dash')
@section('dashboard')
    active
@endsection
@section('activity-title')
    Latest Activities
@endsection
@section('content')
        <!-- Recent Activity -->




        <table class="styled-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>User Id</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="activity-table-body">
                @foreach($activities as $activity) <!-- عرض أول 6 رسائل فقط -->
                    <tr class="course_item">
                        <td>{{ $activity->created_at }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->user->id }}</td>
                        @if ($activity->status=='Completed')
                            <td><span class="status success">{{ $activity->status }}</span></td>
                        @elseif ($activity->status=='Failed')
                            <td><span class="status" style="background-color: rgb(238, 43, 43); color:white;">{{ $activity->status }}</span></td>
                        @endif
                        <td>
                            <form action="{{ route('delete_activity', $activity->id) }}" onsubmit="return confirmDelete()" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="remove"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                    <form action="{{ route('delete_activity_all') }}" onsubmit="return confirmDelete()" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete All</button>
                    </form>

            </tbody>
        </table>

        <!-- زر "Show More" لعرض الرسائل المتبقية -->
        @if ($activities->count() > 6)
            <button id="show-more" class="btn btn-primary">Show More</button>
        @endif


        <script>
// استهداف العناصر
let showMoreBtn = document.getElementById('show-more');
let rows = document.querySelectorAll('.course_item');
let limit = 6; // عدد الرسائل التي تظهر في البداية

// إخفاء الرسائل التي تتجاوز العدد المطلوب
function showMoreRows() {
    for (let i = limit; i < rows.length; i++) {
        rows[i].style.display = 'table-row'; // إظهار الصفوف المخفية
    }
    showMoreBtn.style.display = 'none'; // إخفاء الزر بعد الضغط عليه
}

// إخفاء الصفوف التي تتجاوز العدد المطلوب (6)
function hideExcessRows() {
    for (let i = limit; i < rows.length; i++) {
        rows[i].style.display = 'none'; // إخفاء الصفوف المخفية
    }
}

document.addEventListener('DOMContentLoaded', hideExcessRows); // إخفاء الصفوف في البداية

// إضافة حدث عند الضغط على زر "Show More"
if (showMoreBtn) {
    showMoreBtn.addEventListener('click', showMoreRows);
}

        </script>
@endsection
