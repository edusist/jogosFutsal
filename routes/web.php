<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\{
    JogadorController,
    TimeFutsalController
};
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

Route::get('/', function(){

    return redirect('/index');
});


Route::middleware(['web'])->group(function () {

    Route::get('/home', function(){
        return redirect('/jogadores');
    });

    Route::get('/dashboard', function(){
        return redirect('/jogadores');
    });

    // Route::get('/login', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/jogadores', [JogadorController::class, 'index'])->name('jogadores.index');
    Route::get('/jogadores/create', [JogadorController::class, 'create'])->name('jogadores.create');
    Route::put('/jogadores/{id}', [JogadorController::class, 'update'])->name('jogadores.update');
    Route::get('/jogadores/edit/{id}', [JogadorController::class, 'edit'])->name('jogadores.edit');
    Route::delete('/jogadores/{id}', [JogadorController::class, 'destroy'])->name('jogadores.destroy');
    Route::get('/jogadores/{id}', [JogadorController::class, 'show'])->name('jogadores.show');
    Route::post('/jogadores', [JogadorController::class, 'store'])->name('jogadores.store');


    Route::get('/time-futsal', [TimeFutsalController::class, 'index'])->name('timesFutsal.index');
    Route::get('/time-futsal/create', [TimeFutsalController::class, 'create'])->name('timesFutsal.create');
    Route::put('/time-futsal/{id}', [TimeFutsalController::class, 'update'])->name('timesFutsal.update');
    Route::get('/time-futsal/edit/{id}', [TimeFutsalController::class, 'edit'])->name('timesFutsal.edit');
    Route::delete('/time-futsal/{id}', [TimeFutsalController::class, 'destroy'])->name('timesFutsal.destroy');
    Route::get('/time-futsal/{id}', [TimeFutsalController::class, 'show'])->name('timesFutsal.show');
    Route::post('/time-futsal', [TimeFutsalController::class, 'store'])->name('timesFutsal.store');

    Route::get('/rodada', [TimeFutsalController::class, 'rodadaCreate'])->name('timesFutsal.criarRodada');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
