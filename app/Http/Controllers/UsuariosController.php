<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\JwtLogin;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\JsonResponse;

class UsuariosController extends Controller
{
  /**
   * Instantiate a new UserController instance.
   */
  public function __construct()
  {
      $this->middleware('cors');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Usuarios  $usuarios
   * @return \Illuminate\Http\Response
   */
  public function show(Usuarios $usuarios)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Usuarios  $usuarios
   * @return \Illuminate\Http\Response
   */
  public function edit(Usuarios $usuarios)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Usuarios  $usuarios
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Usuarios $usuarios)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Usuarios  $usuarios
   * @return \Illuminate\Http\Response
   */
  public function destroy(Usuarios $usuarios)
  {
      //
  }

  public function registrarse(Request $request)
  {
    $validar = Usuarios::where('nro_documento', $request->documento)->get();
        
    if($validar->isEmpty()){
      $usuario = new Usuarios;
      $usuario->nro_documento = $request->documento;
      $usuario->correo = $request->correo;
      $usuario->nombres = $request->nombres;
      $usuario->apellidos = $request->apellidos;
      $usuario->direccion = $request->direccion;
      $usuario->telefono = $request->telefono;
      $usuario->password = Hash::make($request->password, ['rounds' => 15]);
      $usuario->fk_perfil = 2;
      $usuario->estado = 1;
      $usuario->fk_creador = 1;
      
      if($usuario->save()){
        $resp["success"] = true;
        $resp["msj"] = "Se ha creado el usuario";
      }else{
        $resp["success"] = false;
        $resp["msj"] = "No se ha creado el usuario";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "El número de documento ya se encuentra registrado";
    }

    return $resp;
  }

  public function inicioSesion($nroDoc, $pass)
  {
    $usuario = Usuarios::where(array(
      'nro_documento' => $nroDoc
    ))->first();
    
    if (is_object($usuario)){
      if(Hash::check($pass, $usuario->password)){
        $jwt = new JwtLogin();
        $token = $jwt->generarToken($usuario->id, $usuario->nroDocumento, $usuario->password);
        $validarToken = $jwt->verificarToken($token, true);
        $resp = array(
                'success' => true,
                'token' => $token,
                'tiempoToken' => $validarToken->exp,
                'usuario' => $usuario
              );         
      }else{
        $resp["success"]= false;
        $resp["msj"] = 'Contraseña incorrecta';
      }
    }else {
      $resp["success"]= false;
      $resp["msj"] = 'Usuario no existe';
    }
    return $resp;
  }  

  public function actualizarDatos(Request $request){
    $usuario = Usuarios::find($request->id);
    
    if(!is_null($usuario)){
      if ($request->telefono != $usuario->telefono || $request->nombres != $usuario->nombres || $request->apellidos != $usuario->apellidos || $request->correo != $usuario->correo || $request->direccion != $usuario->direccion) {
        
        $usuario{'telefono'} = $request->telefono;
        $usuario{'nombres'} = $request->nombres;
        $usuario{'apellidos'} = $request->apellidos;
        $usuario{'correo'} = $request->correo; 
        $usuario{'direccion'} = $request->direccion; 
        
        if ($usuario->save()) {
          $resp["success"] = true;
          $resp["msj"] = "Se han actualizado los datos";
          $resp["usuario"] = $usuario;
        }else{
          $resp["success"] = false;
          $resp["msj"] = "No se han guardado cambios";
        }
      } else {
        $resp["success"] = false;
        $resp["msj"] = "Por favor realice algún cambio";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No se ha encontrado el usuario";
    }
    return $resp; 
  }


  public function validarToken(Request $request){
    return array(
            'success' => true,
            'msj' => 'Token valido'
          );
  }
}
