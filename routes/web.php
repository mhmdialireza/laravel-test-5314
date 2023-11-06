<?php


use App\Enums\Role;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::controller(RequestController::class)->group(function () {
        Route::get('/request', 'create')->name('create-request-form');
        Route::post('/request', 'store')->name('create-request');
    });
});
