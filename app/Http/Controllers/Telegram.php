<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Telegram extends BaseController
{
    public function webhook() {
	    $input = json_decode(file_get_contents("php://input"));

	    $telegram = new \App\Http\Models\Telegram(Settings::get('telegram_bot_key'));
	    $telegram->webhook($input);
    }

    public function sethook() {
	    $telegram = new \App\Http\Models\Telegram(Settings::get('telegram_bot_key'));
	    echo $telegram->setWebhook();
    }
}
