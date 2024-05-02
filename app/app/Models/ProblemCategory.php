<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'problem_categories';

}
