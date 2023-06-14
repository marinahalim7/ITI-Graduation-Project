<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDrugController;
use App\Http\Controllers\PharmacyAPIsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\StoreDrugController;
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

// middleware of login............ 
// Route::apiResource('/user/drugs',UserDrugController::class)->middleware('auth:sanctum');
Route::apiResource('/user/drugs',UserDrugController::class);
Route::apiResource('/drugs',DrugController::class);
Route::apiResource('/pharmacy',PharmacyAPIsController::class);

Route::apiResource('/store',StoreController::class);
Route::apiResource('user', UserController::class);


#Route::delete('/stores/{storeId}/drugs/{drugId}', [StoreDrugController::class, 'destroy'])->middleware('api');
Route::apiResource('stores.drugs', StoreDrugController::class)->only(['destroy','update']);


use App\Http\Controllers\PayPalController;

Route::post('/create-payment', [PayPalController::class, 'createPayment']);
Route::post('/execute-payment', [PayPalController::class, 'executePayment']);

use App\Http\Controllers\PaymentController;
Route::post('/payment', [PaymentController::class,'makePayment'])->name('payment.make');

Route::post('/user/login', [UserController::class, 'userLogin']);

