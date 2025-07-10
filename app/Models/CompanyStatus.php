<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'position'
    ];

    public function company(): BelongsTo
{
    return $this->belongsTo(Company::class, 'company_id');
}

}
