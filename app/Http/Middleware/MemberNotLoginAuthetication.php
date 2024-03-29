<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberNotLoginAuthetication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !Auth::check() ){
            return $next($request);
        }else{
			return redirect()->back()->withErrors(['error' => 'Please try again!']);
        }
    }
}



// postman dung de test api
// viet api, e muon kiem tra dung hay sai.