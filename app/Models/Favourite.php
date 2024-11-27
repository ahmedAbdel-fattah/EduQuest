<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id'];

    // Define relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
