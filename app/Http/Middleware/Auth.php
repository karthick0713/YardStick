<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{

    public function handle(Request $request, Closure $next)
    {
        if (session('userId') != null) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
