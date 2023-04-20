<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'grade_id'
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
    
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function assignments(): BelongsToMany
    {
        return $this->belongsToMany(Assignment::class)->withPivot('is_submitted')->withTimestamps();
    }
}
