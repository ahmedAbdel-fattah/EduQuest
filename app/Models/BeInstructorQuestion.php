<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeInstructorQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question_title', 'choice1', 'choice2', 'choice3'];


    public function answers()
    {
        return $this->hasMany(BeInstructorAnswer::class);
    }
}
