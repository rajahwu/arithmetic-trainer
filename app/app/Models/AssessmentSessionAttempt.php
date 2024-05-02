<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentSessionAttempt extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'assessment_session_attempts';

}
