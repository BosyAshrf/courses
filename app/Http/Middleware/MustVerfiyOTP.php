<?php

namespace App\Http\Middleware;

use App\Enums\User\OTPEvent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Api\ResponseMethodEnum;

class MustVerfiyOTP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('api')->check()){
            $user = auth('api')->user();
            if($user->otp != null && in_array($user->otp_event, [OTPEvent::LOGIN->value, OTPEvent::REGISTER->value])){
                return generalApiResponse(method: ResponseMethodEnum::CUSTOM,custom_message: __('Please verify your OTP'),custom_status: 403,custom_status_msg: 'error');
            }
        }
        return $next($request);
    }
}
