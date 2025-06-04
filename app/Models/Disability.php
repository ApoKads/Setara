<?php

namespace App\Models;

use App\Models\Job;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disability extends Model
{
    /** @use HasFactory<\Database\Factories\DisabilityFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function profiles(): BelongsToMany{
        return $this->belongsToMany(UserProfile::class,'disability_user_profile','disability_id','user_profile_id');
    }

    public function jobs(): HasMany{
        return $this->hasMany(Job::class,'disability_id');
    }
    
}
