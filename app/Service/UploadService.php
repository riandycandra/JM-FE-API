<?php

namespace App\Service;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\UploadedFile;
use Google\Cloud\Storage\StorageClient;

class UploadService
{
    public function uploadFile(UploadedFile $file) {

        $file->move(public_path('temp'), $file->getClientOriginalName());

        $storage = new StorageClient([
            'keyFilePath' => base_path() . '/service_account.json',
        ]);
        $bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');
        $bucket = $storage->bucket($bucketName);

        $filePath = public_path('temp/' . $file->getClientOriginalName());

        $rand = Uuid::uuid4() . "." . $file->getClientOriginalExtension();
        $targetDir = 'candidate-files/' . $rand;

        $object = $bucket->upload(
            fopen($filePath, 'r'), [
                'name' => $targetDir
            ]
        );

        unlink($filePath);

        return "https://storage.googleapis.com/exam-fe-jasamarga/candidate-files/{$rand}";
    }
}
