<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;

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
    // Route::post('/tasks/{id}/restore',[TaskController::class,'restore']);

    Route::get('/users',[UserController::class,'index']);
    Route::delete('/users/{user}',[UserController::class,'destroy']);
    Route::post('/users/{id}/restore',[UserController::class,'restore']);
    Route::post('/users/{user}/assign-role', [UserController::class,'assignRole']);

    Route::post('/tasks/{task}/request-publish',[TaskController::class,'requestPublish']);
    Route::get('/publish-requests',[TaskController::class,'publishRequests']);

    Route::post('/tasks/{task}/review',[TaskController::class,'markReview']);
    Route::post('/tasks/{task}/approve',[TaskController::class,'approve']);
    Route::get('/published/{task}', [TaskController::class,'showPublished']);


    Route::post('/request-author',[RoleRequestController::class,'requestAuthor']);
    Route::post('/request-editor',[RoleRequestController::class,'requestEditor']);
    
    Route::get('/role-requests',[RoleRequestController::class,'index']);

    Route::post('/role-requests/{roleRequest}/approve', [RoleRequestController::class,'approve']);

    Route::post('/role-requests/{roleRequest}/reject', [RoleRequestController::class,'reject']);

    // Blog routes
    // Route::get('/blogs',[BlogController::class,'index']);
    Route::get('/my-blogs',[BlogController::class,'myBlogs']);

    Route::get('/blogs/create',[BlogController::class,'create']);
    Route::post('/blogs',[BlogController::class,'store']);

    Route::get('/blogs/{blog}/edit',[BlogController::class,'edit']);
    Route::put('/blogs/{blog}',[BlogController::class,'update']);

    Route::get('/blogs/review',[BlogController::class,'reviewList']);

    Route::post('/blogs/{blog}/review',[BlogController::class,'markReview']);
    Route::post('/blogs/{blog}/approve',[BlogController::class,'approve']);
    Route::post('/blogs/{blog}/reject',[BlogController::class,'reject']);

    Route::get('/blogs/{blog}/pay', [PaymentController::class,'show']);

    Route::post('/blogs/{blog}/pay', [PaymentController::class,'initiate']);
    Route::get('/payment-gateway/{blog}', [PaymentController::class,'gateway'])->name('payment.gateway');
    Route::get('/payment-success/{blog}', [PaymentController::class,'success']);

    Route::get('/my-purchases', [PaymentController::class,'myPurchases']);

});

Route::get('/blogs',[BlogController::class,'index']);
Route::get('/blogs/{blog}', [BlogController::class,'show'])->name('blogs.show');

Route::get('/published',[TaskController::class,'published']);

Route::middleware(['role:supervisor'])->group(function () {
    Route::post('/tasks/{id}/restore',[TaskController::class,'restore']);
});

// ->middleware('auth');