<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\BookPartApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\UserSummaryController;

Route::post('/register', [UserController::class, "register"]);
Route::post('/login', [UserController::class, "login"]);

// Admin panel user create
Route::post('/admin/user/create', [UserController::class, "adminCreateUser"]);

Route::get('/books', [BookApiController::class, 'index']); // List books
Route::post('/books', [BookApiController::class, 'store']); // Create book
Route::get('/books/{book}', [BookApiController::class, 'show']); // View single book
Route::put('/books/{book}', [BookApiController::class, 'update']);
Route::patch('/books/{book}', [BookApiController::class, 'update']);
Route::delete('/books/{book}', [BookApiController::class, 'destroy']);

Route::get('/categories', [CategoryApiController::class, 'index']); // All categories
Route::get('/categories/{slug}', [CategoryApiController::class, 'show']); // Single category by slug

Route::post('/book/review', [BookApiController::class, 'reviewstore']);
Route::get('/book/{book_id}/reviews', [BookApiController::class, 'list']);

Route::get('/banners', [BannerApiController::class, 'index']);

Route::get('/user/{id}/summary', [UserSummaryController::class, 'summary']);

Route::get('/books/{book}/parts', [BookPartApiController::class, 'index']);
Route::get('/books/{book}/parts/{part}', [BookPartApiController::class, 'show']);
Route::post('/books/{book}/parts', [BookPartApiController::class, 'store']);
Route::post('/books/{book}/parts/{part}/update', [BookPartApiController::class, 'update']);
Route::delete('/book-parts/{part}', [BookPartApiController::class, 'destroy']);
