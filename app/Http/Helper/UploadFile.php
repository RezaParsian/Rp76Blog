<?php

namespace App\Http\Helper;

use Illuminate\Http\UploadedFile;

class UploadFile
{
    public string $fileName;

    public function __construct(?UploadedFile $file, string $path = "upload/")
    {
        if (!$file) {
            $this->fileName = "";
            return;
        }

        $this->fileName = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move(public_path($path), $this->fileName);
    }
}
