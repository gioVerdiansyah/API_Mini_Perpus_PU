<?php

namespace App\Http\Middleware;

use App\Helpers\HandleJsonResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty($request->bearerToken())){
            if(auth('sanctum')->check()){
                return $next($request);
            }else{
                return HandleJsonResponseHelper::res("Token is Invalid / Expired", [], 403, false);
            }
        }
        return HandleJsonResponseHelper::res("Missing Bearer Token!", [], 403, false);
    }
}
