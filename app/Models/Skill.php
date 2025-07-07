<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'score'];

    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'skill_user_profile')
            ->withPivot('score')
            ->withTimestamps();
    }
}
