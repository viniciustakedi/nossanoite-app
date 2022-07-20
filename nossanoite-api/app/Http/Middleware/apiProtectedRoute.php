<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\{TokenExpiredException, TokenInvalidException};

class apiProtectedRoute extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException){
                return response()->json(['status' => 'Não Autorizado: O token é inválido', 'number_status' => 400]);
            }else if ($exception instanceof TokenExpiredException){
                return response()->json(['status' => 'Não Autorizado: O token foi expirado', 'number_status' => 401]);
            }else{
                return response()->json(['status' => 'Não Autorizado: O token não foi encontrado', 'number_status' => 402]);
            }
        }
        return $next($request);
    }
}
