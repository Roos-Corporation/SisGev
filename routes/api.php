<?php

use App\Http\Controllers\Api\EventStageParticipantController;
use App\Http\Controllers\Api\EventParticipantController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CoffeeSpaceController;
use App\Http\Controllers\Api\EventRoomController;
use App\Http\Controllers\Api\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::apiResource('/people', PersonController::class);
Route::apiResource('/event-rooms', EventRoomController::class);
Route::apiResource('/coffee-spaces', CoffeeSpaceController::class);
Route::apiResource('/events', EventController::class);
Route::apiResource('/event-participants', EventParticipantController::class);
Route::apiResource('/event-stage-participants', EventStageParticipantController::class);


