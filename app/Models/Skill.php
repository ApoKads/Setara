<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    // Relasi dengan pengguna atau applicant
    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'applicant_skills');
    }
}
