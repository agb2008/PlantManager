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
use App\Http\Controllers\SeedsController;
use App\Http\Controllers\SeedlingController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\CalendarTasksController;
use App\Http\Controllers\PositionsController;


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

  Route::apiResources([
      'messages' => MessageController::class,
      'manufacturer' => ManufacturerController::class,
      'companion' => CompanionController::class,
      'family' => FamilyController::class,
      'plant_type' => PlantTypeController::class,
      'species' => SpeciesController::class,
      'seeds' => SeedsController::class,
      'seedling' => SeedlingController::class,
      'plants' => PlantsController::class,
      'calendar_tasks' => CalendarTasksController::class,
      'positions' => PositionsController::class,
  ]);

});
