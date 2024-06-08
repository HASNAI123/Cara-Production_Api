<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeonFPCAudit extends Model
{
    use HasFactory;
    protected $table = 'AeonFPCAudit';

    protected $fillable = [
        'remark_data',
        'CreatorID',
        'CreatorName',
        'PreparorID',
        'PreparorName',
        'StoreCode',
    ];


    protected $casts = [
        'remark_data' => 'json',
    ];
}
