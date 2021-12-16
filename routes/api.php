<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientSessionController;
use App\Http\Controllers\ClientRegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});


Route::middleware('api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

    Route::prefix('bank')->group(function () {
        Route::post('token', [ClientSessionController::class, 'acessSessionToken']);
        Route::post('login', [ClientSessionController::class, 'accountLogin']);
        Route::post('register/p/user', [ClientRegisterController::class, 'accountPersonRegisterUser']);
        Route::post('register/p/address', [ClientRegisterController::class, 'accountPersonRegisterAddress']);

        Route::post('register/p/doc/selfie', [ClientRegisterController::class, 'accountPersonRegisterDocSelfie']);

        Route::post('register/p/doc/id/front', [ClientRegisterController::class, 'accountPersonRegisterDocIdFront']);
        Route::post('register/p/doc/id/verse', [ClientRegisterController::class, 'accountPersonRegisterDocIdVerse']);

        Route::post('register/p/doc/driver/front', [ClientRegisterController::class, 'accountPersonRegisterDocDriverFront']);
        Route::post('register/p/doc/driver/verse', [ClientRegisterController::class, 'accountPersonRegisterDocDriverVerse']);
    });
});
