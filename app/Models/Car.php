<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    use HasFactory;
    protected $table = 'CarForm';

    protected $fillable = [
        'NonConformity',
        'DetailsNonConformity',
        'description3',
        'description4',
        'description5',
        'description6',
        'description7',
        'description8',
        'checklist_type',
        'selected_radio',
    ];
}
