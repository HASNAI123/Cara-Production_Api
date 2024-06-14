<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk_Prevention_Safety extends Model
{
    use HasFactory;

    protected $table = 'Risk_Prevention_Safety';

    protected $fillable = [
        'basicInfo',
        'Genneral_info',
        'victimData',
        'additionalTablesData1',
        'elaboration',
        'other_data'
    ];

    protected $casts = [
        'basicInfo' => 'array',
        'Genneral_info' => 'array',
        'victimData' => 'array',
        'additionalTablesData1' => 'array',
        'elaboration' => 'array',
        'other_data' => 'array',
    ];
}
