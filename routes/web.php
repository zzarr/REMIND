<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operator\{
    DashboardController as OperatorDashboardController,
    AkunController,
    PasienController,
};

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
    return redirect()->route('login');
});

Auth::routes();

//route untuk tim operator
Route::middleware(['auth', 'role:operator'])->group(function () {

    Route::group(['prefix' => 'operator', 'as' => 'operator.'], function () {

        Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'akun', 'as' => 'akun.'], function () {
            Route::get('/', [AkunController::class, 'index'])->name('index');
            Route::get('/data', [AkunController::class, 'data'])->name('data');
            Route::post('/store', [AkunController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function () {
            Route::get('/', [PasienController::class, 'index'])->name('index');
            Route::get('/data', [PasienController::class, 'data'])->name('data');
            Route::post('/store', [PasienController::class, 'store'])->name('store');
        });

    });

});


//route untuk tim peneliti
Route::middleware(['auth', 'role:tim penelii'])->group(function () {

    Route::group(['prefix' => 'tim_peneliti', 'as' => 'tim_peneliti.'], function () {

        Route::get('/dashboard', function () {
            return view('tim_peneliti.dashboard');
        })->name('dashboard');


    });

});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
