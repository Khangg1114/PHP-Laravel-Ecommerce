<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/total', [CartController::class, 'getTotal'])->name('cart.total');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add'); // Phương thức POST
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/decrease/{taskId}', [CartController::class, 'decreaseItem'])->name('cart.decrease');
    Route::post('/cart/increase/{taskId}', [CartController::class, 'increaseItem'])->name('cart.increase');
    Route::post('/cart/remove/{taskId}', [CartController::class, 'removeItem'])->name('cart.remove');
    
    });

// Route cho việc thêm vào giỏ hàng (có thể sử dụng phương thức POST)
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add'); // Phương thức POST
Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', \App\Http\Controllers\TasksController::class);

    Route::resource('users', \App\Http\Controllers\UsersController::class);

    //Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    
    
});
