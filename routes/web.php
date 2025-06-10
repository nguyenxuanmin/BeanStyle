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
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\InstructController;
use App\Http\Controllers\Client\HomeController;

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
        // Kích thước sản phẩm
        Route::get('/product-size/{id}', [ProductSizeController::class, 'update'])->name('update_product_size');
        Route::post('/product-size/save', [ProductSizeController::class, 'save'])->name('save_product_size');
        Route::post('/product-size/delete', [ProductSizeController::class, 'delete'])->name('delete_product_size');
        // Màu sắc sản phẩm
        Route::get('/product-color/{id}', [ProductColorController::class, 'update'])->name('update_product_color');
        Route::post('/product-color/save', [ProductColorController::class, 'save'])->name('save_product_color');
        Route::post('/product-color/delete', [ProductColorController::class, 'delete'])->name('delete_product_color');
        // Slider
        Route::get('/slider', [SliderController::class, 'show'])->name('list_slider');
        Route::get('/slider/add', [SliderController::class, 'add'])->name('add_slider');
        Route::post('/slider/save', [SliderController::class, 'save'])->name('save_slider');
        Route::post('/slider/delete', [SliderController::class, 'delete'])->name('delete_slider');
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('edit_slider');
        Route::get('/slider/search', [SliderController::class, 'search'])->name('search_slider');
        // Lợi ích
        Route::get('/benefit', [BenefitController::class, 'show'])->name('list_benefit');
        Route::get('/benefit/add', [BenefitController::class, 'add'])->name('add_benefit');
        Route::post('/benefit/save', [BenefitController::class, 'save'])->name('save_benefit');
        Route::post('/benefit/delete', [BenefitController::class, 'delete'])->name('delete_benefit');
        Route::get('/benefit/edit/{id}', [BenefitController::class, 'edit'])->name('edit_benefit');
        Route::get('/benefit/search', [BenefitController::class, 'search'])->name('search_benefit');
        // Bộ sưu tập
        Route::get('/collection', [CollectionController::class, 'show'])->name('list_collection');
        Route::get('/collection/add', [CollectionController::class, 'add'])->name('add_collection');
        Route::post('/collection/save', [CollectionController::class, 'save'])->name('save_collection');
        Route::post('/collection/delete', [CollectionController::class, 'delete'])->name('delete_collection');
        Route::get('/collection/edit/{id}', [CollectionController::class, 'edit'])->name('edit_collection');
        Route::get('/collection/search', [CollectionController::class, 'search'])->name('search_collection');
        // Quảng cáo
        Route::get('/advertisement', [AdvertisementController::class, 'show'])->name('list_advertisement');
        Route::get('/advertisement/add', [AdvertisementController::class, 'add'])->name('add_advertisement');
        Route::post('/advertisement/save', [AdvertisementController::class, 'save'])->name('save_advertisement');
        Route::post('/advertisement/delete', [AdvertisementController::class, 'delete'])->name('delete_advertisement');
        Route::get('/advertisement/edit/{id}', [AdvertisementController::class, 'edit'])->name('edit_advertisement');
        Route::get('/advertisement/search', [AdvertisementController::class, 'search'])->name('search_advertisement');
        // Tin tức
        Route::get('/blog', [BlogController::class, 'show'])->name('list_blog');
        Route::get('/blog/add', [BlogController::class, 'add'])->name('add_blog');
        Route::post('/blog/save', [BlogController::class, 'save'])->name('save_blog');
        Route::post('/blog/delete', [BlogController::class, 'delete'])->name('delete_blog');
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('edit_blog');
        Route::get('/blog/search', [BlogController::class, 'search'])->name('search_blog');
        // Chính sách
        Route::get('/policy', [PolicyController::class, 'show'])->name('list_policy');
        Route::get('/policy/add', [PolicyController::class, 'add'])->name('add_policy');
        Route::post('/policy/save', [PolicyController::class, 'save'])->name('save_policy');
        Route::post('/policy/delete', [PolicyController::class, 'delete'])->name('delete_policy');
        Route::get('/policy/edit/{id}', [PolicyController::class, 'edit'])->name('edit_policy');
        Route::get('/policy/search', [PolicyController::class, 'search'])->name('search_policy');
        // Hướng dẫn
        Route::get('/instruct', [InstructController::class, 'show'])->name('list_instruct');
        Route::get('/instruct/add', [InstructController::class, 'add'])->name('add_instruct');
        Route::post('/instruct/save', [InstructController::class, 'save'])->name('save_instruct');
        Route::post('/instruct/delete', [InstructController::class, 'delete'])->name('delete_instruct');
        Route::get('/instruct/edit/{id}', [InstructController::class, 'edit'])->name('edit_instruct');
        Route::get('/instruct/search', [InstructController::class, 'search'])->name('search_instruct');
    });
    Route::group(['middleware' => [LoginAuth::class]], function () {
        Route::get('/admin/login', function () {return view('admin.login');})->name('login');
        Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    });

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/ajax-all-product', [HomeController::class, 'ajaxAllProduct'])->name('ajax_all_product');
});

Route::group(['middleware' => [CheckSystemAuth::class]], function () {
    Route::get('/system', [SystemController::class, 'index'])->name('system');
    Route::post('/system', [SystemController::class, 'save'])->name('save_system');
});
