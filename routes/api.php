<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Laravue\Faker;
use \App\Laravue\JsonResponse;
use \App\Laravue\Acl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    Route::post('auth/login', 'AuthController@login');
    Route::get('public/products/search', 'ProductController@search');
    Route::get('public/menus/search', 'MenuOfDayController@search');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Auth routes
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');

        // Route::get('/user', function (Request $request) {
        //     return new UserResource($request->user());
        // });
        // Api menu of day
        Route::get('menu/search', 'MenuOfDayController@index');
        Route::get('menu/delete', 'MenuOfDayController@delete');
        Route::apiResource('menu', 'MenuOfDayController')->middleware(
            [
                'permission:' . Acl::PERMISSION_USER_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        // Api group
        Route::get('group/search', 'GroupController@index');
        Route::apiResource('group', 'GroupController')->middleware(
            [
                'permission:' . Acl::PERMISSION_USER_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        // Api product
        Route::get('products/search', 'ProductController@index');
        Route::apiResource('products', 'ProductController')->middleware(
            [
                'permission:' . Acl::PERMISSION_USER_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );

        // Api Dashboard
        Route::get('dashboard/get-info', 'DashboardController@getInfo');

        // Api resource routes
        Route::apiResource('roles', 'RoleController')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        Route::apiResource('users', 'UserController')->middleware(
            [
                'permission:' . Acl::PERMISSION_USER_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        Route::apiResource('permissions', 'PermissionController')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );

        // permissions routes
        Route::put('users/{user}', 'UserController@update')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );;
        Route::get('users/{user}/permissions', 'UserController@permissions')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        Route::put('users/{user}/permissions', 'UserController@updatePermissions')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
        Route::get('roles/{role}/permissions', 'RoleController@permissions')->middleware(
            [
                'permission:' . Acl::PERMISSION_PERMISSION_MANAGE,
                'permission:' . Acl::PERMISSION_EDIT_DATA,
                'permission:' . Acl::PERMISSION_DELETE_DATA
            ]
        );
    });
});
