<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Statistics extends BaseController
{
    public function getMonth() {
        $data = [];
        $data['sessions'] = [];

        $days = DB::select("SELECT DATE(session_started) as `date` FROM statuses GROUP BY DATE(session_started) ORDER BY session_started DESC LIMIT 30");
        foreach ($days as $day) {
            $sql = "SELECT id, isp1, isp2,
                    '" . $day->date . "' as day_begin,
                    '" . $day->date . " 23:59:59' as day_end,
                    IF (DATE(session_started - INTERVAL 1 MINUTE) = DATE(session_started), session_started, DATE(session_started)) as session_started,
                    IF (DATE(session_ended + INTERVAL 1 MINUTE) = DATE(session_ended), session_ended, DATE(session_ended) + INTERVAL 1 DAY - INTERVAL 1 SECOND) as session_ended
                    FROM statuses
                    WHERE DATE(session_started) = '" . $day->date . "'";

            $sessions = DB::select($sql);

            foreach ($sessions as &$session) {
                $session->day_begin = new \DateTime($session->day_begin);
                $session->day_end = new \DateTime($session->day_end);
                $session->session_started = new \DateTime($session->session_started);
                $session->session_ended = new \DateTime($session->session_ended);

                $session->percent_start = $this->getPercent($session->day_begin, $session->day_end, $session->session_started);
                $session->percent_width = $this->getPercent($session->day_begin, $session->day_end, $session->session_ended) - $session->percent_start;
            }

            $data['sessions'][$day->date] = $sessions;
        }

        return view('statistic', $data);
    }

    private function getPercent($begin, $end, $needle) {
        $end = $end->getTimestamp() - $begin->getTimestamp();
        $needle = $needle->getTimestamp() - $begin->getTimestamp();

        return $needle / $end * 100;
    }
}
