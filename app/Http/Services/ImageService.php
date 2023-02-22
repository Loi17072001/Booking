<?php

namespace App\Http\Services;

use App\Laravue\Models\NguoiLuuTru;
use App\Laravue\Models\NguoiTruyNa;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class ImageService
{
    function saveBase64ImagePng($base64Image, $imageDir, $path)
    {
        $base64Image = trim($base64Image);
        $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
        $base64Image = str_replace('data:image/jpg;base64,', '', $base64Image);
        $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
        $base64Image = str_replace('data:image/gif;base64,', '', $base64Image);
        $base64Image = str_replace(' ', '+', $base64Image);
        $imageData = base64_decode($base64Image);
        //Set image whole path here
        $filePath = $path;
        if (!is_dir($imageDir)) {
            // dir doesn't exist, make it
            mkdir($imageDir);
          }
        file_put_contents($filePath, $imageData);
    }
}
