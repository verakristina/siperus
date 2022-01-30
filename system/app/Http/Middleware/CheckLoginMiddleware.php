<?php namespace App\Http\Middleware;

use Closure;
use Input;
use DB;
use Redirect;

class CheckLoginMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if(!$request->session()->get('idLogin')) {
			return redirect('login');
		}
		return $next($request);
	}


}
