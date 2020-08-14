<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('locale') !== app()->getLocale()) {
            app()->setLocale(Session::get('locale', app()->getLocale()));
        }

        return $next($request);
    }
}
