<?php

namespace App\Models;

use App\Models\Job;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_profile_id',
        'job_id',
        'note',
        'slug',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string', // <-- PERBAIKAN: Memastikan status selalu diperlakukan sebagai string
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

    public function scopeFilter(Builder $query, array $filters): void
    {
        // Filter by job name (relasi job)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereHas('job', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        });

        // Sort
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            if ($sort === 'newest') {
                $query->orderBy('updated_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('updated_at', 'asc');
            }
        });

        // Status (optional)
        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->where('status', $status);
        });
    }
}
