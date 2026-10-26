<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AltokafeController;

Route::get('/v1/lotes', [AltokafeController::class, 'apiIndex']);
