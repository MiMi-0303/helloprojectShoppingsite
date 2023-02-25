<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    //public $timestamps =false;
    protected $table = 'credit';
    protected $fillable = ['user_id','number','expire_y','expire_m','name'];

}
