<?php

namespace App\Http\Models;

class Telegram
{
	private $_key;
	private $_url;

	public function __construct($key)
	{
		$this->_key = $key;
		$this->_url = 'https://api.telegram.org/bot' . $this->_key . '/';
	}

	public function sendMessage($to, $message)
	{
        $data = [
        	'chat_id' => $this->getChatId($to),
	        'text' => $message,
        ];

		$this->send('sendMessage', $data);
    }

	public function setWebhook()
	{
        $data = [
        	'url' => route('telegram_sethook'),
        ];

		return $this->send('setWebhook', $data);
    }

	public function webhook($data)
	{
		if (!isset($data->message)) {
			return false;
		}
		
		$tu = TelegramUser::where('username', $data->message->chat->username)->first();
		if (!$tu) {
			$tu = TelegramUser::create([
				'chat_id' => $data->message->chat->id,
				'username' => $data->message->chat->username,
			]);
			$tu->save();
		}

		$this->sendMessage($data->message->chat->id, 'ok');

		return true;
	}

	// For test purpose
	public function getUpdates()
	{
		$result = $this->get('getUpdates');
		if ($result === false) {
			return $result;
		}

		$last = end($result->result);
		$tu = TelegramUser::where('username', $last->message->chat->username)->first();
		if (!$tu) {
			$tu = TelegramUser::create([
				'chat_id' => $last->message->chat->id,
				'username' => $last->message->chat->username,
			]);
			$tu->save();
		}

		$this->sendMessage($last->message->chat->id, 'ok');

		return true;
	}

    private function get($method)
    {
	    $result = file_get_contents($this->_url . $method);
	    if ($result === false) {
	    	return false;
	    }

	    return json_decode($result);
    }

	private function send($method, $data)
	{
	    $options = array(
		    'http' => array(
			    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			    'method'  => 'POST',
			    'content' => http_build_query($data)
		    )
	    );
	    $context = stream_context_create($options);
	    $result = file_get_contents($this->_url . $method, false, $context);
	    if ($result === false) {
	    	return false;
	    }

	    return json_decode($result);
    }

    private function getChatId($username)
    {
    	$result = ltrim(trim($username), '@');

	    if (!is_numeric($result)) {
		    $tu = TelegramUser::where('username', $result)->first();
		    if (!$tu) {
		    	return false;
		    }

		    $result = $tu->chat_id;
	    }

	    return $result;
    }
}