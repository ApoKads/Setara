<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryCompany extends Pivot
{
    //

    use HasFactory;

    protected $fillable = [
        'category_id',
        'company_id',
    ];

}




