<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    protected $table = 'student_quiz';

    protected $fillable = [
        'quiz_id',
        'student_score',
    ];
}
