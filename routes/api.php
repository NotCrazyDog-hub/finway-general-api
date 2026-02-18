<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\CashBoxController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
    
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('goals', GoalController::class);
    Route::apiResource('cash-boxes', CashBoxController::class);
});