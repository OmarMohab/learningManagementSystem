<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'teacher_id',
    ];

    public function user():MorphOne{
        return $this->morphOne(User::class, 'userable');
    }

    public function courses():HasMany
    {
        return $this->hasMany(Course::class);
    }
}
