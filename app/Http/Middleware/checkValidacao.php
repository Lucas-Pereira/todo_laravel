<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


//Manter middelware
class checkValidacao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      /*  if ($request->bearerToken() === 'token-name' ) {
            var_dump($request->bearerToken());
            return $next($request);
          } else {
            return redirect()->route('index.html');
          }*/
    }
}
