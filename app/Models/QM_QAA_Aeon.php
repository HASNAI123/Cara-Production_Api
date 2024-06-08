<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QM_QAA_Aeon extends Model
{
    use HasFactory;
    protected $table = 'QM_QAA_Aeon';

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
