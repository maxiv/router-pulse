<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Http\Models\Status as ModelStatus;
use \App\Http\Models\SMSNotifier;

class Scheduler extends BaseController
{
    public function run() {
        if ($_ENV['SMS_ENABLED'] == 'true') {
            $status = new ModelStatus();
            $data = $status->get();

            if (!$data['is_internet'] && !$data['is_sms_notified']) {
                $status->smsNotify($data);
            }
        }
    }
}
