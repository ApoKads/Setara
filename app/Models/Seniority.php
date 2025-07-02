<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seniority extends Model
{
    /** @use HasFactory<\Database\Factories\SeniorityFactory> */
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'level'
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'seniority_id');
    }
}
