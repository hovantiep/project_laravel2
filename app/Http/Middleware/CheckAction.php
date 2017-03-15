<?php

namespace project2\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;


class CheckAction
{
    /**
     * Handle an incoming request.
     * Kiem tra quyen truy cap cua user nao do vao 1 action cu the
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$action)
    {
        // Lay ten action hien tai truy cap: "getNewsIndex"
        $action_name = Route::getCurrentRoute()->getName();

        if (!in_array($action_name, $action)) { // k dung action truy cap
            return response([
                'error' => [
                    'code' => 'INSUFFICIENT_ROLE',
                    'description' => 'You are not authorized to access this resource.'
                ]
            ], 401);
        }
        return $next($request); // tiep tuc url yeu cau
    }
}
