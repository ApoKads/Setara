<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disability;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'about'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function disabilities():BelongsToMany{
        return $this->belongsToMany(Disability::class,'disability_user_profile','user_profile_id','disability_id');
    }
    
}
