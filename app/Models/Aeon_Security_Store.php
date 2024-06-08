<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aeon_Security_Store extends Model
{
    use HasFactory;
    protected $table = 'Aeon_Security_Store';

    protected $fillable = [
        'remark_data',
        'CreatorID',
        'CreatorName',
        'PreparorID',
        'PreparorName',
        'StoreCode',
        'Condition'
    ];


    protected $casts = [
        'remark_data' => 'json',
    ];
}
