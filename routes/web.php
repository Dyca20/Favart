<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiJsController;
use App\Http\Controllers\PrincipalController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/welcome', [App\Http\Controllers\PrincipalController::class, 'getWelcomePage'])->name('welcome');
Route::get('/catalog', [App\Http\Controllers\PrincipalController::class, 'getCatalogPage'])->name('catalog');
Route::get('/history', [App\Http\Controllers\PrincipalController::class, 'getHistoryPage'])->name('history');
Route::get('/{id}/perfil', [App\Http\Controllers\PrincipalController::class, 'getPerfilPage'])->name('getPerfil');
Route::post('/{id}/perfil', [App\Http\Controllers\PrincipalController::class, 'postPerfilPage'])->name('postPerfil');

Route::get('/admin/welcome', [App\Http\Controllers\AdminController::class, 'getWelcomePage'])->name('welcomeAdmin');
Route::get('/admin/history', [App\Http\Controllers\AdminController::class, 'getHistoryPage'])->name('historyAdmin');
Route::get('/admin/manageInventory', [App\Http\Controllers\AdminController::class, 'getManageInventoryPage'])->name('manageInventory');
Route::get('/admin/addProduct', [App\Http\Controllers\AdminController::class, 'getAddProductPage'])->name('getAddProduct');

Route::post('/admin/addProduct', [App\Http\Controllers\AdminController::class, 'postAddProductPage'])->name('postAddProduct');

Route::get('/admin/{id}/editProduct', [App\Http\Controllers\AdminController::class, 'getProductoPage'])->name('getProduct');
Route::post('/admin/{id}/editProduct', [App\Http\Controllers\AdminController::class, 'postProductoPage'])->name('postProduct');
Route::get('/admin/{id}/perfil', [App\Http\Controllers\AdminController::class, 'getPerfilPage'])->name('getPerfilAdmin');
Route::post('/admin/{id}/perfil', [App\Http\Controllers\AdminController::class, 'postPerfilPage'])->name('postPerfilAdmin');


/* Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('registrar');
 */
//retorna la vista register
