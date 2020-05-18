<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\JwtLogin;
use App\Helpers\SSP;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
  /**
   * Instantiate a new UserController instance.
   */
  public function __construct()
  {
      $this->middleware('cors');
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
        
        $usuario->telefono = $request->telefono;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo; 
        $usuario->direccion = $request->direccion; 
        
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

  public function listaUsuarios(){
    $usuarios = DB::table('usuarios AS u1')
              ->join('usuarios AS u2', 'u1.fk_creador', '=', 'u2.id')
              ->join('perfiles', 'u1.fk_perfil', '=', 'perfiles.id')
              ->select('u1.*', 'u2.nombres AS creador', 'perfiles.nombre AS perfil')
              ->where('u1.estado', 1)
              ->get();

    if (!$usuarios->isEmpty()) {
      $resp["success"] = true;
      $resp["msj"] = $usuarios;
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No hay datos";
    }
    
    return $resp;
  }

  public function crearUsuario(Request $request){
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
      $usuario->fk_perfil = $request->perfil;
      $usuario->estado = 1;
      $usuario->fk_creador = $request->creador;
      
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

  public function eliminarUsuario(Request $request){
    $usuario = Usuarios::find($request->id);
    
    if(!is_null($usuario)){
      $usuario->estado = 0;

      if ($usuario->save()) {
        $resp["success"] = true;
        $resp["msj"] = "Se ha eliminado el usuario";
      }else{
        $resp["success"] = false;
        $resp["msj"] = "No se han guardado cambios";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No se ha encontrado el usuario";
    }
    return $resp; 
  }

  public function editarUsuario(Request $request){
    $validar = Usuarios::where([
              ['id', '<>', $request->id],
              ['nro_documento', $request->documento]
            ])->get();
    
    if ($validar->isEmpty()) {
      $usuario = Usuarios::find($request->id);
      if(!empty($usuario)){
        if ($request->perfil != $usuario->fk_perfil || $request->documento != $usuario->nro_documento || $request->telefono != $usuario->telefono || $request->nombres != $usuario->nombres || $request->apellidos != $usuario->apellidos || $request->correo != $usuario->correo || $request->direccion != $usuario->direccion) {
          
          $usuario->nro_documento = $request->documento;
          $usuario->fk_perfil = $request->perfil;
          $usuario->telefono = $request->telefono;
          $usuario->nombres = $request->nombres;
          $usuario->apellidos = $request->apellidos;
          $usuario->correo = $request->correo; 
          $usuario->direccion = $request->direccion; 
          
          if ($usuario->save()) {
            $resp["success"] = true;
            $resp["msj"] = "Se han actualizado los datos";
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
    }else{
      $resp["success"] = false;
        $resp["msj"] = "El número de documento ya se encuentra registrado";
    }
    return $resp; 
  }
}
