<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operator\{
    DashboardController as OperatorDashboardController
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
