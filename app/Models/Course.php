<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    public function teacher():BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    protected $fillable = [
        'id',
        'name',
        'description',
        'teacher_id',
        'grade'
    ];
}
