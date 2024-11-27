<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeInstructorAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'be_instructor_question_id', 'answer'];

    public function question_to_instructor()
    {
        return $this->belongsTo(BeInstructorQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
