<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/patients/{id}/notes', [NotesController::class, 'index']);
Route::post('/patients/{id}/notes', [NotesController::class, 'store']);
Route::get('/patients/{id}/notes/summary', [NotesController::class, 'summary']);
