<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest'])->group(function () {
  //Rutas a las que se permitirá acceso
  /* Route::get('login/{nroDoc}/{pass}', 'UserController@inicioSesion'); */
  /* Route::get('listaPlatos', 'PlatosController@listaPlatos'); */
  /* Route::get('validarToken/{tiempoToken}', 'UserController@validarToken');  */
  Route::get('login/{nroDoc}/{pass}', 'UsuariosController@inicioSesion');
  Route::post('registrarse', 'UsuariosController@registrarse');
});

Route::middleware('token')->group(function () {
  Route::get('validarToken', 'UsuariosController@validarToken');
  
  //Usuarios
  Route::put('actualizarDatos', 'UsuariosController@actualizarDatos');
  
  //Modulos
  Route::get('listaModulosUsuario/{idUsuario}', 'ModulosController@listaModulosUsuario');
  
  //Validar permisos
  Route::get('validarPermiso/{idUsuario}/{modulo}', 'ModulosController@validarPermiso');
});