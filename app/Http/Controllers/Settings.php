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

            Setting::set($key, $value);
        }

        $status = new Status();
        $status->recreate();

        return redirect('/settings')
            ->withSuccess('Settings saved');
    }
}
