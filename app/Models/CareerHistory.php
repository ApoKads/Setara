<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHistory extends Model
{
    protected $fillable = [
        'applicant_id',
        'job_title',
        'company',
        'start_date',
        'end_date',
        'job_description'
    ];

    // Relasi dengan Applicant
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
