<?php namespace App\Http\Middleware;

use Closure;
use Input;
use DB;
use Redirect;

class TestMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if(!$request->session()->get('cl_admin')) {
			return redirect('login');
		}
		return $next($request);
	}


}
