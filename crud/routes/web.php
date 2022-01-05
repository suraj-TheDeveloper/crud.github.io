<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/create', [HomeController::class, 'create'])->name('create_form');
Route::post('/create', [HomeController::class, 'store'])->name('create');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('display');
Route::post('/edit/{id}', [HomeController::class, 'update'])->name('update');
Route::any('/delete/{id}', [HomeController::class, 'destory'])->name('delete');
Route::post('/home', [HomeController::class, 'updateStatus'])->name('status');
