<?php
//Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('home.index');
});

Route::resource('products', ProductController::class);

Route::get('/account/login', [AccountController::class, 'login']);
//Route::resource('account', AccountController::class);


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
