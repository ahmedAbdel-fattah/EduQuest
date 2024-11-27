<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'course_id', 'video_id','updated_at','created_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function video() {
        return $this->belongsTo(Video::class);
    }
}
