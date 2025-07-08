<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'about',
        'description',
        'user_id',
        'slug',
        'job_status',
        'profile_image',
        'quote',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function disabilities(): BelongsToMany
    {
        return $this->belongsToMany(Disability::class, 'disability_user_profile', 'user_profile_id', 'disability_id');
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class, 'user_profile_id');
    }

    public function careerHistories()
    {
        return $this->hasMany(CareerHistory::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user_profile')
            ->withPivot('score')
            ->withTimestamps();
    }

    // Periksa apakah ada file gambar di database
    public function getImageUrlAttribute(): string
    {

        if ($this->profile_image && Storage::disk('public')->exists('profile_images/' . $this->profile_image)) {
            return asset('storage/profile_images/' . $this->profile_image);
        }
        return asset('images/defaultProfile.jpg');
    }
}
