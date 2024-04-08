<?php


use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

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


Route::post('/users/register', [UserApiController::class, 'RegisterUser']);

Route::post('/users/login', [UserApiController::class, 'LoginUser']);

Route::prefix('v1')->as('v1.')->middleware('auth:sanctum')->group(function(){

    Route::get('/patient/view/{id}', [UserApiController::class, 'view'])->where('id', '[0-9]+');

    Route::put('/users/update/{user}', [UserApiController::class, 'updateUser'])->where('user', '[0-9]+');
});

