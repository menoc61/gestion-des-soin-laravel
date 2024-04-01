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

Route::get('/patient/view/{id}', [UserApiController::class, 'view'])->where('id', '[0-9]+')->middleware(['role_or_permission:view patient']);

Route::get('/users/create', [UserApiController::class, 'create'])->name('user.create');
Route::post('/users/create', [UserApiController::class, 'store'])->name('user.store');

Route::get('/users/edit/{id}', [UserApiController::class, 'edit'])->where('id', '[0-9]+')->name('user.edit');
Route::post('/users/edit', [UserApiController::class, 'store_edit'])->name('user.store');
