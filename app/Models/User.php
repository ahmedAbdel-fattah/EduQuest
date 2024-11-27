<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_instructor',
        'profile_photo_path',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    // public function courses()
    // {
    //     // return $this->hasMany(Course::class, 'user_id');
    //     return $this->hasManyThrough(Course::class, Instructor::class, 'user_id', 'user_id');
    // }

    // public function instructors()
    // {
    //     return $this->hasOne(Instructor::class, 'user_id');
    // }

    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function instructors()
    {
        return $this->hasOne(Instructor::class, 'user_id');
    }

    public function reviews()
    {
        // return $this->hasMany(Review::class, 'user_id');
        return $this->hasMany(Review::class, 'user_id', 'id');
    }




    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_enrollments')
            ->withTimestamps(); // Links user with courses via enrollments
    }
    public function progress()
    {
        return $this->hasMany(CourseProgress::class);
    }
    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
