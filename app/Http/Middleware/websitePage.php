<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\settings;

class websitePage
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
        \Illuminate\Support\Facades\View::share('setting', settings::first());
        return $next($request);
    }
}
