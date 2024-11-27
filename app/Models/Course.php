<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
use HasFactory;

protected $fillable = [ 'user_id' , 'instructor_id' , 'category_id' ,'title', 'description' , 'category' , 'objectives', 'price', 'image',];
// protected $fillable = ['title','category_id', 'description', 'objectives', 'category', 'price', 'image', 'user_id'];

public function sections()
{
return $this->hasMany(Section::class);
}
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function instructor()
    {
        // return $this->belongsTo(Instructor::class,'user_id');
        return $this->belongsTo(Instructor::class,'instructor_id');
    }

    public function reviews()
    {
        // return $this->hasMany(Review::class, 'course_id');
        return $this->hasMany(Review::class, 'course_id', 'id');
    }
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_enrollments')
            ->withTimestamps(); // Links course with users via enrollments
    }
    public function progressForUser($userId)
    {
        return $this->hasMany(CourseProgress::class)
            ->where('user_id', $userId);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function courseDeclines()
    {
        return $this->hasMany(CourseDecline::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function course_category(){
        return $this->belongsTo(Category::class,'id');
    }
}
