<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedWithLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale', app()->getLocale());

        // Если пользователь не авторизован или его email не подтвержден
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            // Направляем пользователя на страницу верификации с локалью
            return redirect()->route('verification.notice', ['locale' => $locale]);
        }
        
        return $next($request);
    }
}
