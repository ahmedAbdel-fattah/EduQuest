<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'question', 'correct_answer'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class, 'question_id');
    }
}
