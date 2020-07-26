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
		$chat_id = $this->getChatId($to);
		if (!$chat_id) {
			return false;
		}

        $data = [
        	'chat_id' => $chat_id,
	        'text' => $message,
        ];

		$this->send('sendMessage', $data);
    }

	public function setWebhook()
	{
        $data = [
        	'url' => route('telegram_webhook'),
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

        $this->sendMessage($data->message->chat->id, 'Insert in OFFLINE(ONLINE) Message to: ' . $tu->chat_id . ' or @' . $tu->username);

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

        $this->sendMessage($data->message->chat->id, 'Insert in OFFLINE(ONLINE) Message to: ' . $tu->chat_id . ' or @' . $tu->username);

		return true;
	}

    private function get($method)
    {
	    try {
		    $result = file_get_contents($this->_url . $method);
		    if ($result === false) {
		        return false;
		    }

		    return json_decode($result);
	    } catch (\Exception $e) {
		    return false;
	    }
    }

	private function send($method, $data)
	{
		try {
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
		} catch (\Exception $e) {
			return false;
		}
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
