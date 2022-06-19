<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardEventController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DashboardMenuController;
use App\Http\Controllers\DashboardPenjualanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Tes;
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


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'authenticate']);

// user
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/event', [HomeController::class, 'event']);
Route::get('/home/my-order', [HomeController::class, 'myorder']);
Route::get('/json/my-order/notif', [HomeController::class, 'list_notification']);
Route::get('/home/scan', [HomeController::class, 'qrcode']);
Route::post('/home/scan', [HomeController::class, 'scan']);
Route::post('/home/pindah-meja', [HomeController::class, 'pindah_meja']);

// Route::get('/json/scan-qr/{qrcode}', [HomeController::class, 'scan']);
Route::get('/menu', [MenuController::class, 'index'])->middleware('scanQr');
Route::get('/menu/cart', [MenuPaymentController::class, 'index'])->middleware('scanQr');
Route::get('/menu/payment', [MenuPaymentController::class, 'payment'])->middleware('scanQr');
Route::post('/menu/payment', [MenuPaymentController::class, 'payment'])->middleware('scanQr');
Route::post('/menu/payment/midtrans', [MenuPaymentController::class, 'payment_post'])->middleware('scanQr');


Route::resource('/order', OrderController::class);

Route::middleware(['auth'])->group(function () {
    // admin-dashboard
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/json/list-order', [DashboardController::class, 'listOrder']);
    Route::get('/json/show-item/{id}', [DashboardController::class, 'showModal']);
    Route::post('/json/update-order', [DashboardController::class, 'updateOrder']);

    // admin-item
    Route::get('/admin/item/{id}/{status}/update', [DashboardMenuController::class, 'updateStatusMenu']);
    Route::resource('/admin/item', DashboardMenuController::class);

    //admin-penjualan
    Route::get('/admin/penjualan', [DashboardPenjualanController::class, 'index']);
    Route::get('/json/list-penjualan', [DashboardPenjualanController::class, 'get_penjualan']);
    Route::get('/json/category-menu/{category}', [DashboardPenjualanController::class, 'get_category']);
    Route::post('/admin/penjualan/store', [DashboardPenjualanController::class, 'store']);

    //admin-laporan
    Route::get('/admin/laporan/penjualan', [DashboardLaporanController::class, 'laporan']);
    Route::get('/admin/laporan/e-money', [DashboardLaporanController::class, 'laporan_eMoney']);
    Route::get('/admin/laporan/cash', [DashboardLaporanController::class, 'laporan_cash']);
    Route::get('/admin/laporan/grafik-penjualan', [DashboardLaporanController::class, 'grafik_penjualan']);
    Route::get('/admin/laporan/{year}/grafik-penjualan', [DashboardLaporanController::class, 'list_grafik_penjualan']);

    //admin-setting
    Route::resource('/admin/event', DashboardEventController::class);

    //admin-PDF
    Route::post('/admin/laporan/penjualan/print/laporan_date', [PdfController::class, 'laporan_date']);
    Route::post('/admin/laporan/penjualan/print/laporan_month', [PdfController::class, 'laporan_month']);

    Route::post('/admin/laporan/penjualan/print/laporan_eMoney_date', [PdfController::class, 'laporan_eMoney_date']);
    Route::post('/admin/laporan/penjualan/print/laporan_eMoney_month', [PdfController::class, 'laporan_eMoney_month']);

    Route::post('/admin/laporan/penjualan/print/laporan_cash_date', [PdfController::class, 'laporan_cash_date']);
    Route::post('/admin/laporan/penjualan/print/laporan_cash_month', [PdfController::class, 'laporan_cash_month']);


    //setting akun & qrcode
    Route::middleware(['hakAkses:admin'])->group(function () {
        Route::resource('/admin/setting/meja', MejaController::class);



        // Route::get('/admin/setting/akun', [AuthController::class, 'list']);
        // Route::get('/admin/setting/akun/registerasi', [AuthController::class, 'registerasi']);
        // Route::post('/admin/setting/akun', [AuthController::class, 'store']);
        // Route::post('/admin/setting/akun/{id}/edit', [AuthController::class, 'edit']);
        // Route::delete('/admin/setting/akun/{id}/destroy', [AuthController::class, 'destroy']);
    });
});


Route::get('/admin/setting/akun', [AuthController::class, 'list']);
Route::get('/admin/setting/akun/registerasi', [AuthController::class, 'registerasi']);
Route::post('/admin/setting/akun', [AuthController::class, 'store']);
Route::post('/admin/setting/akun/{id}/edit', [AuthController::class, 'edit']);
Route::delete('/admin/setting/akun/{id}/destroy', [AuthController::class, 'destroy']);







// Route::resource('/admin/penjualan', DashboardPenjualan::class);
