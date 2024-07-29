<?php

namespace App\Http\Middleware;

use App\Class\Util;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class EnsureUserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $class = Str::betweenFirst(Route::currentRouteAction(), 'Controllers\\', 'Controller@');
        $action =  Util::getRouteMethodName();
        $routeName = Route::currentRouteName();

        if (auth()->user()->can($routeName) === false) {
            if (class_exists('\App\Policies\\' . $class . 'Policy')) {
                return app(\Illuminate\Auth\Middleware\Authorize::class,)->handle($request, function ($request) use ($next) {

                    return $next($request);
                }, $action, '\App\\' . $class);
            } else {
                return app(\Illuminate\Auth\Middleware\Authorize::class,)->handle($request, function ($request) use ($next) {

                    return $next($request);
                }, $routeName);
            }
        } else {
            return $next($request);
        }
    }
}
