<?php
//Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
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

// [[ PRODUCT ADMIN ROUTES ]]
//CREATE
Route::get('/admin/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/admin/product/create', [ProductController::class, 'store'])->name('product.create.post');

//UPDATE
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

//DELETE
Route::get('/admin/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// [PAYPAL]
Route::get('/order/checkout/pay-with-paypal/{id}', [CheckoutController::class, 'paypal'])->name('order.paypal');
Route::post('/order/checkout/pay-with-paypal/{id}', [CheckoutController::class, 'paypalPost'])->name('order.paypal.post');
Route::post('/paypal-ipn', [CheckoutController::class, 'paypalIPN']);


Route::get('/payment-success', [CheckoutController::class, 'paymentSuccess'])->name('payment-success');
Route::get('/payment-cancelled', [CheckoutController::class, 'paymentCancelled'])->name('payment-cancelled');


// [[ ORDER ROUTES ]]
//Route::get('/order/basket/{id}', [OrderController::class, 'createOrder'])->name('order.basket');
Route::get('/order/checkout/{id}', [CheckoutController::class, 'Checkout'])->name('order.checkout');
Route::post('/order/checkout/{id}', [CheckoutController::class, 'CheckoutPost'])->name('order.checkout.post');
//Route::get('/order/receipt/{id}', [OrderController::class, 'PrintReceipt']); //For development purposes to customise receipt
Route::get('/order/print/{id}', [OrderController::class, 'downloadReceipt'])->name('download.receipt');

//View order
Route::get('/order/view/{id}', [OrderController::class, 'show'])->name('order.show');

//Edit order
Route::get('/admin/order/edit/{id}',[OrderController::class, 'edit'])->name('order.edit');
Route::post('/admin/order/edit/{id}',[OrderController::class, 'update'])->name('order.edit.post');

//Delete order
Route::get('/admin/order/destroy/{id}',[OrderController::class, 'destroy'])->name('order.destroy');

//wildcards that grab the rest must stay last
Route::post('/order/{id}', [OrderController::class, 'addProduct'])->name('order.product');

// [[ ACCOUNT RELATED ROUTES ]]
Route::get('/account/login', [AccountController::class, 'login']);
Route::get('/account/dashboard', [AccountController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Personal made update method
/*
Route::get('/profile/update', [ProfileController::class, 'personalEdit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'personalUpdate'])->name('profile.edit.post');
*/
require __DIR__.'/auth.php';

//List users
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

//Edit User
Route::get('/admin/user/edit/{id}', [AccountController::class, 'edit'])->name('user.edit');
Route::post('/admin/user/edit/{id}', [AccountController::class, 'editPost'])->name('user.edit.post');

// Delete User
Route::get('/admin/user/destroy/{id}', [AccountController::class, 'destroy'])->name('user.destroy');

// [[ ACCOUNT RELATED ACTIONS ]]
Route::get('/basket', [OrderController::class, 'basket'])->name('account.basket');
Route::get('/basket/remove-product/{id}', [OrderController::class, 'removeProduct'])->name('order.removeProduct');
Route::post('/basket/apply-points/{id}', [OrderController::class, 'applyPoints'])->name('order.applyPoints');
Route::get('/account/orders', [OrderController::class, 'index'])->name('account.orders');


// [[ ADMIN RELATED ROUTES ]]
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/account/appointments',[AppointmentController::class, 'index'])->name('admin.appointments');
//Route::get('/admin/eod', function(){return view('admin.EOD');}); //for display purposes to edit receipt
Route::get('/admin/print/eod', [AdminController::class, 'printEOD'])->name('admin.print.eod');

// [[ APPOINTMENT ROUTES ]]
//Create appointment
Route::get('/account/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/account/appointment/create', [AppointmentController::class, 'createPost'])->name('appointment.create.post');

//Edit Appointment
Route::get('/admin/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
Route::post('/admin/appointment/edit/{id}', [AppointmentController::class, 'editPost'])->name('appointment.edit.post');

//User view appointments
Route::get('/account/appointment/{id}',[AppointmentController::class, 'show'])->name('user.appointment');

// [[ VISIONARY LOYALTY POINTS ]]
Route::post('/account/registerLoyalty', [AccountController::class, 'registerLoyalty'])->name('user.register.loyalty');
