<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\OrderItemApiController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\NotificationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('companies', CompanyApiController::class);
Route::apiResource('users', UserApiController::class);
Route::apiResource('categories', CategoryApiController::class);
Route::apiResource('products', ProductApiController::class);
Route::apiResource('orders', OrderApiController::class);
Route::apiResource('order-items', OrderItemApiController::class);
Route::apiResource('payments', PaymentApiController::class);
Route::apiResource('notifications', NotificationApiController::class);
