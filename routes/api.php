<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuasController;
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
});

Route::post('test', function() {

    $file = request()->file;

    $file->move(public_path('temp'), $file->getClientOriginalName());

    $storage = new StorageClient([
        'keyFilePath' => base_path() . '/service_account.json',
    ]);
    $bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');
    $bucket = $storage->bucket($bucketName);

    $filePath = public_path('temp/' . $file->getClientOriginalName());

    $rand = Uuid::uuid4() . "." . $file->getClientOriginalExtension();

    $object = $bucket->upload(
        fopen($filePath, 'r'), [
            'name' => 'candidate-files/' . $rand
        ]
    );

    Storage::delete($filePath);

    return "https://storage.googleapis.com/exam-fe-jasamarga/candidate-files/{$rand}";
});
