<!-- ENTER EL CODIGO -->

<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('clientes','ClientesController');
Route::resource('envios','EnviosController');
Route::resource('articulos','ArticulosController');
Route::resource('fabricas','FabricasController');
Route::resource('pedidos','PedidosController');
Route::resource('bitacoras','BitacoraController');
Route::get('pdf/ListarPDF','BitacoraController@ListarPDF')->name('bitacora_articulo_pdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

