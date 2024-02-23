<?php

use App\Http\Controllers\BootController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BootController::class, 'boot'])->name('index');
