<?php

namespace App\Models;

use App\Models\Company;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    protected $fillable = [
    'user_profile_id',
    'company_id',  // foreign key
    'name',        // string
    'description', // string
    'wage',       // float
    'location'    // string
    ];

    public function company():BelongsTo{
        return $this->belongsTo(Company::class,'company_id');
    }
    public function user():BelongsTo{
        return $this->belongsTo(UserProfile::class,'user_profile_id');
    }
}
