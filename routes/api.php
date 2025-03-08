<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Support\Facades\Route;

/**
 * @see UserController
 * @see ProductController
 * @see CategoryController
 * @see ImageController
 * @see ReviewController
 * @see OrderController
 */

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getUser']);

    Route::post('/products', [ProductController::class, 'store'])->middleware(SellerMiddleware::class);

    Route::post('/products/{product}/images', [ImageController::class, 'store'])->middleware(SellerMiddleware::class);
    Route::put('/products/{product}/images/{image}/set-main', [ImageController::class, 'setMainImage'])->middleware(SellerMiddleware::class);
    Route::delete('/products/{product}/images/{image}', [ImageController::class, 'destroy'])->middleware(SellerMiddleware::class);

    Route::post('/categories', [CategoryController::class, 'store'])->middleware(AdminMiddleware::class);
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware(AdminMiddleware::class);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware(AdminMiddleware::class);

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->middleware(AdminMiddleware::class);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/products/{product}/reviews', [ReviewController::class, 'index']);
