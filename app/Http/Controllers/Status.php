<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use \App\Http\Models\Status as ModelStatus;

class Status extends BaseController
{
    public function getStatus() {
        $status = new ModelStatus();
        $data = $status->get();

        if ($data) {
            return view('index', $data);
        } else {
            return 'No data';
        }
    }

    public function addStatus(Request $request) {
        $key = $request->input('key', '');
        $isp1 = $request->input('isp1', '');
        $isp2 = $request->input('isp2', '');

        if ($key == $_ENV['ROUTER_KEY'] && $isp1 != '' && $isp2 != '') {
            $status = new ModelStatus();
            $status->add($isp1, $isp2);
        }
        return '';
    }
}
