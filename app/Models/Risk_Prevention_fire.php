<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk_Prevention_fire extends Model
{
    use HasFactory;

    protected $table = 'Risk_Prevention_fire';

    protected $fillable = [
        'basicInfo',
        'Genneral_info',
        'victimData',
        'additionalTablesData1',
        'witnessData',
        'additionalTablesData2',
        'Case_status',
        'row',
        'other_data'
    ];

    protected $casts = [
        'basicInfo' => 'array',
        'Genneral_info' => 'array',
        'victimData' => 'array',
        'additionalTablesData1' => 'array',
        'witnessData' => 'array',
        'additionalTablesData2' => 'array',
        'Case_status' => 'array',
        'row' => 'array',
        'other_data' => 'array',
    ];
}
