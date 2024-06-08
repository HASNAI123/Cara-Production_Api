<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkSAB extends Model
{
    use HasFactory;
    protected $table = 'SABchecklist';

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
