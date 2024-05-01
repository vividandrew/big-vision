<?php
//Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::resource('products', ProductController::class);

//Route::get('/test/{test}', function(string $id){return 'Hello '.$id;});

Route::get('/order/{id}', [OrderController::class, 'addProduct'])->name('order.product');

Route::get('/account/login', [AccountController::class, 'login']);
//Route::resource('account', AccountController::class);

//Routes for Basket
Route::get('/basket', [OrderController::class, 'index']);


/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/account/dashboard', function () {
    return view('account.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
