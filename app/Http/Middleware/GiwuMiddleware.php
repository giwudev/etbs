<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use App\Providers\GiwuService;
use App\Models\Associeragent;

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
            return redirect()->route('logout');
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
