<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Http\Models\Status as ModelStatus;
use \App\Http\Models\Setting;

class Scheduler extends BaseController
{
    public function run() {
        // SMS
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

        // E-mail
        if (Setting::get('email_off_enabled', '0') != '0') {
            $status = new ModelStatus();
            $data = $status->get();

            if (!$data['is_internet'] && !$data['email_off_notified']) {
                $status->emailOfflineNotify($data);

                if (Setting::get('email_off_enabled', '0') == '2') {
                    Setting::set('email_off_enabled', '0');
                }
            }
        }

        if (Setting::get('email_on_enabled', '0') != '0') {
            $status = new ModelStatus();
            $data = $status->get();

            if ($data['is_internet'] && !$data['email_on_notified'] && $data['email_on_need']) {
                $status->emailOnlineNotify($data);

                if (Setting::get('email_on_enabled', '0') == '2') {
                    Setting::set('email_on_enabled', '0');
                }
            }
        }
        
	    // Telegram
	    if (Setting::get('telegram_off_enabled', '0') != '0') {
		    $status = new ModelStatus();
		    $data = $status->get();

		    if (!$data['is_internet'] && !$data['telegram_off_notified']) {
			    $status->telegramOfflineNotify($data);

			    if (Setting::get('telegram_off_enabled', '0') == '2') {
				    Setting::set('telegram_off_enabled', '0');
			    }
		    }
	    }

	    if (Setting::get('telegram_on_enabled', '0') != '0') {
		    $status = new ModelStatus();
		    $data = $status->get();

		    if ($data['is_internet'] && !$data['telegram_on_notified'] && $data['telegram_on_need']) {
			    $status->telegramOnlineNotify($data);

			    if (Setting::get('telegram_on_enabled', '0') == '2') {
				    Setting::set('telegram_on_enabled', '0');
			    }
		    }
	    }
    }
}
