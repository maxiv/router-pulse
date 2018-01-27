<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
	protected $fillable = ['chat_id', 'username'];
	public $timestamps = false;
}
