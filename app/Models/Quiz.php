<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $table = 'quizes';

    protected $fillable = [
        'title',
        'start_date',
        'course_id',
        'end_date'
    ];

    public function quiz_question(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
