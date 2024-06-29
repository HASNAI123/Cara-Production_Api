<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop extends Model
{

    use SoftDeletes;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
