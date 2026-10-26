<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AltokafeController;

Route::get('/', [AltokafeController::class, 'index']);
Route::post('/lotes', [AltokafeController::class, 'store'])->name('lotes.store');
