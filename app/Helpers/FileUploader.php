<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;


class FileUploader
{
    public static function uploadFile($file, $path = "images", $initials = "img")
    {
        try {
            $destinationPath =  $path;
            $req_file = $initials . '-' . rand(1, 1000) . sha1(time()) . "." . $file->getClientOriginalExtension();
            return $file->move($destinationPath, $req_file);
        } catch (Exception  $e) {
            \Log::info('Exception in image upload : ' . $e->getMessage());
            return 'failed';
        }
    }
}
