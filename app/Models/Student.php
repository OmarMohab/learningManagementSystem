<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'grade'
    ];

    public function user():MorphOne{
        return $this->morphOne(User::class, 'userable');
    }
}
