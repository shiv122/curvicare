<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FileUploader
{
    public static function uploadFile($file, string $path = "images", string $initials = "img"): string
    {
        try {
            $destinationPath =  $path;
            $req_file = $initials . '-' . rand(1, 1000) . sha1(time()) . "." . $file->getClientOriginalExtension();
            return $file->move($destinationPath, $req_file);
        } catch (Exception  $e) {
            \Log::info('Exception in image upload : ' . $e->getMessage());
            throw new Exception("Failed to upload image. error : " . $e->getMessage());
        }
    }
}
