<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id',
        'course_id',
        'instructor_id',
        'rate',
        'comment',
    ];

    use HasFactory;

    public function user(){
        // return $this->hasMany(User::class,'user_id');
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course(){
        // return $this->hasMany(Course::class,'course_id');
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}
