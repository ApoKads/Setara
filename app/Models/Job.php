<?php

namespace App\Models;

use App\Models\Company;
use App\Models\JobType;
use App\Models\Location;
use App\Models\Disability;
use App\Models\Seniority;
use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'seniority_id',
        'slug',
        'company_id',
        'name',
        'description',
        'wage',
        'location',
        'disability_id',
        'slot',
        'work_mode',
        'work_location_type'
    ];
    protected $with = ['company', 'JobType', 'location', 'EducationLevel', 'disability', 'seniority'];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function applicant(): HasMany
    {
        return $this->hasMany(Applicant::class, 'job_id');
    }

    public function JobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function EducationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }
    public function disability(): BelongsTo
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }

    public function seniority(): BelongsTo
    {
        return $this->belongsTo(Seniority::class, 'seniority_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        // $query->when($filters['category'] ?? false, function($query, $categoryId) {
        // $query->whereHas('categories', function($q) use ($categoryId) {
        //     $q->where('categories.id', $categoryId); // Filter berdasarkan ID category
        //     });
        // });

        $query->when($filters['disability'] ?? false, function ($query, $disabilityId) {
            $query->where('disability_id', $disabilityId);
        });

        $query->when($filters['job_type'] ?? false, function ($query, $jobTypeId) {
            $query->where('job_type_id', $jobTypeId);
        });

        $query->when($filters['salary'] ?? false, function ($query, $salaryStart) {
            $salaryStart = (int) $salaryStart; // Cast to integer for numerical comparison

            if ($salaryStart === 1) {
                $query->whereBetween('wage', [0, 5000000]);
            } elseif ($salaryStart === 5000001) {
                $query->whereBetween('wage', [5000001, 10000000]);
            } elseif ($salaryStart === 10000001) {
                $query->whereBetween('wage', [10000001, 20000000]);
            } elseif ($salaryStart === 20000001) {
                $query->where('wage', '>=', 20000001);
            }
            // Add more conditions here if you add more salary ranges
        });

        $query->when($filters['work_mode'] ?? false, function ($query, $workMode) {
            if ($workMode === 'Onsite') {
                // If 'Onsite' is selected, show 'Onsite' jobs AND 'Onsite & Remote' jobs
                $query->where(function ($q) {
                    $q->where('work_mode', 'Onsite')
                        ->orWhere('work_mode', 'Onsite & Remote');
                });
            } elseif ($workMode === 'Remote') {
                // If 'Remote' is selected, show 'Remote' jobs AND 'Onsite & Remote' jobs
                $query->where(function ($q) {
                    $q->where('work_mode', 'Remote')
                        ->orWhere('work_mode', 'Onsite & Remote');
                });
            }
            // If $workMode is empty (default option 'Onsite & Remote'),
            // this 'when' block won't execute, meaning no work_mode filter is applied,
            // which effectively shows all work modes (Onsite, Remote, and Onsite & Remote).
        });

        $query->when($filters['location'] ?? false, function ($query, $locationId) {
            $query->where('location_id', $locationId);
        });

        $query->when($filters['education_level'] ?? false, function ($query, $educationId) {
            $query->where('education_level_id', $educationId);
        });

        $query->when($filters['seniority'] ?? false, function ($query, $seniorityId) {
            $query->where('seniority_id', $seniorityId);
        });
        // $query->when(
        //     $filters['category'] ?? false, function($query,$category){
        //         $query->whereHas('categories',fn($query)=> $query->where('categories.id',$category));
        //     }
        // );

    }
}
