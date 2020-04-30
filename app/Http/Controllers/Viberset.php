<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Http\Models\Setting;

class Viberset extends BaseController
{
    public function sethook() {
        $viber = new \App\Http\Models\Viberset(Setting::get('viber_bot_key'));
        var_dump($viber->setWebhook());
    }
}