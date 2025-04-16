<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operator\{
    DashboardController as OperatorDashboardController,
    AkunController
   
};

use App\Http\Controllers\TimPeneliti\{
    DashboardController as TimPenelitiDasboardController,

};

use App\Http\Controllers\{
    PasienController,
    KuisionerController
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
            Route::get('/edit/{id}', [AkunController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AkunController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [AkunController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function () {
            Route::get('/', [PasienController::class, 'index'])->name('index');
            Route::get('/data', [PasienController::class, 'data'])->name('data');
            Route::post('/store', [PasienController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PasienController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PasienController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PasienController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'kuisioner', 'as' => 'kuisioner.'], function () {
            Route::get('/', [KuisionerController::class, 'index'])->name('index');
            Route::get('/data', [KuisionerController::class, 'data'])->name('data');
            Route::post('/store', [KuisionerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [KuisionerController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [KuisionerController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [KuisionerController::class, 'destroy'])->name('delete');
          
        });
    });

});


//route untuk tim peneliti
Route::middleware(['auth', 'role:tim peneliti'])->group(function () {

    Route::group(['prefix' => 'tim_peneliti', 'as' => 'tim_peneliti.'], function () {

        Route::get('/dashboard', [TimPenelitiDasboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function (){

            Route::get('/', [PasienController::class, 'view'])->name('index');
            Route::get('/data', [PasienController::class, 'data'])->name('data');

        });

        Route::group(['prefix' => 'kuisioner', 'as' => 'kuisioner.'], function(){
            Route::get('/{jenis}/{pasien_id}', function ($jenis, $pasien_id) {
                return view('tim.kuisioner.step-form', compact('jenis', 'pasien_id'));
            })->name('step');
        });


    });

});





