<?php

use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\DonHangController;
use App\Http\Controllers\Admins\MaKhuyenMaiController;
use App\Http\Controllers\Admins\SanPhamController;
    use App\Http\Controllers\Admins\ThongTinTrangWebController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    // return view('login');
});

Route::get('/dashboard', function () {
    return view('admins.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ADMIN
Route::prefix('admins')
    ->as('admins.')
    ->group(function () {
        
        Route::prefix('categories')
        ->as('categories.')
        ->group(function () {
            Route::get('/',                 [CategoryController::class, 'index'])->name('index');
            Route::get('/create',           [CategoryController::class, 'create'])->name('create');
            Route::post('/store',           [CategoryController::class, 'store'])->name('store');
        //     Route::get('/show/{id}',        [CategoryController::class, 'show'])->name('show');
            Route::get('{id}/edit',         [CategoryController::class, 'edit'])->name('edit');
            Route::put('{id}/update',       [CategoryController::class, 'update'])->name('update');
            Route::delete('{id}/destroy',   [CategoryController::class, 'destroy'])->name('destroy');
            
        });
        
        Route::prefix('sanphams')
        ->as('sanphams.')
        ->group(function () {
            Route::get('/',                 [SanPhamController::class, 'index'])->name('index');
        });
        Route::prefix('donhangs')
        ->as('donhangs.')
        ->group(function () {
            Route::get('/',                 [DonHangController::class, 'index'])->name('index');
        });
        Route::prefix('makhuyenmais')
        ->as('makhuyenmais.')
        ->group(function () {
            Route::get('/',                 [MaKhuyenMaiController::class, 'index'])->name('index');
        });

        Route::prefix('taikhoans')
         ->as('taikhoans.')
         ->group(function (){
             Route::get('/',                 [UserController::class,'index'])->name('index');
             Route::get('/create',                 [UserController::class,'create'])->name('create');
             Route::post('/store',                 [UserController::class,'store'])->name('store');
             Route::get('/edit/{id}',                 [UserController::class,'edit'])->name('edit');
             Route::get('/show/{id}',        [UserController::class,'show'])->name('show');
             Route::put('{id}/update',       [UserController::class,'update'])->name('update');
             Route::delete('{id}/destroy',   [UserController::class,'destroy'])->name('destroy');
         });

        Route::prefix('thongtintrangwebs')
        ->as('thongtintrangwebs.')
        ->group(function () {
            Route::get('/',                 [ThongTinTrangWebController::class, 'index'])->name('index');
        });
        
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/test-cache-driver', function () {
    return config('cache.default');
});
require __DIR__.'/auth.php';
