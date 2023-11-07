<?php


use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;

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

Route::get('/login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
    Route::controller(RequestController::class)->prefix('request')->group(function () {
        Route::get('/', 'create')->name('create-request-form');
        Route::post('/', 'store')->name('create-request');
        Route::get('/{request}', 'show')->name('show-request');
        Route::put('/{request}/supervisor-approve', 'supervisorApprove')->middleware('supervisor')->name('supervisor-approve-request');
        Route::put('/{request}/manager-approve', 'managerApprove')->middleware('manager')->name('manager-approve-request');
    });
});
