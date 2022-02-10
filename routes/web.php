<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\Payment\PaymentGatewayController;

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




Route::get('/ref-invite/{ref_code}', "Auth\RegisterController@ref_invite")->name("ref_invite");
Auth::routes(["verify" => true]);


Route::as("web.")->namespace("Web")->group(function () {
    Route::get('/', "IndexController@index")->name("index");
    Route::get('about', "IndexController@about")->name("about");
    Route::get('contact-us', "IndexController@contact_us")->name("contact_us");
    Route::post('contact-us/send-message', "ContactUsController@send")->name("contact_us.send_message");

    Route::get('file/{path}', 'IndexController@read_file')->name("read_file");
    Route::get('approved-vendors', "IndexController@approved_vendors")->name("approved_vendors");

    Route::prefix("shop")->as("shop.")->group(function () {
        Route::get('index', "ShopController@index")->name("index");
        Route::get('details/{id}/{slug?}', "ShopController@details")->name("details");

        Route::prefix("cart")->as("cart.")->middleware('auth')->group(function () {
            Route::post('save/{id}', "CartController@save")->name("save");
            Route::post('update/{id}', "CartController@update")->name("update");
            Route::get('index', "CartController@index")->name("index");
        });

        Route::prefix("checkout")->as("checkout.")->middleware('auth')->group(function () {
            Route::get('index', "CheckoutController@index")->name("index");
            Route::post('process', "CheckoutController@process")->name("process");
            Route::get('status', "CheckoutController@status")->name("status");
        });
    });
});

Route::as("blog.")->namespace("Web")->group(function () {
    Route::get('search', "BlogController@search")->name("search");
    Route::get('index/{type}', "BlogController@index")->name("index");
    Route::get('details/{uuid}/{slug?}/{sharer?}', "BlogController@details")->name("details");
    Route::get('share/{uuid}/{platform}', "BlogController@share")->name("share");
});

Route::get('/home', [App\Http\Controllers\Web\IndexController::class, 'index'])->name('home');

Route::as("user.")->namespace("User")->middleware('auth')->group(function () {
    Route::get('/dashboard', "DashboardController@dashboard")->name("dashboard");
    Route::get('/orders', "DashboardController@orders")->name("orders");
    Route::get('/order-details/{id}', "DashboardController@orderDetails")->name("order-details");
    Route::get('/payments', "DashboardController@payments")->name("payments");
    Route::match(["get", "post"], '/address', "AccountController@address")->name("address");
    Route::match(["get", "post"], '/account', "AccountController@account")->name("account");
    Route::match(["get", "post"], '/change-password', "AccountController@change_password")->name("change_password");

    Route::prefix("payment")->as("payment.")->group(function () {
        Route::get("gateway/{gateway}/callback", [PaymentGatewayController::class, 'handleCallback'])->name("callback");
    });

});



Route::prefix("admin")->as("admin.")->namespace("Admin")->middleware("admin")->group(function () {
    Route::get('/dashboard', "DashboardController@dashboard")->name("dashboard");
    Route::resource('users', UserController::class);
    Route::get('users/imitate/{id}', "UserController@imitate")->name("users.imitate");
    Route::post('users/{id}/modify-acount', "UserController@modifyAccount")->name("users.modify.account");

    Route::get('transaction/status/{id}/{status}', "TransactionController@status")->name("transaction_status");

    Route::resource('coupons', CouponController::class);


    Route::prefix("authorization")->as("authorization.")->namespace("Authorization")->middleware("sudo")->group(function () {
        Route::resource('roles', RoleController::class);
        Route::post('roles/{id}/update-permissions', "RoleController@update_permissions")->name("roles.update_permissions");
        Route::resource('permissions', PermissionController::class);
    });

    Route::prefix("blog")->as("blog.")->namespace("Blog")->group(function () {
        Route::resource('category', CategoryController::class);
        Route::resource('posts', PostController::class);
    });


    Route::resource('orders', Shop\OrderController::class)->only(["index", "show"]);
    Route::post('orders/update-status', "Shop\OrderController@updateStatus")->name("roles.update_status");

    Route::resource('products', Shop\ProductController::class);
    Route::get('products/{id}/orders', "Shop\ProductController@orders")->name("products.orders");

    Route::resource('product-images', Shop\ProductImageController::class);
    Route::resource('product-categories', Shop\ProductCategoryController::class);
    Route::resource('payments', Shop\PaymentController::class);
});
