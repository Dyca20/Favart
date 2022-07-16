<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/welcome', [App\Http\Controllers\PrincipalController::class, 'getWelcomePage'])->name('welcome');



Route::get('/admin/welcome', [App\Http\Controllers\AdminController::class, 'getWelcomePage'])->name('welcomeAdmin');
Route::get('/admin/manageInventory', [App\Http\Controllers\AdminController::class, 'getManageInventoryPage'])->name('manageInventory');

/* Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('registrar');
 */
//retorna la vista register
