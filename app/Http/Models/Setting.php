<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $primaryKey = 'key';
	public $timestamps = false;

	static private $cache = null;

	static public function get($key, $default = '') {
		if (!self::$cache) {
			self::loadCache();
		}

		if (isset(self::$cache[$key])) {
			return self::$cache[$key];
		}

		return $default;
	}

	static public function set($key, $value) {
		if (!self::$cache) {
			self::loadCache();
		}

		self::$cache[$key] = $value;

		$setting = Setting::find($key);
		if (!$setting) {
			$setting = new Setting;
			$setting->key = $key;
		}
		$setting->value = $value;

		$setting->save();
	}

	static public function getAll() {
		if (!self::$cache) {
			self::loadCache();
		}

		return self::$cache;
	}

	static private function loadCache() {
		self::$cache = [];

		$settings = Setting::all();
		foreach ($settings as $setting) {
			self::$cache[$setting->key] = $setting->value;
		}
	}
}
