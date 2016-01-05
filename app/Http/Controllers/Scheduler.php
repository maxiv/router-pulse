<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Http\Models\Status as ModelStatus;
use \App\Http\Models\Setting;

class Scheduler extends BaseController
{
    public function run() {
        if (Setting::get('sms_off_enabled', '0') != '0') {
            $status = new ModelStatus();
            $data = $status->get();

            if (!$data['is_internet'] && !$data['sms_off_notified']) {
                $status->smsOfflineNotify($data);

                if (Setting::get('sms_off_enabled', '0') == '2') {
                    Setting::set('sms_off_enabled', '0');
                }
            }
        }

        if (Setting::get('sms_on_enabled', '0') != '0') {
            $status = new ModelStatus();
            $data = $status->get();

            if ($data['is_internet'] && !$data['sms_on_notified'] && $data['sms_on_need']) {
                $status->smsOnlineNotify($data);

                if (Setting::get('sms_on_enabled', '0') == '2') {
                    Setting::set('sms_on_enabled', '0');
                }
            }
        }
    }
}
