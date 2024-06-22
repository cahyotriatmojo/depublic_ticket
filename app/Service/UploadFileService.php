<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public function uploadFile($file)
    {
        $extension = $file->extension();
        $file_name = date('dmyHis') . '.' . $extension;

        $path = Storage::putFileAs('public/product', $file, $file_name); // Save the file to the storage

        return $path;
    }
}