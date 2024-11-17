<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\Api\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckResetCodeRequest;
use App\Http\Requests\Api\Auth\CheckVerificationCodeRequest;
use App\Http\Requests\Api\Auth\ResendOtpRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\SendResetPasswordCodeRequest;
use App\Http\Requests\Api\Auth\SigninRequest;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Http\Resources\Api\User\VerifyResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(SigninRequest $request)
    {
        if (Auth::attempt($this->getCredentials($request))) {
            $user = auth('api')->user();
            if ($user->otp !== null) {
                return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('You should activate your phone to sign in'), custom_status: 401, additional_data: ['has_verified_account' => $user->otp == null, 'phone' => $user->phone_number, 'email' => $user->email]);
            }

            $token = $user->createToken('api_token')->plainTextToken;
            data_set($user, 'token', $token);
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM_SINGLE, resource: UserResource::class, data_passed: $user, custom_message: __('success login'), additional_data: ['has_verified_account' => $user->otp == null]);
        }
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Incorrect username or password.'), custom_status_msg: 'fail', custom_status: 422);
    }

    public function signup(SignUpRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        $code = 1111;

        $token = $user->createToken('api_token')->plainTextToken;
        $user->update(['otp' => $code]);
        data_set($user, 'token', $token);

        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('we have sent a reset code to your provided phone'));
    }

    public function verifyPhone(CheckVerificationCodeRequest $request)
    {

        $validated = $request->validated();
        $user = User::where(['otp' => $request->code, 'phone_number' => $request->phone_number])->first();
        if (!$user) {
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Invalid verification code or phone number'), custom_status_msg: 'fail', custom_status: 422);
        }

        $user->update(['otp' => null]);

        $token = $user->createToken('api_token')->plainTextToken;
        data_set($user, 'token', $token);
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM_SINGLE, resource: VerifyResource::class, data_passed: $user, custom_message: __('success login'));
    }

    public function sendResetCode(SendResetPasswordCodeRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if (!$user) {
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Phone is not valid'), custom_status_msg: 'fail', custom_status: 422);
        }
    
        $code = 1111;
        try {
            $user->update(['otp' => $code]);
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('we have sent a reset code to your whatsapp'));
        } catch (\Exception $e) {
            \Log::error('critical error in: ' . __METHOD__ . ' \non line: ' . __LINE__ . ' \nwith message: ' . $e->getMessage());
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Some error occured please try again later!'), custom_status_msg: 'fail', custom_status: 500);
        }
    }

    /**
     * Step 2
     * check if reset code correct as send to whatsapp
     **/
    public function checkResetPassword(CheckResetCodeRequest $request)
    {
        $user = User::where(['otp' => $request->code, 'phone_number' => $request->phone_number])->first();
        if (!$user) {
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Phone is not valid'), custom_status_msg: 'fail', custom_status: 422);
        }

        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Code is Correct'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::where(['otp' => $request->code, 'phone_number' => $request->phone_number])->first();
        if (!$user) {
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Phone is not valid'), custom_status_msg: 'fail', custom_status: 422);
        }
        $token = $user->createToken('api_token')->plainTextToken;
        $user->update(['email_verified_at' => now(), 'password' => $request->new_password, 'otp' => null]);
        data_set($user, 'token', $token);
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM_SINGLE, resource: UserResource::class, data_passed: $user);

    }

    public function resendOtpByPhone(ResendOtpRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('phone_number', $validated['phone_number'])->first();

        if (!$user) {
            return generalApiResponse(
                method: ResponseMethodEnum::CUSTOM,
                custom_message: __('User not found'),
                custom_status_msg: 'fail',
                custom_status: 404
            );
        }
        $code = 1111;

        $user->update(['otp' => $code]);

        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM,
            custom_message: __('New OTP sent successfully'),
            custom_status_msg: 'success'
        );
    }


    public function logout(Request $request)
    {
        $user = auth('api')->user();
        $user->tokens()->delete();
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('success logout'));
    }

    private function getCredentials(Request $request)
    {
        $credentials = [];

        $credentials['phone_number'] = $request->phone_number;

        $credentials['password'] = $request->password;

        return $credentials;
    }
}
