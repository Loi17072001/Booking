<?php
/**
 * File AuthController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */
namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Laravue\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api
 */
class AuthController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('account', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(new JsonResponse([], 'Tài khoản hoặc mật khẩu không đúng'), Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        // $user->tokens()->delete();
        // Log::info($user->createToken('token-name', ['*'])->plainTextToken);
        return response()->json(new JsonResponse(new UserResource($user)), Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json((new JsonResponse())->success([]), Response::HTTP_OK);
    }

}
