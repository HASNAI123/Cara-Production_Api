<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcknowledgmentArchive extends Model
{
    use HasFactory;
    protected $table = 'AcknowledgmentArchive';
    public $timestamps = false;

    protected $fillable = [
        'User_id',
        'user_name',
        'Terms_1',
        'Terms_2',
        'Date_Downloaded',
        'Type',
        'Sop_title'
    ];


}
