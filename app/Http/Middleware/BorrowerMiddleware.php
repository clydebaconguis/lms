<?php

namespace App\Http\Middleware;

use Closure;

class BorrowerMiddleware
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
        if (auth()->check() && auth()->user()->type == 7) {
            return $next($request);
        }

        // If not an admin, you can redirect or perform other actions
        return redirect('/home'); // Redirect to home or another route
    }
}
