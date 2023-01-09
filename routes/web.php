<?php

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

use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('Auth',[UserController::class, 'login'])->name('auth.user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');



Route::any('/consulta',[ConsultaController::class, 'index_consulta']);
//Route::post('/consultas',[ConsultaController::class, 'index_consulta2']);


