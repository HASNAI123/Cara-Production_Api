<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security_FPC extends Model
{
    use HasFactory;
    protected $table = 'Security_FPC';

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
