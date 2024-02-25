<?php

use App\Api\Controllers\FileController;
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
*/

Route::get('/files', [FileController::class, 'index']);
Route::get('/files/location/{location}', [FileController::class, 'locationIndex']);
Route::get('/files/folder/{id}', [FileController::class, 'filesInFolder']);