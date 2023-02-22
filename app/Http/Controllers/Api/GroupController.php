<?php
/**
 * File GroupController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\GroupResource;
use App\Http\Services\ImageService;
use App\Laravue\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

/**
 * Class GroupController
 *
 * @package App\Http\Controllers\Api
 */
class GroupController extends BaseController
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
        $query = Group::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $page = Arr::get($searchParams, 'page', 0);
        $limit = intval($limit);
        $name = Arr::get($searchParams, 'name', '');
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        $query->with('products');
        $query->orderBy('name', 'ASC');
        return GroupResource::collection($query->paginate($limit, ['*'],'page' ,$page));
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
            $group = Group::find($params['id']);
            if (empty($group)) {
                return response()->json(['errors' => 'Not found record for update'], 403);
            }
        } else {
            $group = new Group();
        }
        $group->fill($params);
        if (!empty($params['imagesData'])) {
            $imagePaths = [];
            $images = $params['imagesData'];
            $imageService = new ImageService();
            foreach ($images as $im) {
                $path = '/storage/app/public/groups/'. $im['uid']. '.jpg';
                $imageService->saveBase64ImagePng($im['base64'], base_path('/storage/app/public/groups'), base_path($path));
                $pathSave = '/storage/groups/'. $im['uid']. '.jpg';
                $imagePaths[] = $pathSave;
            }
            $group->images = $imagePaths;
        }
        $group->save();
        return new groupResource($group);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $Group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        try {
            $group->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
