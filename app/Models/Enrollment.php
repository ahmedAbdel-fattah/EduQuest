<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id'); // Enrollment belongs to a student (user)
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // Enrollment belongs to a course
    }
}
