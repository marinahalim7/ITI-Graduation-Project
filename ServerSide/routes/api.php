<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDrugController;
use App\Http\Controllers\PharmacyAPIsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
// use App\Http\Controllers\DrugController;
use App\Http\Controllers\StoreDrugController;

use App\Http\Controllers\PharmacyDrugsController;
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
// cros
// Route::middleware(['cors'])->group(function () {
//     Route::post('/hogehoge', 'Controller@hogehoge');
// });





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Marina Routes
// middleware of login............ 
// Route::apiResource('/user/drugs',UserDrugController::class)->middleware('auth:sanctum');
Route::apiResource('/user/drugs',UserDrugController::class);
Route::get('/users/drugs',[UserDrugController::class,'getAllUSersDrugs']);
Route::get('/users/drugs/{name}',[UserDrugController::class,'getDrugsByName']);

Route::get('/admin',[UserDrugController::class,'display_Unpublished_Drugs']);
Route::put('/admin/{DrugId}',[UserDrugController::class,'update_Drug']);
Route::delete('/admin/{DrugId}',[UserDrugController::class,'delete_Drug']);


// Route::apiResource('/stores/drugs', StoreDrugController::class);
// cros
Route::middleware(['cors'])->group(function () {
    Route::apiResource('stores.drugs', StoreDrugController::class);

});
// 

Route::get('stores/drugs/{drug}', [StoreDrugController::class , 'getdrugs']);

Route::apiResource('/pharmacy',PharmacyAPIsController::class);

Route::post('/pharmacy/login' ,[ PharmacyAPIsController::class,'login']);
Route::post('/pharmacy/logout', [PharmacyAPIsController::class, 'logout']);

Route::apiResource('/store',StoreController::class);

Route::post('/store/login' , [StoreController::class , 'login']);
Route::post('/store/logout' , [StoreController::class , 'logout']);

Route::apiResource('user', UserController::class);
#Route::delete('/stores/{storeId}/drugs/{drugId}', [StoreDrugController::class, 'destroy'])->middleware('api');



use App\Http\Controllers\PayPalController;

Route::post('/create-payment', [PayPalController::class, 'createPayment']);
Route::post('/execute-payment', [PayPalController::class, 'executePayment']);

use App\Http\Controllers\PaymentController;
Route::post('/payment', [PaymentController::class,'makePayment'])->name('payment.make');
Route::post('/user/login', [UserController::class, 'userLogin']);





// Pharmacy Drugs
Route::get('/pharmacies/drug',[PharmacyDrugsController::class,'getDrug']);
Route::apiResource('/pharmacies/drugs',PharmacyDrugsController::class);