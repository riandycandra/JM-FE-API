<?php

namespace App\Service;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\UploadedFile;
use Google\Cloud\Storage\StorageClient;

class UploadService
{
    public function uploadFile(?UploadedFile $file) {

        if($file == null) {
            return null;
        }

        $rand = Uuid::uuid4() . "." . $file->getClientOriginalExtension();

        $file->move(public_path('temp'), $rand);

        return url('temp/' . $rand);
    }
}
