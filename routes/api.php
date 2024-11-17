<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Courses\CourseController;
use App\Http\Controllers\Api\Reviews\ReviewController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::domain(env('API_DOMAIN'))->group(function () {

    Route::get('/', fn() => response()->json(['message' => 'Welcome to the API']));

    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'signup');
        Route::post('login', 'signin');
        Route::post('verify-phone', 'verifyPhone');
        Route::post('resend-otp-phone', 'resendOtpByPhone');
        Route::post('send_reset_code', 'sendResetCode');
        Route::post('confirm_reset_code', 'checkResetPassword');
        Route::post('reset-password', 'reset');
        Route::post('change_password', 'resetPassword')->middleware('auth:api');
        Route::post('logout', 'logout')->middleware('auth:api');
    });

    Route::middleware('auth:api')->group(function () {
        Route::group(['prefix' => 'review'], function () {
            Route::post('/', [ReviewController::class, 'toggleReview']);
        });
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
    });

});
