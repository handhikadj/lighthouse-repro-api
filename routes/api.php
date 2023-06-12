<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1'], function () {

    // Auth and user related stuff
    Route::post('login', [\App\Http\Controllers\Api\V1\LoginController::class, 'login'])->name('login');

    // Verify email
    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Api\V1\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verify/resend', [\App\Http\Controllers\Api\V1\VerifyEmailController::class, 'resendVerificationEmail'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

    Route::post('/postal_codes/verify', [\App\Http\Controllers\Api\V1\CityController::class, 'verifyPostalCode'])->name('postal-codes.verify');

    // general authed routes
    Route::group(['middleware' => 'guest'], function () {
        Route::post('password/forgot-password', [\App\Http\Controllers\Api\V1\ForgotPasswordController::class, 'sendResetLinkResponse'])->name('password.forgot-password');;
        Route::post('password/reset', [\App\Http\Controllers\Api\V1\ResetPasswordController::class, 'sendResetResponse'])->name('password.reset');;
    });
});
