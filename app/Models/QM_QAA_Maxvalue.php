<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QM_QAA_Maxvalue extends Model
{
    use HasFactory;
    protected $table = 'QM_QAA_Maxvalue';

    protected $fillable = [
        'remark_data',
        'CreatorID',
        'CreatorName',
        'PreparorID',
        'PreparorName',
        'StoreCode',
        'Condition',
        'Expiry_content'
    ];


    protected $casts = [
        'remark_data' => 'json',
        'Expiry_content' => 'json'
    ];
}
