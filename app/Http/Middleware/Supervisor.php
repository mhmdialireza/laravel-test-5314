<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Supervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(auth()->user()->role != 1, Response::HTTP_UNAUTHORIZED);

        // if (auth()->user()->role != 1) {
        //     return redirect()->to(route('home'))->with('message', 'دسترسی غیر مجاز');
        // }
        return $next($request);
    }
}
