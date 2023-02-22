<?php
/**
 * File DashboardController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\DashboardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Api
 */
class DashboardController extends BaseController
{
    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function getInfo(Request $request)
    {
        $result['total_truy_na'] = 0;
        $result['total_luu_tru'] = 0;
        $result['total_dia_diem_luu_tru'] = 0;
        $result['total_phat_hien_truy_na'] = 0;
        return $result;
    }
}
