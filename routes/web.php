<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubcatController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('show');

Route::get('/soon', [HomeController::class, 'showSoon'])->name('soon');
Route::get('/all', [HomeController::class, 'showAll'])->name('all');
Route::get('/incredible', [HomeController::class, 'showIncredible'])->name('incredible');
Route::get('/running_out', [HomeController::class, 'showRunningOut'])->name('running_out');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['role:super_admin|admin|writer|shop_owner'])->name('dashboard');

//products-------

Route::get('/main/{category}', SubcatController::class)->name('subcat');
Route::get('/card', CardController::class)->name('card');
Route::get('/purchase', PurchaseController::class)->name('purchase');


Route::group(['middleware' => ['role:super_admin|admin|writer|shop_owner']], function () {
    Route::resource('/products', ProductController::class)->except('show');

    Route::delete('/products/{product}/force', [ProductController::class, 'forceDelete'])
        ->name('products.forceDelete')->middleware(['role:super_admin|admin']);

    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore')->middleware(['role:super_admin|admin']);
});
//admin

Route::prefix('/admin')->name('admin.')->group(function () {

    //users----------

    Route::resource('/user', UserController::class)->middleware(['role:super_admin|admin']);

    Route::delete('/user/{user}/force', [UserController::class, 'forceDelete'])
        ->middleware(['role:super_admin'])
        ->name('user.forceDelete');

    Route::patch('/user/{user}/restore', [UserController::class, 'restore'])
        ->middleware(['role:super_admin|admin'])
        ->name('user.restore');
});

Auth::routes();

//category

Route::resource('/category', CategoryController::class);

Route::get('clearsession', function () {
    session()->flush();
});

//profile----------

Route::resource('/profile', ProfileController::class)->except(['show', 'store', 'create'])->middleware('auth');
