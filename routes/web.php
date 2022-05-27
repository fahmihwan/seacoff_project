<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMenuController;
use App\Http\Controllers\DashboardPenjualan;
use App\Http\Controllers\DashboardPenjualanController;
use App\Http\Controllers\DetailOrdersController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuPaymentController;
use App\Http\Controllers\OrderController;
use App\Models\Meja;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [AuthController::class, 'index']);

// user
Route::get('menu', [MenuController::class, 'index']);
Route::get('/menu/cart', [MenuPaymentController::class, 'index']);
Route::get('/menu/payment', [MenuPaymentController::class, 'payment']);
Route::post('/menu/payment', [MenuPaymentController::class, 'payment']);
Route::post('/menu/payment/midtrans', [MenuPaymentController::class, 'payment_post']);
Route::resource('/order', OrderController::class);


//admin
// handle dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/json/list-order', [DashboardController::class, 'listOrder']);
Route::get('/json/show-item/{id}', [DashboardController::class, 'showModal']);
Route::post('/json/update-order', [DashboardController::class, 'updateOrder']);

// handle item
Route::get('/admin/item/{id}/{status}/update', [DashboardMenuController::class, 'updateStatusMenu']);
Route::resource('/admin/item', DashboardMenuController::class);

//handle penjualan
Route::get('/admin/penjualan', [DashboardPenjualanController::class, 'index']);

// setting, handle meja
Route::resource('/admin/setting/meja', MejaController::class);



// Route::resource('/admin/penjualan', DashboardPenjualan::class);
