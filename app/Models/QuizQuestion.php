<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'content',
        'score',
        'quiz_id',
        'type'
    ];

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
