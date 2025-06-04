<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobType extends Model
{
    /** @use HasFactory<\Database\Factories\JobTypeFactory> */
    use HasFactory;

    protected $fillable = [
    'name'
    ];

    public function jobs(): HasMany{
        return $this->hasMany(Job::class,'job_type_id');
    }
}
