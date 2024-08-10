<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Associeragent;
use App\Providers\GiwuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GiwuMiddleware
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
        if (!session('InfosRole')) {
            Auth::logout();
            session()->flush();

            return redirect()->route('login');
        }
        GiwuService::BrowserControl();
        // /Application en cours de maintenance
        if(trans('data.maintenance') == "oui"){
            dd('Page en maintenance');
            // return Redirect::to('webmaint');
        }
        return $next($request);
    }
}
