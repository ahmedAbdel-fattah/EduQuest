<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDecline extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'course_declines';

    // Fields that are mass assignable
    protected $fillable = ['user_id', 'course_id', 'decline_reason'];

    /**
     * Get the user that declined the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that was declined.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
