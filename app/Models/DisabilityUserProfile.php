<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisabilityUserProfile extends Pivot
{
    //
    use HasFactory;
    protected $table = 'disability_user_profile';
    protected $fillable = ['disability_id', 'user_profile_id'];
}


