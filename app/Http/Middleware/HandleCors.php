<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // إضافة هيدرز CORS لكل الردود
        $response->headers->set('Access-Control-Allow-Origin', '*'); // السماح لكل الدومينات
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS'); // السماح بكل الطرق
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With'); // السماح بكل الهيدرز المطلوبة
        $response->headers->set('Access-Control-Expose-Headers', '*'); // السماح بكل الهيدرز المكشوفة

        return $response;
    }
}
