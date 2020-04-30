<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Http\Models\Setting;

class Viber extends BaseController
{
    public function webhook() {
        $input = json_decode(file_get_contents("php://input"));

        $viber = new \App\Http\Models\Viber(Setting::get('viber_bot_key'));
        $viber->webhook($input);
    }

}