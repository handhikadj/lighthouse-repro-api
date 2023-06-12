<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmailResetController;
use App\Http\Controllers\Api\V1\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('email-reset/verify/{token}', [VerifyEmailResetController::class,  'verify'])->name('verifyEmailReset');

Route::get('password-reset/verify/{token}/{email}', [ResetPasswordController::class,  'validateToken'])->name('resetPassword.validateToken');
