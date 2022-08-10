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
Route::post('/catalog/searcher', [App\Http\Controllers\PrincipalController::class, 'getSearcherPage'])->name('getSearcherCatalog');
Route::get('/catalog/searcher/{idCategoria}', [App\Http\Controllers\PrincipalController::class, 'getSearcherCategoryPage'])->name('getSearcherCategoryCatalog');

Route::get('/carrito', [App\Http\Controllers\PrincipalController::class, 'getCarritoPage'])->name('carrito')->middleware('auth');

Route::get('/sumProductCarrito/{id_producto}', [App\Http\Controllers\PrincipalController::class, 'getSumProductCarrito'])->name('sumProductCarrito')->middleware('auth');
Route::get('/subProductCarrito/{id_producto}', [App\Http\Controllers\PrincipalController::class, 'getSubProductCarrito'])->name('subProductCarrito')->middleware('auth');
Route::get('/addProductCarrito/{id_producto}', [App\Http\Controllers\PrincipalController::class, 'getAddProductCarrito'])->name('addProductCarrito')->middleware('auth');
Route::get('/delProductCarrito/{id_producto}', [App\Http\Controllers\PrincipalController::class, 'getDelProductCarrito'])->name('delProductCarrito')->middleware('auth');


Route::get('/finishCarrito', [App\Http\Controllers\PrincipalController::class, 'getFinishCarrito'])->name('finishCarrito')->middleware('auth');


Route::get('/history', [App\Http\Controllers\PrincipalController::class, 'getHistoryPage'])->name('history')->middleware('auth');
Route::get('/carritoHistorial/{id_historial}', [App\Http\Controllers\PrincipalController::class, 'getCarritoHistorialPage'])->name('carritoHistorial')->middleware('auth');

Route::get('/{id}/perfil', [App\Http\Controllers\PrincipalController::class, 'getPerfilPage'])->name('getPerfil')->middleware('auth');
Route::post('/{id}/perfil', [App\Http\Controllers\PrincipalController::class, 'postPerfilPage'])->name('postPerfil')->middleware('auth');

Route::get('/admin/welcome', [App\Http\Controllers\AdminController::class, 'getWelcomePage'])->name('welcomeAdmin')->middleware(['auth', 'admin']);
Route::get('/admin/history', [App\Http\Controllers\AdminController::class, 'getHistoryPage'])->name('historyAdmin')->middleware(['auth', 'admin']);
Route::get('/admin/manageInventory', [App\Http\Controllers\AdminController::class, 'getManageInventoryPage'])->name('manageInventory')->middleware(['auth', 'admin']);

Route::get('/admin/addProduct', [App\Http\Controllers\AdminController::class, 'getAddProductPage'])->name('getAddProduct')->middleware(['auth', 'admin']);
Route::post('/admin/addProduct', [App\Http\Controllers\AdminController::class, 'postAddProductPage'])->name('postAddProduct')->middleware(['auth', 'admin']);

Route::get('/admin/{id}/addCategory', [App\Http\Controllers\AdminController::class, 'getAddCategoryPage'])->name('getAddCategory')->middleware(['auth', 'admin']);
Route::post('/admin/{id}/addCategory', [App\Http\Controllers\AdminController::class, 'postAddCategoryPage'])->name('postAddCategory')->middleware(['auth', 'admin']);

Route::get('/admin/{id_producto}/{id_categoria}/addProductCategory', [App\Http\Controllers\AdminController::class, 'postAddProductCategoryPage'])->name('postAddProductCategory')->middleware(['auth', 'admin']);
Route::get('/admin/{id_producto}/{id_categoria}/deleteProductCategory', [App\Http\Controllers\AdminController::class, 'postDeleteProductCategoryPage'])->name('postDeleteProductCategory')->middleware(['auth', 'admin']);
Route::get('/admin/{id_producto}/{id_categoria}/deleteCategory', [App\Http\Controllers\AdminController::class, 'postDeleteCategoryPage'])->name('postDeleteCategory')->middleware(['auth', 'admin']);


Route::get('/admin/{id}/editProduct', [App\Http\Controllers\AdminController::class, 'getEditProductPage'])->name('getEditProduct')->middleware(['auth', 'admin']);
Route::post('/admin/{id}/editProduct', [App\Http\Controllers\AdminController::class, 'postEditProductPage'])->name('postEditProduct')->middleware(['auth', 'admin']);

Route::get('/admin/{id}/deleteProduct', [App\Http\Controllers\AdminController::class, 'postDeleteProductPage'])->name('postDeleteProduct')->middleware(['auth', 'admin']);

Route::get('/admin/{id}/perfil', [App\Http\Controllers\AdminController::class, 'getEditPerfilPage'])->name('getEditPerfilAdmin')->middleware(['auth', 'admin']);
Route::post('/admin/{id}/perfil', [App\Http\Controllers\AdminController::class, 'postEditPerfilPage'])->name('postEditPerfilAdmin')->middleware(['auth', 'admin']);

Route::post('/admin/buscador', [App\Http\Controllers\AdminController::class, 'getSearcherPage'])->name('getSearcher')->middleware(['auth', 'admin']);
