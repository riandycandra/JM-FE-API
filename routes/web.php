<?php

use Illuminate\Support\Facades\Route;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/refresh', function() {
    Artisan::call('migrate:refresh --seed');
});
