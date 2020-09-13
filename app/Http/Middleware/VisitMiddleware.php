<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class VisitMiddleware
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
        if (session()->has('user')) {
            // dd(session()->all());
            DB::table('visit')
                ->insert(
                    [
                        'id_user' => session('user')->id_user,
                        'ip_user' => $request->ip(),
                        'url' => $request->url()
                    ]
                );
        }
        return $next($request);

        // DB::table('visits')
        // ->inser([
        //     ''
        // ])
    }
}
