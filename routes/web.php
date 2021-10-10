<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $products = Product::withoutTrashed()->where('is_incredible', 1)->get();
    return view('product.home')->with('products' , $products);
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//products-------

Route::resource('/product', ProductController::class);

Route::delete('/product/{product}/force', [ProductController::class, 'forceDelete'])
    ->name('product.forceDelete');

Route::patch('/product/{product}/restore', [ProductController::class, 'restore'])
    ->name('product.restore');

Route::get('/dproduct', [ProductController::class, 'deletedProducts'])
    ->name('product.deleted');


Route::prefix('/admin')->name('admin.')->group(function(){

    //users----------

    Route::resource('/user', UserController::class);

    Route::delete('/user/{user}/force', [UserController::class, 'forceDelete'])
        ->name('user.forceDelete');

    Route::patch('/user/{user}/restore', [UserController::class, 'restore'])
        ->name('user.restore');

});

//Auth::routes();

    //category

Route::resource('/category', CategoryController::class);

