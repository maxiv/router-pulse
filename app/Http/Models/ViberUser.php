<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ViberUser extends Model
{
    protected $fillable = ['viber_id'];
    public $timestamps = false;
}