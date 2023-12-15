<?php

use App\Http\Controllers\Api\RendezVousController;
use App\Http\Controllers\Api\UserController;
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

// user
Route::post('/login', [UserController::class, 'login']);
Route::get('/all', [UserController::class, 'all']);
Route::post('/logout', [UserController::class, 'logout']);

// Rendez-Vous
Route::get('/Rendez-vous/all/{id}', [RendezVousController::class, 'all']);
Route::post('/Rendez-vous/create/{id}', [RendezVousController::class, 'create']);
Route::patch('/Rendez-vous/edit/{id}', [RendezVousController::class, 'update']);
Route::get('/Rendez-vous/calendar', 'AppointmentController@calendar')->name('appointment.calendar')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/Rendez-vous/pending', 'AppointmentController@pending')->name('appointment.pending')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/Rendez-vous/checkslots/{id}', 'AppointmentController@checkslots');
Route::get('/Rendez-vous/delete/{id}', 'AppointmentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete appointment']);
