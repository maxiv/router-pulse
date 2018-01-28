<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends \Laravel\Lumen\Http\Middleware\VerifyCsrfToken {

	protected $except_urls = [
		'telegram/webhook',
	];

	public function handle($request, Closure $next)
	{
		$regex = '#' . implode('|', $this->except_urls) . '#';

		if ($this->isReading($request) || $this->tokensMatch($request) || preg_match($regex, $request->path()))
		{
			return $this->addCookieToResponse($request, $next($request));
		}

		throw new TokenMismatchException;
	}

}