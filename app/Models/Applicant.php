<?php

namespace App\Models;

use App\Models\Job;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory;
    protected $fillable = [
        'user_profile_id',
        'job_id',
        'note',
        'slug'
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'applicant_skills');
    }

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class);
    }
}
