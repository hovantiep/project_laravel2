<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CanCategories
{
    /**
     * @param $request
     * @param Closure $next
     * @param ...$action
     * @return $this
     */
    public function handle($request, Closure $next, ...$action)
    {
        $action_name = Route::getCurrentRoute()->getName();
        if (in_array($action_name, $action)) {
            $canCate = json_decode($request->user()->can);
            if (!in_array($request->cate, $canCate)) {
                return redirect()->back()->withInput();
//                return response([
//                    'error' => [
//                        'code' => 'INSUFFICIENT_ROLE',
//                        'description' => 'You are not authorized to access this resource.'
//                    ]
//                ], 401);
            }
        }
        return $next($request);
    }
}
