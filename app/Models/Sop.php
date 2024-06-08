<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $table = 'sop';

    protected $fillable = [
        'uploaded_by',
        'date',
        'sop_title',
        'business_unit',
        'Division',
        'Document_Category',
        'Reviewed_Year'
    ];
}
