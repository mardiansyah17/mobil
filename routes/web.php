<?php

use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\KasKeluarController as AdminKasKeluarController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\PaymentController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('front.index');

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');

    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/detail/{slug}', [DetailController::class, 'index'])->name('detail');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');


    });
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {

    Route::post('/booking/download', [\App\Http\Controllers\Admin\BookingController::class, 'downloadPdf'])->name('bookings.download-pdf');
    Route::post('/item/download', [\App\Http\Controllers\Admin\ItemController::class, 'downloadPdf'])->name('items.download-pdf');
    Route::get('/brand/download', [AdminBrandController::class, 'downloadPdf'])->name('brand.download-pdf');


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('brands', AdminBrandController::class);
    Route::resource('types', AdminTypeController::class);
    Route::resource('items', AdminItemController::class);
    Route::resource('bookings', AdminBookingController::class);
    Route::resource('users', AdminUsersController::class);
    Route::resource('kaskeluars', AdminKasKeluarController::class);


});
