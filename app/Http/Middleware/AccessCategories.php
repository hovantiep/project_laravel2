<?php

namespace project2\Http\Middleware;

use Closure;

class AccessCategories
{
    /**
     * Kiem tra xem user nao do co truy cap duoc vao "Danh muc" cu the khong
     * @param Closure $next
     * @param ...$action
     * @return $this
     */
    public function handle($request, Closure $next, ...$action)
    {
//        if (dk){
            // kiem tra cot "can" trong db
//            $canCate = json_decode($request->user()->can); // Lay quyen thao tac cate trong db
            // phai lay danh muc hien tai truy cap de so sanh co truy cap duoc hay khong
//            if (!in_array($request->cate, $canCate)) {
//                return redirect()->back()->withInput();
//        }
        return response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);
            return $next($request); // tiep tuc url yeu cau
    }
}
