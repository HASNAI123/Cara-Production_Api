<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

     public $table="feedback";
     protected $fillable = ['user_id','user_name','business_unit','comments'];
}
