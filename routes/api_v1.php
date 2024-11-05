<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\LinkController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/links', [LinkController::class, 'index'])->middleware('auth:sanctum');
Route::post('/links', [LinkController::class, 'store'])->middleware('auth:sanctum');
