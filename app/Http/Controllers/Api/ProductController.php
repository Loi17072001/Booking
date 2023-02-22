<?php
/**
 * File ProductController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Http\Services\ImageService;
use App\Laravue\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers\Api
 */
class ProductController extends BaseController
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
        $query = Product::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $page = Arr::get($searchParams, 'page', 0);
        $limit = intval($limit);
        $name = Arr::get($searchParams, 'name', '');
        $group = Arr::get($searchParams, 'group', '');
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if (!empty($group)) {
            $query->where('group', 'LIKE', '%' . $group . '%');
        }
        $query->orderBy('created_at', 'DESC');
        $query->with('groupData');
        return ProductResource::collection($query->paginate($limit, ['*'],'page' ,$page));
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
        $query = Product::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $page = Arr::get($searchParams, 'page', 0);
        $limit = intval($limit);
        $name = Arr::get($searchParams, 'name', '');
        $group = Arr::get($searchParams, 'group', '');
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if (!empty($group)) {
            $query->where('group', 'LIKE', '%' . $group . '%');
        }
        $query->orderBy('created_at', 'DESC');
        $query->with('groupData');
        return ProductResource::collection($query->paginate($limit, ['*'],'page' ,$page));
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
        if (!empty($params['id'])) {
            $product = Product::find($params['id']);
            if (empty($product)) {
                return response()->json(['errors' => 'Not found record for update'], 403);
            }
        } else {
            $product = new Product();
        }
        $product->fill($params);

        if (!empty($params['imagesData'])) {
            $imagePaths = [];
            $images = $params['imagesData'];
            $imageService = new ImageService();
            foreach ($images as $im) {
                $path = '/storage/app/public/products/'. $im['uid']. '.jpg';
                $imageService->saveBase64ImagePng($im['base64'], base_path('/storage/app/public/products'), base_path($path));
                $pathSave = '/storage/products/'. $im['uid']. '.jpg';
                $imagePaths[] = $pathSave;
            }
            $product->images = $imagePaths;
        }
        $product->save();
        return new ProductResource($product);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
