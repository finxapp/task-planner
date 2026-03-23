<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {

    if(auth()->check()) {
        return redirect('/tasks');
    }

    return view('home');
});

Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::post('/logout',[AuthController::class,'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/tasks',[TaskController::class,'index']);
    Route::get('/tasks/create',[TaskController::class,'create']);
    Route::post('/tasks',[TaskController::class,'store']);
    Route::get('/tasks/{task}/edit',[TaskController::class,'edit']);
    Route::put('/tasks/{task}',[TaskController::class,'update']);
    Route::delete('/tasks/{task}',[TaskController::class,'destroy']);
    Route::post('/tasks/{id}/restore',[TaskController::class,'restore']);
});