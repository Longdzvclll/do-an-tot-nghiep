<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;

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


Route::get('/admin-login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [LoginController::class, 'login']);

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::resource('news_categories', NewsCategoryController::class);

    Route::resource('news', NewsController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('category_products', CategoryProductController::class);

    Route::resource('products', ProductController::class);

    Route::get('product_images/delete/{id}', [ProductImageController::class, 'delete'])->name('product_images.delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::resource('slides', SlideController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/danh-muc-san-pham/{slug}', [CategoryProductController::class, 'showCategory'])->name('category.products');

Route::get('/san-pham', [ProductController::class, 'listProducts'])->name('products.list');

Route::get('/search', [ProductController::class, 'search'])->name('search');


// Route để hiển thị chi tiết sản phẩm theo slug
Route::get('/san-pham/{slug}', [ProductController::class, 'showProduct'])->name('product.show');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/thanh-toan', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('thanh-toan/order-received', [CheckoutController::class, 'success'])->name('checkout.thankyou');

Route::get('tin-tuc', [FrontendNewsController::class, 'index'])->name('news.list');
Route::get('tin-tuc/{slug}', [FrontendNewsController::class, 'newDetail'])->name('news.detail');
Route::get('/category/{slug}', [FrontendNewsController::class, 'listNewsByCategory'])->name('category.news');

Route::view('/gioi-thieu', 'frontend.pages.gioi-thieu')->name('pages.gioi-thieu');
Route::view('/chinh-sach-doi-tra', 'frontend.pages.chinh-sach-doi-tra')->name('pages.chinh-sach-doi-tra');
Route::view('/chinh-sach-bao-mat', 'frontend.pages.chinh-sach-bao-mat')->name('pages.chinh-sach-bao-mat');
Route::view('/dieu-khoan-dich-vu', 'frontend.pages.dieu-khoan-dich-vu')->name('pages.dieu-khoan-dich-vu');
