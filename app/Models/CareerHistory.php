<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_title',
        'company_name',
        'start_date',
        'end_date',
        'description',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
