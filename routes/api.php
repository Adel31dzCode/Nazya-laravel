<?php

use App\Http\Controllers\AuthActionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/token/refresh', [AuthActionsController::class, 'refresh']);
Route::post('/login', [AuthActionsController::class, 'login']);
Route::post('/register', [AuthActionsController::class, 'register']);

