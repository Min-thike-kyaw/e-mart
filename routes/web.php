<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api/hello',[ IndexController::class, 'api']);

// Route::get('/', [IndexController::class,'home'])->('home');

Route::get('/', [IndexController::class,'home'])->name('welcome');
Route::get('/products/{slug}', [IndexController::class,'productDetail'])->name('product-detail');
Route::get('/categories/{slug}', [IndexController::class,'categoryProduct'])->name('category-product');
Route::get('/user/auth', [IndexController::class,'userAuth'])->name('user.auth');
Route::post('/user/login', [IndexController::class,'userLogin'])->name('user.login');
Route::post('/user/register', [IndexController::class,'userRegister'])->name('user.register');
Route::get('/user/logout', [IndexController::class,'userLogout'])->name('user.logout');


Route::prefix('user')->group(function () {
    Route::get('/dashboard', [IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order', [IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address', [IndexController::class,'userAccount'])->name('user.address');
    Route::get('/account-detail', [IndexController::class,'userAccount'])->name('user.detail');
});



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class,'admin'])->name('admin');

    //Banner
    Route::get('/banner',[BannerController::class,'index'])->name('banner');
    Route::get('/banner/create',[BannerController::class,'create'])->name('banner.create');
    Route::post('/banner',[BannerController::class,'store'])->name('banner.store');
    Route::post('/banner/status',[BannerController::class,'bannerStatus'])->name('banner.status');
    Route::get('/banner/{banner}/edit',[BannerController::class,'edit'])->name('banner.edit');
    Route::put('/banner/{banner}',[BannerController::class,'update'])->name('banner.update');
    Route::delete('/banner/{banner}',[BannerController::class,'delete'])->name('banner.delete');

    //Category
    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category',[CategoryController::class,'store'])->name('category.store');
    Route::post('/category/status',[CategoryController::class,'categoryStatus'])->name('category.status');
    Route::get('/category/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/category/{category}',[CategoryController::class,'delete'])->name('category.delete');

    //Brand
    Route::get('/brand',[BrandController::class,'index'])->name('brand');
    Route::get('/brand/create',[BrandController::class,'create'])->name('brand.create');
    Route::post('/brand',[BrandController::class,'store'])->name('brand.store');
    Route::post('/brand/status',[BrandController::class,'brandStatus'])->name('brand.status');
    Route::get('/brand/{brand}/edit',[BrandController::class,'edit'])->name('brand.edit');
    Route::put('/brand/{brand}',[BrandController::class,'update'])->name('brand.update');
    Route::delete('/brand/{brand}',[BrandController::class,'delete'])->name('brand.delete');

    //Product
    Route::get('/product',[ProductController::class,'index'])->name('product');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product',[ProductController::class,'store'])->name('product.store');
    Route::post('/product/{id}',[ProductController::class,'getChildrenById'])->name('product.cat-children');
    Route::post('/product/status',[ProductController::class,'productStatus'])->name('product.status');
    Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::put('/product/{product}',[ProductController::class,'update'])->name('product.update');
    Route::delete('/product/{product}',[ProductController::class,'delete'])->name('product.delete');
});
