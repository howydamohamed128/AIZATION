<?php

use App\Models\Order;
use Livewire\Livewire;
use App\Lib\TabbyService;
use PhpOffice\PhpWord\PhpWord;
use App\Models\Catalog\Category;
use PhpOffice\PhpWord\Writer\HTML;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservationTimeIsClosestNotification;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */
// Route::redirect('/', 'admin');
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => 'web'], function () {
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
Route::get('/', [HomeController::class, 'index'])->name('website');

});
