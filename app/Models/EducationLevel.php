<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationLevel extends Model
{
    /** @use HasFactory<\Database\Factories\EducationLevelFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    public function jobs(): HasMany{
        return $this->hasMany(Job::class,'education_level_id');
    }
}
