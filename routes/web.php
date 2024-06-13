<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//AdminController
Route::prefix('/admin')->as('admin.')->group(function () {
    Route::middleware(["auth", "admin"])->group(function () {
        Route::get('/', [AdminController::class, "dashboard"])->name('dashboard');
        Route::get('/products/search', [AdminController::class, "search"])->name('search');

        Route::prefix('/products')->as('products.')->group(function () {
            Route::get('/index', [ProductController::class, "index"])->name('index');
            Route::get('/create', [ProductController::class, "create"])->name('create');
            Route::get("/edit/{product}", [ProductController::class, "edit"])->name('edit');
            Route::post('/update/{product}', [ProductController::class, "update"])->name('update');
            Route::post('/store', [ProductController::class, "store"])->name('store');
            Route::get('/delete/{product}', [ProductController::class, "delete"])->name('delete');
        });

        Route::prefix('/categories')->as('categories.')->group(function () {
            Route::get('/index', [CategoryController::class, "index"])->name('index');
            Route::get('/create', [CategoryController::class, "create"])->name('create');
            Route::get('/edit/{category}', [CategoryController::class, "edit"])->name('edit');
            Route::post('/update/{category}', [CategoryController::class, "update"])->name('update');
            Route::post('/store', [CategoryController::class, "store"])->name('store');
            //edit post
            Route::get('/delete/{category}', [CategoryController::class, "delete"])->name('delete');
        });

        Route::prefix('/orders')->as('orders.')->group(function () {
            Route::get('/index', [OrderController::class, "index"])->name('index');
            Route::get('/detail/{order}', [OrderController::class, "detail"])->name('detail');
            Route::get('/filter', [OrderController::class, "filter"])->name('filter');
        });

    });
});

Route::prefix('/web')->as('web.')->group(function () {

    Route::prefix('/carts')->as('carts.')->group(function () {
        Route::get('/index', [CartController::class, 'index'])->name('index');
        Route::get('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::get('/reduce/{product}', [CartController::class, 'reduce'])->name('reduce');
        Route::get('/remove/{product}', [CartController::class, 'remove'])->name('remove');
        Route::get('/checkout', [CartController::class, "checkout"])->name('checkout');
    });

//PageController
    Route::get('/', [PageController::class, "welcome"])->name("welcome");
    Route::get('/contact', [PageController::class, "contact"])->name("contact");
    Route::get('/shop', [PageController::class, "shop"])->name("shop");
    Route::get('/products/{category}', [PageController::class, "productCategory"])->name('productsCategory');
    Route::get('/thankyou/{order}', [PageController::class, "thankyou"])->name('thankyou');

//Auth views
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

    Route::get('/cancelTransaction/{order}', [OrderController::class, "cancelTransaction"])->name('cancelTransaction');
    Route::get('/successTransaction/{order}', [OrderController::class, "successTransaction"])->name('successTransaction');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::prefix('/api')->as('api.')->group(function () {
    Route::get('/search', [PageController::class, "search"])->name('search');

    //Auth
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //PlaceOrder
    Route::post('/placeOrder', [OrderController::class, "placeOrder"])->name('placeOrder');
});
