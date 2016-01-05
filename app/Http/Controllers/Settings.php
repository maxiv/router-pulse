<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use \App\Http\Models\Setting;

class Settings extends BaseController
{
    public function index() {
        $data = Setting::getAll();
        foreach ($data as $key => $value) {
            $data[$key] = old($key, $value);
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

        return redirect('/settings')
            ->withSuccess('Settings saved');
    }
}
