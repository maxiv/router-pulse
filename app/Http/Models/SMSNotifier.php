<?php

namespace App\Http\Models;

class SMSNotifier
{
    public function send($login, $password, $phones, $message) {
        $result = file_get_contents('https://smsc.ru/sys/send.php?login=' . urlencode($login) . '&psw=' . urlencode($password) . '&phones=' . urlencode($phones) . '&mes=' . urlencode($message));
        return $result;
    }
}
