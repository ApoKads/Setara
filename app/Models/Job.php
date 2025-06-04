<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    protected $fillable = [
    'user_profile_id',
    'slug',
    'company_id',  // foreign key
    'name',        // string
    'description', // string
    'wage',       // float
    'location'    // string

    ];

    public function company():BelongsTo{
        return $this->belongsTo(Company::class,'company_id');
    }

    public function applicant():HasOne{
        return $this->hasOne(Applicant::class,'job_id');
    }

}
