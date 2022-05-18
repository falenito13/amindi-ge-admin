<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Projects
    Route::apiResource('projects', 'ProjectsApiController');

    // Folders
    Route::post('folders/media', 'FoldersApiController@storeMedia')->name('folders.storeMedia');
    Route::apiResource('folders', 'FoldersApiController');
});
Route::prefix('v1')->namespace('Api\V1')->group(function () {
    Route::get('/all-news','ApiController@allNews');
    Route::get('/news','ApiController@news');
});
