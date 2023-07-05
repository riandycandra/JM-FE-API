<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuasController;
use App\Http\Controllers\UnitController;
use Ramsey\Uuid\Uuid;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {
    Route::apiResource('ruas', RuasController::class);

    Route::get('unit', [UnitController::class, 'index']);
});
