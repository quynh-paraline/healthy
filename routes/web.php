<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\OrdersController;
use App\Http\Controllers\Web\ProductsController;
use Illuminate\Support\Facades\Route;

//AdminController
Route::prefix('/admin')->as('admin.')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(["auth", "filter_role_orders_access"])->group(function () {
        Route::get('/', [DashboardController::class, "dashboard"])->name('dashboard');

        Route::prefix('/users')->as('users.')->group(function () {
            Route::get('/index', [UsersController::class, "index"])->name('index');
            Route::get('/edit/{user}', [UsersController::class, "edit"])->name('edit');
            Route::get('/create', [UsersController::class, "create"])->name('create');
            Route::post('/update/{user}', [UsersController::class, "update"])->name('update');
            Route::post('/store', [UsersController::class, "store"])->name('store');
            Route::get('/delete/{user}', [UsersController::class, "delete"])->name('delete');
        });

        Route::prefix('/products')->as('products.')->group(function () {
            Route::get('/index', [ProductController::class, "index"])->name('index');
            Route::get('/create', [ProductController::class, "create"])->name('create');
            Route::get("/edit/{product}", [ProductController::class, "edit"])->name('edit');
            Route::post('/update/{product}', [ProductController::class, "update"])->name('update');
            Route::post('/store', [ProductController::class, "store"])->name('store');
            Route::get('/delete/{product}', [ProductController::class, "delete"])->name('delete');
        });

        Route::prefix('/administrators')->as('administrators.')->group(function () {
            Route::get('/index', [AdministratorController::class, "index"])->name('index');
            Route::get('/create', [AdministratorController::class, "create"])->name('create');
            Route::get("/edit/{administrator}", [AdministratorController::class, "edit"])->name('edit');
            Route::post('/update/{administrator}', [AdministratorController::class, "update"])->name('update');
            Route::post('/store', [AdministratorController::class, "store"])->name('store');
            Route::get('/delete/{administrator}', [AdministratorController::class, "delete"])->name('delete');
        });

        Route::prefix('/categories')->as('categories.')->group(function () {
            Route::get('/index', [CategoriesController::class, "index"])->name('index');
            Route::get('/create', [CategoriesController::class, "create"])->name('create');
            Route::get('/edit/{category}', [CategoriesController::class, "edit"])->name('edit');
            Route::post('/update/{category}', [CategoriesController::class, "update"])->name('update');
            Route::post('/store', [CategoriesController::class, "store"])->name('store');
            //edit post
            Route::get('/delete/{category}', [CategoriesController::class, "delete"])->name('delete');
        });
    });

    Route::prefix('/orders')->as('orders.')->group(function () {
            Route::get('/index', [OrderController::class, "index"])->name('index');
            Route::get('/detail/{order}', [OrderController::class, "detail"])->name('detail');
            Route::get('/filter', [OrderController::class, "filter"])->name('filter');
            Route::get('/status/{order}', [OrderController::class, "updateStatus"])->name('status');
            Route::get('/cancel/{order}', [OrderController::class, "cancelStatus"])->name('cancel');
            Route::get('/cancelReturns/{order}', [OrderController::class, "cancelReturns"])->name('cancelReturns');
    });
});


Route::prefix('/')->as('web.')->group(function () {

    Route::prefix('/carts')->as('carts.')->group(function () {
        Route::get('/index', [CartController::class, 'index'])->name('index');
        Route::get('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::get('/reduce/{product}', [CartController::class, 'reduce'])->name('reduce');
        Route::get('/remove/{product}', [CartController::class, 'remove'])->name('remove');
        Route::get('/checkout', [CartController::class, "checkout"])->name('checkout');
    });

    Route::get('/', [\App\Http\Controllers\Web\HomeController::class, "index"])->name("welcome");
    Route::get('/contact', [ContactController::class, "index"])->name("contact");
    Route::get('/shop', [ProductsController::class, "index"])->name("shop");
    Route::get('/filter/{category}', [ProductsController::class, "filter"])->name('filter');

    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/index', [OrdersController::class, "index"])->name('index');
        Route::get('/invoice/{order}', [OrdersController::class, "invoice"])->name('invoice');
        Route::get('/cancel/{order}', [OrdersController::class, "cancel"])->name('cancel');
        Route::get('/returns/{order}', [OrdersController::class, "returns"])->name('returns');
    });

    //Auth
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //PlaceOrder
    Route::post('/placeOrder', [CheckoutController::class, "placeOrder"])->name('placeOrder');
    Route::get('/cancelTransaction/{order}', [CheckoutController::class, "cancelTransaction"])->name('cancelTransaction');
    Route::get('/successTransaction/{order}', [CheckoutController::class, "successTransaction"])->name('successTransaction');
    Route::get('/thankyou/{order}', [CheckoutController::class, "thankyou"])->name('thankyou');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::prefix('/api')->as('api.')->group(function () {

});
