<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Admin\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\EventController as ControllersEventController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::post('/store', [CheckoutController::class, 'store'])->name('pay.store');
Route::get('/checkout/{transaction}', [CheckoutController::class, 'cek'])->name('pay.cek');
Route::post('/midtrans-notification', [CheckoutController::class, 'notificationHandler']);
Route::post('/update-status', [CheckoutController::class, 'updateStatus']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-events', [HomeController::class, 'search']);


Route::get('/history', [PaymentController::class, 'history'])->name('booking.history');
Route::get('/cancelOrder/{order_id}', [PaymentController::class, 'cancelOrder'])->name('booking.cancel');
Route::get('/payment/{id}', [PaymentController::class, 'show']);

Route::get('/event', [ControllersEventController::class, 'index'])->name('event');
Route::get('/filterEvents', [ControllersEventController::class, 'filterEvents'])->name('filterEvents');


Route::group(['prefix' => '/booking/{package}', 'as' => 'booking.'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::post('/storeDetail', [OrderController::class, 'storeDetail'])->name('storeDetail');
});



Route::group(['prefix' => '/ticket', 'as' => 'ticket.'], function () {
    Route::get('/{slug}', [ControllersEventController::class, 'detail'])->name('detail-event');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('auth/google/callback', [SocialiteController::class, 'callback']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
    
    Route::get('event/dataTable', [EventController::class, 'dataTable'])->name('event.datatable');
    Route::resource('event', EventController::class);
    
    Route::get('user/dataTable', [UserController::class, 'list'])->name('user.list');
    Route::resource('user', UserController::class);
    
    
    Route::resource('package', PackageController::class);
    
    Route::get('order/dataTable', [AdminOrderController::class, 'list'])->name('order.list');
    Route::resource('order', AdminOrderController::class);
    
});

require __DIR__ . '/auth.php';
