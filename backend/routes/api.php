<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SeedsController;
use App\Http\Controllers\admin\FamiliesController;
use App\Http\Controllers\admin\ManufacturersController;
use App\Http\Controllers\admin\CompanionsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::apiResources(['seeds' => SeedsController::class]);
        Route::apiResources(['families' => FamiliesController::class]);
        Route::apiResources(['manufacturers' => ManufacturersController::class]);
        Route::apiResources(['companions' => CompanionsController::class]);
    });

