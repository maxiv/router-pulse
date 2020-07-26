<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Status
{
	private $_timeout = 90;

    public function get() {
        $data = [];

        $last = DB::select("SELECT *, UNIX_TIMESTAMP(session_started) as session_started_uts, UNIX_TIMESTAMP(session_ended) as session_ended_uts FROM statuses ORDER BY session_ended DESC LIMIT 2");
        if (sizeof($last)) {
            $td = time() - $last[0]->session_ended_uts;
            $online_need = (
                isset($last[1]) && (
                    ($last[0]->session_started_uts - $last[1]->session_ended_uts > $this->_timeout && (bool)$last[0]->isp1) ||
                    ((bool)$last[0]->isp1 && !(bool)$last[1]->isp1)
                )
            );

            $data['id']            = $last[0]->id;
            $data['session_ended'] = $last[0]->session_ended;
            $data['td']            = $td;
            $data['is_internet']   = $td < $this->_timeout;

            if (!$data['is_internet']) {
	            $data['is_isp1'] = $data['is_isp2'] = false;
            } else {
	            $data['is_isp1'] = (bool)$last[0]->isp1;
	            $data['is_isp2'] = (bool)$last[0]->isp2;
            }

            $data['sms_off_notified'] = (bool)$last[0]->sms_off_notified;
            $data['sms_on_notified'] = (bool)$last[0]->sms_on_notified;
            $data['sms_on_need'] = $online_need;

            $data['email_off_notified'] = (bool)$last[0]->email_off_notified;
            $data['email_on_notified'] = (bool)$last[0]->email_on_notified;
            $data['email_on_need'] = $online_need;

            $data['telegram_off_notified'] = (bool)$last[0]->telegram_off_notified;
            $data['telegram_on_notified'] = (bool)$last[0]->telegram_on_notified;
            $data['telegram_on_need'] = $online_need;

            $data['viber_off_notified'] = (bool)$last[0]->viber_off_notified;
            $data['viber_on_notified'] = (bool)$last[0]->viber_on_notified;
            $data['viber_on_need'] = $online_need;

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

            if ($session->delay < $this->_timeout && $session->new_day == '0' && $isp1 == $session->isp1 && $isp2 == $session->isp2) {
                DB::update("UPDATE statuses SET session_ended = NOW() WHERE id = '" . $session->id . "'");
                return '';
            }
        }
        DB::insert("INSERT INTO statuses (ip, isp1, isp2, session_started, session_ended) VALUES ('" . $this->getRealIP() . "', '" . (bool)$isp1 . "', '" . (bool)$isp2 . "', NOW(), NOW())");
    }

    public function recreate() {
        $last = DB::select("SELECT * FROM statuses ORDER BY session_ended DESC LIMIT 1");
        if (sizeof($last)) {
            $session = $last[0];

            DB::insert("INSERT INTO statuses (ip, isp1, isp2, session_started, session_ended) VALUES ('" . $session->ip . "', '" . $session->isp1 . "', '" . $session->isp2 . "', NOW(), NOW())");
        }
    }

    public function smsOfflineNotify($data) {
        $sms = new SMSNotifier();
        $sms->send(Setting::get('sms_login'), Setting::get('sms_password'), Setting::get('sms_off_to'), Setting::get('sms_off_message'));
        DB::update("UPDATE statuses SET sms_off_notified = 1 WHERE id = '" . $data['id'] . "'");
    }

    public function smsOnlineNotify($data) {
        $sms = new SMSNotifier();
        $sms->send(Setting::get('sms_login'), Setting::get('sms_password'), Setting::get('sms_on_to'), Setting::get('sms_on_message'));
        DB::update("UPDATE statuses SET sms_on_notified = 1 WHERE id = '" . $data['id'] . "'");
    }

    public function emailOfflineNotify($data) {
        $to = explode(',', Setting::get('email_off_to'));

        Mail::raw(Setting::get('email_off_message'), function($message) use ($to)
        {
            $message->from(Setting::get('email_from'), 'Pulse');
            $message->to($to);
            $message->subject(Setting::get('email_off_subject'));
        });
        
        DB::update("UPDATE statuses SET email_off_notified = 1 WHERE id = '" . $data['id'] . "'");
    }

    public function emailOnlineNotify($data) {
        $to = explode(',', Setting::get('email_on_to'));

        Mail::raw(Setting::get('email_on_message'), function($message) use ($to)
        {
            $message->from(Setting::get('email_from'), 'Pulse');
            $message->to($to);
            $message->subject(Setting::get('email_on_subject'));
        });

        DB::update("UPDATE statuses SET email_on_notified = 1 WHERE id = '" . $data['id'] . "'");
    }

	public function telegramOfflineNotify($data) {
		$telegram = new Telegram(Setting::get('telegram_bot_key'));

		$to = explode(',', Setting::get('telegram_off_to'));
		foreach ($to as $item) {
			$telegram->sendMessage($item, Setting::get('telegram_off_message'));
		}

		DB::update("UPDATE statuses SET telegram_off_notified = 1 WHERE id = '" . $data['id'] . "'");
	}

	public function telegramOnlineNotify($data) {
		$telegram = new Telegram(Setting::get('telegram_bot_key'));

		$to = explode(',', Setting::get('telegram_on_to'));
		foreach ($to as $item) {
			$telegram->sendMessage($item, Setting::get('telegram_on_message'));
		}

		DB::update("UPDATE statuses SET telegram_on_notified = 1 WHERE id = '" . $data['id'] . "'");
	}

    public function viberOfflineNotify($data) {
        $viber = new Viber(Setting::get('viber_bot_key'));

        $to = explode(',', Setting::get('viber_off_to'));
        foreach ($to as $item) {
            $viber->sendMessage($item, Setting::get('viber_off_message'));
        }

        DB::update("UPDATE statuses SET viber_off_notified = 1 WHERE id = '" . $data['id'] . "'");
    }

    public function viberOnlineNotify($data) {
        $viber = new Viber(Setting::get('viber_bot_key'));

        $to = explode(',', Setting::get('viber_on_to'));
        foreach ($to as $item) {
            $viber->sendMessage($item, Setting::get('viber_on_message'));
        }

        DB::update("UPDATE statuses SET viber_on_notified = 1 WHERE id = '" . $data['id'] . "'");
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
