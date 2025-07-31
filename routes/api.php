<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::apiResource('task', TaskController::class)->except(['update']);
Route::put('/task/{task}', [TaskController::class, 'replace']);
Route::patch('/task/{task}', [TaskController::class, 'update']);