<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CheckoutApiController;
use App\Http\Controllers\Api\OrdersApiController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\WelcomeApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->as('web.')->group(function () {
    Route::view("/", "app")->where("web.welcome", ".*")->name("welcome");
    Route::view("/contact", "app")->where("web.contact", ".*");

    Route::view("/products/index", "app")->where("products.index", ".*");
    Route::view("/products/filter/{id}", "app")->where("products.filter", ".*");

    Route::view("/checkouts/thankyou/{id}", "app")->where("checkouts.thankyou", ".*");
    Route::view("/checkouts/index", "app")->where("checkouts.index", ".*");

    Route::view("/carts/index", "app")->where("carts.index", ".*");

    Route::view("/orders/index", "app")->where("orders.index", ".*");
    Route::view("/orders/detail/{id}", "app")->where("orders.detail", ".*");
});

Route::prefix('/api')->as('api.')->group(function () {
    Route::get('/home/index', [WelcomeApiController::class, 'index']);

    Route::get('/products/index', [ProductsApiController::class, 'index']);
    Route::get('/products/filter/{id}', [ProductsApiController::class, 'filter']);

    Route::get('/carts/index', [CartApiController::class, 'index']);
    Route::post('/carts/add/{id}', [CartApiController::class, 'add']);
    Route::post('/carts/remove/{id}', [CartApiController::class, 'remove']);
    Route::post('/carts/reduce/{id}', [CartApiController::class, 'reduce']);
    Route::get('/carts/count', [CartApiController::class, 'count']);

    Route::get('/orders/index', [OrdersApiController::class, 'index']);
    Route::get('/orders/detail/{id}', [OrdersApiController::class, 'detail']);

    Route::post('/checkout/placeOrder', [CheckoutApiController::class, 'placeOrder']);
    Route::get('/checkout/successTransaction/{id}', [CheckoutApiController::class, 'successTransaction'])->name("checkout.successTransaction");
    Route::get('/checkout/cancelTransaction', [CheckoutApiController::class, 'cancelTransaction'])->name("checkout.cancelTransaction");
});


//AdminController
Route::prefix('/admin')->as('admin.')->group(function () {

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(["auth", "filter_role_orders_access"])->group(function () {
        Route::get('/', \App\Livewire\Dashboard\Index::class)->name('dashboard');

        Route::prefix('/users')->as('users.')->group(function () {
            Route::get('/index', \App\Livewire\Users\Index::class)->name('index');
            Route::get('/edit/{id}', \App\Livewire\Users\Edit::class)->name('edit');
            Route::get('/create', \App\Livewire\Users\Create::class)->name('create');
        });

        Route::prefix('/products')->as('products.')->group(function () {
            Route::get('/index', \App\Livewire\Products\Index::class)->name('index');
            Route::get('/create', \App\Livewire\Products\Create::class)->name('create');
            Route::get('/edit/{id}', \App\Livewire\Products\Edit::class)->name('edit');
        });

        Route::prefix('/administrators')->as('administrators.')->group(function () {
            Route::get('/index', \App\Livewire\Administrators\Index::class)->name('index');
            Route::get('/create', \App\Livewire\Administrators\Create::class)->name('create');
            Route::get("/edit/{id}", \App\Livewire\Administrators\Edit::class)->name('edit');
        });

        Route::prefix('/categories')->as('categories.')->group(function () {
            Route::get('/index', \App\Livewire\Categories\Index::class)->name('index');
            Route::get('/create', \App\Livewire\Categories\Create::class)->name('create');
            Route::get('/edit/{id}', \App\Livewire\Categories\Edit::class)->name('edit');
        });

        Route::prefix('/orders')->as('orders.')->group(function () {
            Route::get('/index', \App\Livewire\Orders\Index::class)->name('index');
            Route::get('/detail/{id}', \App\Livewire\Orders\Detail::class)->name('detail');
        });
    });
});


//Route::prefix('/')->as('web.')->group(function () {
//
//    Route::prefix('/carts')->as('carts.')->group(function () {
//        Route::get('/index', [CartController::class, 'index'])->name('index');
//        Route::get('/add/{product}', [CartController::class, 'add'])->name('add');
//        Route::get('/reduce/{product}', [CartController::class, 'reduce'])->name('reduce');
//        Route::get('/remove/{product}', [CartController::class, 'remove'])->name('remove');
//        Route::get('/checkout', [CartController::class, "checkout"])->name('checkout');
//    });
//
//    Route::get('/', [\App\Http\Controllers\Web\HomeController::class, "index"])->name("welcome");
//    Route::get('/contact', [ContactController::class, "index"])->name("contact");
//    Route::get('/shop', [ProductsApiController::class, "index"])->name("shop");
//    Route::get('/filter/{category}', [ProductsApiController::class, "filter"])->name('filter');
//
//    Route::prefix('/orders')->as('orders.')->group(function () {
//        Route::get('/index', [OrdersController::class, "index"])->name('index');
//        Route::get('/invoice/{order}', [OrdersController::class, "invoice"])->name('invoice');
//        Route::get('/cancel/{order}', [OrdersController::class, "cancel"])->name('cancel');
//        Route::get('/returns/{order}', [OrdersController::class, "returns"])->name('returns');
//    });
//
//    //Auth
//    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
//    Route::post('/register', [RegisterController::class, 'register'])->name('register');
//    Route::post('/login', [LoginController::class, 'login'])->name('login');
//    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//
//    //PlaceOrder
//    Route::post('/placeOrder', [CheckoutController::class, "placeOrder"])->name('placeOrder');
//    Route::get('/cancelTransaction/{order}', [CheckoutController::class, "cancelTransaction"])->name('cancelTransaction');
//    Route::get('/successTransaction/{order}', [CheckoutController::class, "successTransaction"])->name('successTransaction');
//    Route::get('/thankyou/{order}', [CheckoutController::class, "thankyou"])->name('thankyou');
//
//    Route::get('/home', [WelcomeApiController::class, 'index'])->name('home');
//});


