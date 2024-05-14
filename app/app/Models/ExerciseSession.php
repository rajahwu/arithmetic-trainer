<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseSession extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = 'exercise_sessions';
    protected $fillable = [
        'user_id',
        'type',
        'practice_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'is_completed'
    ];
}
