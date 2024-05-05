<?php
//Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\CheckoutController;

use Illuminate\Support\Facades\Route;

//Index for the homepage
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// [[ PRODUCT ROUTES ]]
//All routes expected for the product class
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


// [PAYPAL]
Route::get('/order/checkout/pay-with-paypal/{id}', [CheckoutController::class, 'paypal'])->name('order.paypal');
Route::post('/order/checkout/pay-with-paypal/{id}', [CheckoutController::class, 'paypalPost'])->name('order.paypal');
Route::post('/paypal-ipn', [CheckoutController::class, 'paypalIPN']);

//TODO:: make function to handle payments
Route::get('/payment-success', [CheckoutController::class, 'paymentSuccess'])->name('payment-success');
Route::get('/payment-cancelled', [CheckoutController::class, 'paymentCancelled'])->name('payment-cancelled');


// [[ ORDER ROUTES ]]
Route::get('/order/basket/{id}', [OrderController::class, 'createOrder'])->name('order.basket');
Route::get('/order/checkout/{id}', [CheckoutController::class, 'Checkout'])->name('order.checkout');
Route::post('/order/checkout/{id}', [CheckoutController::class, 'CheckoutPost'])->name('order.checkout.post');

//wildcards that grab the rest must stay last
Route::get('/order/{id}', [OrderController::class, 'addProduct'])->name('order.product');


/*
Route::get('/', function () {
    return view('welcome');
});
*/

// [[ ACCOUNT RELATED ROUTES ]]
Route::get('/account/login', [AccountController::class, 'login']);
Route::get('/account/dashboard', function () {
    return view('account.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// [[ ACCOUNT RELATED ACTIONS ]]
Route::get('/basket', [OrderController::class, 'basket'])->name('account.basket');
Route::get('/account/orders', [OrderController::class, 'index'])->name('account.orders');
