<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'practices';
    protected $fillable = [ 
        'type',
        'title',
        'description',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function practiceProblemSets(): HasMany
    {
        return $this->hasMany(PracticeProblemSet::class, 'practice_id', 'id');
    }

}
