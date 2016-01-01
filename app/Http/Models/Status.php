<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Status
{
    public function get() {
        $data = [];

        $last = DB::select("SELECT *, UNIX_TIMESTAMP(session_ended) as session_ended_uts FROM statuses ORDER BY session_ended DESC LIMIT 1");
        if (sizeof($last)) {
            $td = time() - $last[0]->session_ended_uts;

            $data['session_ended'] = $last[0]->session_ended;
            $data['td']            = $td;
            $data['is_internet']   = $td < 120;

            $data['is_isp1'] = (bool)$last[0]->isp1;
            $data['is_isp2'] = (bool)$last[0]->isp2;
            $data['is_sms_notified'] = (bool)$last[0]->sms_notified;

            return $data;
        } else {
            return false;
        }
    }

    public function add($isp1, $isp2) {
        $last = DB::select("
            SELECT *,
                UNIX_TIMESTAMP(session_started) as session_started_uts,
                UNIX_TIMESTAMP(session_ended) as session_ended_uts,
                UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(session_ended) as delay,
                IF(DATE(session_ended) < CURRENT_DATE(), 1, 0) as new_day
            FROM statuses
            ORDER BY session_ended DESC LIMIT 1");
        if (sizeof($last)) {
            $session = $last[0];

            if ($session->delay < 120 && $session->new_day == '0' && $isp1 == $session->isp1 && $isp2 == $session->isp2) {
                DB::update("UPDATE statuses SET session_ended = NOW() WHERE id = '" . $session->id . "'");
                return '';
            }
        }
        DB::insert("INSERT INTO statuses (ip, isp1, isp2, session_started, session_ended) VALUES ('" . $this->getRealIP() . "', '" . (bool)$isp1 . "', '" . (bool)$isp2 . "', NOW(), NOW())");
    }

    private function getRealIP() {
        $result = array();

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $result = explode(',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
        } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $result[] = $_SERVER['HTTP_X_REAL_IP'];
        } else {
            $result[] = $_SERVER["REMOTE_ADDR"];
        }

        return trim($result[0]);
    }
}
