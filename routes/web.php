<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\{
    JogadorController
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

    return view('index');
});


Route::middleware(['web'])->group(function () {

    Route::get('/jogadores', [JogadorController::class, 'index'])->name('jogadores.index');
    Route::get('/jogadores/create', [JogadorController::class, 'create'])->name('jogadores.create');
    Route::put('/jogadores/{id}', [JogadorController::class, 'update'])->name('jogadores.update');
    Route::get('/jogadores/edit/{id}', [JogadorController::class, 'edit'])->name('jogadores.edit');
    Route::delete('/jogadores/{id}', [JogadorController::class, 'destroy'])->name('jogadores.destroy');
    Route::get('/jogadores/{id}', [JogadorController::class, 'show'])->name('jogadores.show');
    Route::post('/jogadores', [JogadorController::class, 'store'])->name('jogadores.store');


    //Auth::routes();
    //Route::get('/logout', 'UserController@logout')->name('users.logout');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
