<?php

namespace project2\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Kiem tra quyen truy cap cua user nao do
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles[] from the route
        $roles = $this->getRequiredRoleForRoute($request->route());

        // Kiem tra xem co quyen truy cap hay khong
        if ($request->user()->hasRole($roles) /*|| !$roles*/) {
            return $next($request);
        }

        return response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);
    }

    /**
     * Tra ve cac quyen truy cap trong route
     * @param $route
     * @return array cac quyen do admin cai dat o route
     */
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
