<?php

namespace App\Http\Models;

class Viberset
{
    private $_key;
    private $_url;

    public function __construct($key)
    {
        $this->_key = $key;
        $this->_url = 'https://chatapi.viber.com/pa/set_webhook';
    }

    public function setWebhook()
    {
        $data = [
            'url' => route('viber_webhook'),
            'auth_token' => $this->_key
        ];

        return $this->send($data);
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

}