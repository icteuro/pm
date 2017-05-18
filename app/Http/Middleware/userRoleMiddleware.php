<?php namespace App\Http\Middleware;

use Closure;

class userRoleMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	
		if(count($request->user()) > 0){
			if ($request->user()->user_role != 1)
	        {
	            return redirect('/');
	        }
	        else{
	        	return $next($request);
	        }
		}

		return redirect('auth/login');
	}

}
