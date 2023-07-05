<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\UserController@index');
Route::get('/carrinho', 'App\Http\Controllers\UserController@carrinho');
Route::get('/pesquisa', 'App\Http\Controllers\UserController@pesquisa');
Route::get('/login', 'App\Http\Controllers\UserController@login');
Route::get('/cadastro', 'App\Http\Controllers\UserController@cadastro');
Route::get('/cadastro/usuario', 'App\Http\Controllers\UserController@cadastro_usuario');
Route::post('/cadastro/usuario', 'App\Http\Controllers\UserController@cadastrar_usuario');

Route::get('/cadastro/cooperativa', 'App\Http\Controllers\UserController@cadastro_cooperativa');
Route::post('/cadastro/cooperativa', 'App\Http\Controllers\UserController@cadastrar_cooperativa');

Route::get('/produto', 'App\Http\Controllers\UserController@pagina_produto');
Route::get('/cooperativa', 'App\Http\Controllers\UserController@cooperativa');

