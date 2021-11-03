<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CardController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $products = Product::withoutTrashed()->paginate(12);
    $incredibleProducts = Product::where('is_incredible', 1)->get();
    return view('product.home', compact('products','incredibleProducts'));
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

//products-------

Route::get('/main/{category}', [HomeController::class,'index'])->name('home.index');
Route::get('/shop', ShopController::class);
Route::get('/card', CardController::class)->name('card');

Route::resource('/product', ProductController::class);

Route::delete('/product/{product}/force', [ProductController::class, 'forceDelete'])
    ->name('product.forceDelete');

Route::patch('/product/{product}/restore', [ProductController::class, 'restore'])
    ->name('product.restore');

//admin

Route::prefix('/admin')->name('admin.')->group(function () {

    //users----------

    Route::resource('/user', UserController::class);

    Route::delete('/user/{user}/force', [UserController::class, 'forceDelete'])
        ->name('user.forceDelete');

    Route::patch('/user/{user}/restore', [UserController::class, 'restore'])
        ->name('user.restore');
});

Auth::routes();

//category

Route::resource('/category', CategoryController::class);

Route::get('clearsession', function () {
    session()->flush();
});

