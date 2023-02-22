<?php
/**
 * File MenuOfDayController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MenuOfDayResource;
use App\Laravue\Models\MenuOfDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

/**
 * Class MenuOfDayController
 *
 * @package App\Http\Controllers\Api
 */
class MenuOfDayController extends BaseController
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $query = MenuOfDay::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $page = Arr::get($searchParams, 'page', 0);
        $limit = intval($limit);
        $name = Arr::get($searchParams, 'name', '');
        $date = Arr::get($searchParams, 'date', Carbon::now());
        if (!empty($date)) {
            $query->whereBetween(
                'date', array(
                    Carbon::createFromFormat('d/m/Y', $date)->startOfDay(),
                    Carbon::createFromFormat('d/m/Y', $date)->endOfDay()
                )
                );
        }
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        $query->with('product');
        $query->orderBy('group', 'DESC');
        return MenuOfDayResource::collection($query->paginate($limit, ['*'],'page' ,$page));
    }

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function search(Request $request)
    {
        $searchParams = $request->all();
        $query = MenuOfDay::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $page = Arr::get($searchParams, 'page', 0);
        $limit = intval($limit);
        $name = Arr::get($searchParams, 'name', '');
        $date = Arr::get($searchParams, 'date', Carbon::now()->format('d/m/Y'));
        if (!empty($date)) {
            $query->whereBetween(
                'date', array(
                    Carbon::createFromFormat('d/m/Y', $date)->startOfDay(),
                    Carbon::createFromFormat('d/m/Y', $date)->endOfDay()
                )
                );
        }
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        $query->with('product');
        $query->orderBy('price', 'DESC');
        return MenuOfDayResource::collection($query->paginate($limit, ['*'],'page' ,$page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $dates = $params['date'];
        $datas = $params['data'];
        $isUpdate = !empty($params['isUpdate']) ? $params['isUpdate'] : false;
        if ($isUpdate) {
            $dateStartSearch = Carbon::createFromFormat('d/m/Y', $dates)->startOfDay();
            $dateEndSearch = Carbon::createFromFormat('d/m/Y', $dates)->endOfDay();
            MenuOfDay::whereBetween(
                'date', array(
                    $dateStartSearch,
                    $dateEndSearch
                )
            )->delete();
            foreach ($datas as $product) {
                $data = new MenuOfDay();
                $data->date = $dateStartSearch;
                $data->product_id = $product['product_id'];
                $data->price = $product['price'];
                $data->price_discount = $product['price_discount'];
                $data->qty = $product['qty'];
                $data->description = '';
                $data->save();
            }
            return response()->json(['message' => 'Create success'], 200);
        } else {
            foreach ($dates as $d) {
                foreach ($datas as $product) {
                    $data = new MenuOfDay();
                    $data->date = Carbon::parse($d)->startOfDay();
                    $data->product_id = $product['product_id'];
                    $data->price = $product['price'];
                    $data->price_discount = $product['price_discount'];
                    $data->qty = $product['qty'];
                    $data->description = '';
                    $data->save();
                }
            }
            return response()->json(['message' => 'Create success'], 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  MenuOfDay $MenuOfDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuOfDay $menuOfDay)
    {
        try {
            $menuOfDay->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }

    public function delete(Request $request)
    {
        try {
            $params = $request->all();
            $dates = $params['date'];
            $dateStartSearch = Carbon::createFromFormat('d/m/Y', $dates)->startOfDay();
            $dateEndSearch = Carbon::createFromFormat('d/m/Y', $dates)->endOfDay();
            MenuOfDay::whereBetween(
                'date', array(
                    $dateStartSearch,
                    $dateEndSearch
                )
            )->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
