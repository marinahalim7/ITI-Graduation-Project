<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDrugController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PharmacyAPIsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreDrugController;
use App\Models\StoreDrug;

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

Route::apiResource('/user/drugs',UserDrugController::class);
Route::apiResource('/drugs',DrugController::class);

Route::apiResource('/pharmacy',PharmacyAPIsController::class);

Route::apiResource('/store',StoreController::class);
Route::apiResource('/user', UserController::class);
Route::apiResource('/store/drugs',StoreDrugController::class);