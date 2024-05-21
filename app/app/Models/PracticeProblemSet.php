<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class PracticeProblemSet extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'practice_problem_sets';
    protected $fillable = [
        'practice_id',
        'problem_id' 
    ];

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class, 'problem_id', 'id');
    }
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Practice::class, 'practice_id', 'id');
    }
    
   

}
