<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseSession extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = 'exercise_sessions';
}
