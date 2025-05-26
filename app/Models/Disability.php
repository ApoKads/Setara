<?php

namespace App\Models;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disability extends Model
{
    /** @use HasFactory<\Database\Factories\DisabilityFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function users(): BelongsToMany{
        return $this->belongsToMany(UserProfile::class,'disability_user_profile','disability_id','user_profile_id');
    }

    
}
