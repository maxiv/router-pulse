<?php

namespace App\Http\Models;

class Viber
{
    private $_key;
    private $_url;

    public function __construct($key)
    {
        $this->_key = $key;
        $this->_url = 'https://chatapi.viber.com/pa/send_message';
    }

    public function sendMessage($to, $message)
    {
        $viber_id = $this->getChatId($to);
        if (!$viber_id) {
            return false;
        }

        $data = [
            'receiver' => $viber_id,
            'type' => 'text',
            'text' => $message,
            'auth_token' => $this->_key
        ];

        $result = $this->send($data);
    }

    public function webhook($data)
    {

        if (!isset($data->message)) {
            return true;
        }

        $tu = ViberUser::where('viber_id', $data->sender->id)->first();
        if (!$tu) {
            $tu = ViberUser::create([
                'viber_id' => $last->sender->id,
            ]);
            $tu->save();
        }

        $this->sendMessage($data->sender->id, 'Insert in OFFLINE(ONLINE) Message to: ' . $tu->viber_id);

        return true;
    }

    private function send($data = array())
    {
        try {
            $options = array(
                'http' => array(
                    'header'  => "Content-Type:application/json",
                    'method'  => 'POST',
                    'content' => json_encode($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($this->_url, false, $context);
            if ($result === false) {
                return false;
            }

            return json_decode($result);
        } catch (\Exception $e) {
            return false;
        }
    }

    private function getChatId($viber_id)
    {
        $result = ltrim(trim($viber_id));

        if (($result)) {
            $tu = ViberUser::where('viber_id', $result)->first();
            if (!$tu) {
                return false;
            }

            $result = $tu->viber_id;
        }

        return $result;
    }
}
