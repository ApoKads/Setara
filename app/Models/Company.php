<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'path_banner',
        'path_logo',
        'location'
    ];
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany{
        return $this->hasMany(Job::class,'company_id');
    }

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class,'category_company','company_id','category_id');
    }
}
