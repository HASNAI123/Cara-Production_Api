<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'logged_in_at',
    ];

    public $timestamps = true;

    // You can also define relationships, if necessary
    
}
