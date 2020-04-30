<?php

namespace App\Http\Controllers;

use App\Http\Models\Status;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use \App\Http\Models\Setting;

class Settings extends BaseController
{
    public function index() {
        $settings = [
            'sms_off_enabled',
            'sms_off_to',
            'sms_off_message',
            'sms_on_enabled',
            'sms_on_to',
            'sms_on_message',
            'sms_login',

            'email_off_enabled',
            'email_off_to',
            'email_off_subject',
            'email_off_message',
            'email_on_enabled',
            'email_on_to',
            'email_on_subject',
            'email_on_message',
            'email_from',

	        'telegram_bot_key',
	        'telegram_off_enabled',
	        'telegram_off_to',
	        'telegram_off_message',
			'telegram_on_enabled',
	        'telegram_on_to',
	        'telegram_on_message',

            'viber_bot_key',
            'viber_off_enabled',
            'viber_off_to',
            'viber_off_message',
            'viber_on_enabled',
            'viber_on_to',
            'viber_on_message',
        ];

        foreach ($settings as $key) {
            $data[$key] = old($key, Setting::get($key));
        }

        return view('settings', $data);
    }

    public function store(Request $request) {
        foreach ($request->all() as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            if ($key == 'sms_password' && $value == '') {
                continue;
            }
            if ($key == 'telegram_bot_key' && $value == '') {
                continue;
            }
            if ($key == 'viber_bot_key' && $value == '') {
                continue;
            }

            Setting::set($key, $value);
        }

        $status = new Status();
        $status->recreate();

        return redirect('/settings')
            ->withSuccess('Settings saved');
    }
}
