<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SwitchUtilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::middleware('role:admin', 'auth')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'admin')->name('dashboard');
    });

    Route::get('user/archive', [UserController::class, 'archive'])->name('user.archive');
    Route::post('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::resource('user', UserController::class)->except('edit')->withTrashed(['*']);
    Route::resource('distance', DistanceController::class);
    Route::resource('switch', SwitchUtilController::class);
});

require __DIR__.'/auth.php';
