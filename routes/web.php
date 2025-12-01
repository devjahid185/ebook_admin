<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookPartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ADMIN LOGIN
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// PROTECTED ADMIN AREA
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // USER MANAGEMENT
    Route::resource('/admin/users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // CATEGORY MANAGEMENT
    Route::resource('/admin/categories', CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

    // BOOK MANAGEMENT
    Route::resource('/admin/books', BookController::class)->names([
        'index' => 'admin.books.index',
        'create' => 'admin.books.create',
        'store' => 'admin.books.store',
        'edit' => 'admin.books.edit',
        'update' => 'admin.books.update',
        'destroy' => 'admin.books.destroy',
        'toggleStatus' => 'admin.books.toggleStatus',
    ]);

    Route::patch(
        '/books/{book}/toggle-status',
        [BookController::class, 'toggleStatus']
    )->name('admin.books.toggle-status');

    // BOOK PARTS MANAGEMENT
    Route::prefix('admin/books/{book}/parts')->name('admin.books.parts.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BookPartController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\BookPartController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\BookPartController::class, 'store'])->name('store');
        Route::get('/{part}/edit', [App\Http\Controllers\Admin\BookPartController::class, 'edit'])->name('edit');
        Route::put('/{part}', [App\Http\Controllers\Admin\BookPartController::class, 'update'])->name('update');
        Route::delete('/{part}', [App\Http\Controllers\Admin\BookPartController::class, 'destroy'])->name('destroy');
        // ✔ FIXED ACCEPT ROUTE
        Route::post('/{part}/accept', [BookPartController::class, 'accept'])
            ->name('accept');
    });

    // BANNER MANAGEMENT
    Route::resource('/admin/banners', App\Http\Controllers\Admin\BannerController::class)->names([
        'index' => 'admin.banners.index',
        'create' => 'admin.banners.create',
        'store' => 'admin.banners.store',
        'edit' => 'admin.banners.edit',
        'update' => 'admin.banners.update',
        'destroy' => 'admin.banners.destroy',
    ]);
});

require __DIR__ . '/auth.php';
