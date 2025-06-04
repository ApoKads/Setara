<?php

namespace App\Models;

use App\Models\Company;
use App\Models\JobType;
use App\Models\Location;
use App\Models\Disability;
use App\Models\EducationLevel;
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
    'job_type_id',
    'location_id',
    'education_level_id',
    'slug',
    'company_id',  // foreign key
    'name',        // string
    'description', // string
    'wage',       // float
    'location',
    'disability_id'
        // string

    ];

    public function company():BelongsTo{
        return $this->belongsTo(Company::class,'company_id');
    }

    public function applicant():HasOne{
        return $this->hasOne(Applicant::class,'job_id');
    }

    public function JobType():BelongsTo{
        return $this->belongsTo(JobType::class,'job_type_id');
    }
    public function location():BelongsTo{
        return $this->belongsTo(Location::class,'location_id');
    }
    public function EducationLevel():BelongsTo{
        return $this->belongsTo(EducationLevel::class,'education_level_id');
    }
    public function disability():BelongsTo{
        return $this->belongsTo(Disability::class,'disability_id');
    }
}
