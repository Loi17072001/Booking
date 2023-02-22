<?php
/**
 * File RoomController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\FileUploadResource;
use App\Http\Services\NguoiLuuTruTruyNaService;
use App\Laravue\Models\FileUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

/**
 * Class CommonController
 *
 * @package App\Http\Controllers\Api
 */
class CommonController extends BaseController
{
    const ITEM_PER_PAGE = 15;
    public function list(Request $request)
    {
        $searchParams = $request->all();
        $date = Arr::get($searchParams, 'date', '');
        $type = Arr::get($searchParams, 'type', '');
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $query = FileUpload::select('*');
        if (!empty($date)) {
            $query->where('created_at', '=', $date);
        }
        if (!empty($type)) {
            $query->where('type', '=', $type);
        }
        return FileUploadResource::collection($query->paginate($limit));;
    }
    public function storeExcelLuuTru(Request $request)
    {
        try {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('Y-m-d');
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('luutru', $fileName);
            $fileUpload = new FileUpload();
            $fileUpload->name = $fileName;
            $fileUpload->type = FileUpload::LUUTRU;
            $fileUpload->status = FileUpload::NOT_IMPORT;
            $fileUpload->path = 'storage/app/luutru/'.$fileName;
            $fileUpload->save();
            $luuTruTruyNaService = new NguoiLuuTruTruyNaService();
            $luuTruTruyNaService->importNguoiLuuTruFromExcel($fileUpload->path, $fileUpload->_id);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => 'Lỗi phát sinh khi update'], 500);
        }

        return response()->json([
            "id" => 101
        ]);
    }
    public function storeExcelTruyNa(Request $request)
    {
        try {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('Y-m-d');
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('truyna', $fileName);
            $fileUpload = new FileUpload();
            $fileUpload->name = $fileName;
            $fileUpload->type = FileUpload::TRUYNA;
            $fileUpload->status = FileUpload::NOT_IMPORT;
            $fileUpload->path = 'storage/app/truyna/'.$fileName;
            $fileUpload->save();
            $luuTruTruyNaService = new NguoiLuuTruTruyNaService();
            $luuTruTruyNaService->importNguoiTruyNaFromExcel($fileUpload->path, $fileUpload->_id);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => 'Lỗi phát sinh khi update'], 500);
        }

        return response()->json([
            "id" => 101
        ]);
    }
}
