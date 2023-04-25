<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {


    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'access:user'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
//middleware(['auth', 'access:admin'])->name('admin.')->prefix('admin')->
Route::group(['middleware' => 'auth','prefix' => 'admin', 'as' => 'admin.'],function () {
 Route::get('/dashboard', [HomeController::class, 'admin'])->name('home');
Route::resource('categories',CategoryController::class);
Route::resource('brands',BrandController::class);
Route::resource('coupons',CouponController::class);
Route::resource('products',ProductController::class);
});

