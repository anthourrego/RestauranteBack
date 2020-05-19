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
  Route::get('platos/lista', 'PlatosController@show');
  Route::get('platos/dia', 'PlatosController@platosDia');
  Route::get('promo/lista', 'PromocionesController@show');

  Route::post('pedidos/crear', 'PedidoController@realizarPedido');
});

Route::middleware('token')->group(function () {
  Route::get('validarToken', 'UsuariosController@validarToken');
  
  //Usuarios
  Route::put('actualizarDatos', 'UsuariosController@actualizarDatos');
  Route::get('usuarios/lista', 'UsuariosController@listaUsuarios');
  Route::post('usuarios/crear', 'UsuariosController@crearUsuario');
  Route::put('usuarios/eliminar', 'UsuariosController@eliminarUsuario');
  Route::put('usuarios/editar', 'UsuariosController@editarUsuario');
  Route::get('usuarios/lista/clientes', 'UsuariosController@clienteRegistrados');
  Route::get('usuarios/lista/usuarios', 'UsuariosController@usuariosRegistrados');
  Route::get('usuarios/lista/permisos/{idUsuario}', 'UsuariosController@listaPermisos');
  Route::post('usuarios/actualizar/permiso', 'UsuariosController@actualizarPermiso');
  
  //Modulos
  Route::get('listaModulosUsuario/{idUsuario}', 'ModulosController@listaModulosUsuario');
  
  //Validar permisos
  Route::get('permisos/validar/{idUsuario}/{modulo}', 'ModulosController@validarPermiso');

  //Platos
  Route::post('platos/guardar', 'PlatosController@store');
  Route::put('platos/eliminar', 'PlatosController@eliminar');
  Route::put('platos/dia', 'PlatosController@dia');
  Route::post('platos/editar', 'PlatosController@update');
  Route::post('platos/imagen', 'PlatosController@imagen');

  //Promociones
  Route::post('promo/crear', 'PromocionesController@create');
  Route::put('promo/quitar', 'PromocionesController@update');

  //Pedidos
  Route::get('pedidos/lista', 'PedidoController@listaPedidos');

});