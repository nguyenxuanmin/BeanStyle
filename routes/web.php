<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SystemAuth;
use App\Http\Middleware\CheckSystemAuth;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginAuth;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSizeController;

Route::group(['middleware' => [SystemAuth::class]], function () {
    Route::group(['middleware' => [AdminAuth::class]], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
        // Danh mục sản phẩm
        Route::get('/category', [CategoryController::class, 'show'])->name('list_category');
        Route::get('/category/add', [CategoryController::class, 'add'])->name('add_category');
        Route::post('/category/save', [CategoryController::class, 'save'])->name('save_category');
        Route::post('/category/delete', [CategoryController::class, 'delete'])->name('delete_category');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit_category');
        Route::get('/category/search', [CategoryController::class, 'search'])->name('search_category');
        // Danh mục sản phẩm cấp 1
        Route::get('/sub-category', [SubCategoryController::class, 'show'])->name('list_sub_category');
        Route::get('/sub-category/add', [SubCategoryController::class, 'add'])->name('add_sub_category');
        Route::post('/sub-category/save', [SubCategoryController::class, 'save'])->name('save_sub_category');
        Route::post('/sub-category/delete', [SubCategoryController::class, 'delete'])->name('delete_sub_category');
        Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit_sub_category');
        Route::get('/sub-category/search', [SubCategoryController::class, 'search'])->name('search_sub_category');
        // Thương hiệu
        Route::get('/brand', [BrandController::class, 'show'])->name('list_brand');
        Route::get('/brand/add', [BrandController::class, 'add'])->name('add_brand');
        Route::post('/brand/save', [BrandController::class, 'save'])->name('save_brand');
        Route::post('/brand/delete', [BrandController::class, 'delete'])->name('delete_brand');
        Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit_brand');
        Route::get('/brand/search', [BrandController::class, 'search'])->name('search_brand');
        // Kích thước
        Route::get('/size', [SizeController::class, 'show'])->name('list_size');
        Route::get('/size/add', [SizeController::class, 'add'])->name('add_size');
        Route::post('/size/save', [SizeController::class, 'save'])->name('save_size');
        Route::post('/size/delete', [SizeController::class, 'delete'])->name('delete_size');
        Route::get('/size/edit/{id}', [SizeController::class, 'edit'])->name('edit_size');
        Route::get('/size/search', [SizeController::class, 'search'])->name('search_size');
        // Kích thước
        Route::get('/color', [ColorController::class, 'show'])->name('list_color');
        Route::get('/color/add', [ColorController::class, 'add'])->name('add_color');
        Route::post('/color/save', [ColorController::class, 'save'])->name('save_color');
        Route::post('/color/delete', [ColorController::class, 'delete'])->name('delete_color');
        Route::get('/color/edit/{id}', [ColorController::class, 'edit'])->name('edit_color');
        Route::get('/color/search', [ColorController::class, 'search'])->name('search_color');
        // Sản phẩm
        Route::get('/product', [ProductController::class, 'show'])->name('list_product');
        Route::get('/product/add', [ProductController::class, 'add'])->name('add_product');
        Route::post('/product/save', [ProductController::class, 'save'])->name('save_product');
        Route::post('/product/delete', [ProductController::class, 'delete'])->name('delete_product');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('edit_product');
        Route::get('/product/search', [ProductController::class, 'search'])->name('search_product');
        // Kích thước Sản phẩm
        Route::get('/product-size/{id}', [ProductSizeController::class, 'update'])->name('update_product_size');
        Route::post('/product-size/save', [ProductSizeController::class, 'save'])->name('save_product_size');
        Route::post('/product-size/delete', [ProductSizeController::class, 'delete'])->name('delete_product_size');
    });
    Route::group(['middleware' => [LoginAuth::class]], function () {
        Route::get('/admin/login', function () {return view('admin.login');})->name('login');
        Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    });

    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => [CheckSystemAuth::class]], function () {
    Route::get('/system', [SystemController::class, 'index'])->name('system');
    Route::post('/system', [SystemController::class, 'save'])->name('save_system');
});
