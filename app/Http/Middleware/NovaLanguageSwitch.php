<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Nova;

class NovaLanguageSwitch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = Cache::get(auth()->guard(config('nova.guard'))->id().'.locale');
        if ($lang) {
            app()->setLocale($lang);
            if (in_array($lang,config('nova-language-switch.rtl-languages'), true)) {
                Nova::enableRTL();
            }
        }elseif (app()->isLocale('ar')) {
            Nova::enableRTL();
        }
        return $next($request);
    }
}
