<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CompanionController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\SpeciesController;

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

Route::post('/sanctum/token', TokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/users/auth', AuthController::class);
  Route::get('/users/{user}', [UserController::class, 'show']);
  Route::get('/users', [UserController::class, 'index']);

  Route::post('/users/auth/avatar', [AvatarController::class, 'store']);

  Route::post('/messages', [MessageController::class, 'store']);
  Route::get('/messages', [MessageController::class, 'index']);

  Route::post('/manufacturer', [ManufacturerController::class, 'store']);
  Route::get('/manufacturer', [ManufacturerController::class, 'index']);

  Route::post('/companion', [CompanionController::class, 'store']);
  Route::get('/companion', [CompanionController::class, 'index']);

  Route::post('/family', [FamilyController::class, 'store']);
  Route::get('/family', [FamilyController::class, 'index']);

  Route::post('/plant_type', [PlantTypeController::class, 'store']);
  Route::get('/plant_type', [PlantTypeController::class, 'index']);

  Route::post('/species', [SpeciesController::class, 'store']);
  Route::get('/species', [SpeciesController::class, 'index']);
});
