<?php

namespace App\Http\Controllers;

use App\Modulos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulosController extends Controller
{
  public function listaModulosUsuario($idUsuario){
    $modulos = DB::table('usuarios_modulos')
          ->join('modulos', 'usuarios_modulos.fk_modulo', '=', 'modulos.id')
          ->select('modulos.*')
          ->where([
            ['usuarios_modulos.fk_usuario', $idUsuario],
            ['usuarios_modulos.estado', 1],
            ['modulos.estado', 1]
          ])->get();

    if (!empty($modulos)) {
      $resp["success"] = true;
      $resp['msj'] = $modulos;
    }else{
      $resp["success"] = false;
      $resp['msj'] = "No hay datos";
    }

    return $resp;
  }

  public function validarPermiso($idUsuario, $modulo){
    
    $permiso = DB::table('usuarios_modulos')
              ->join('modulos', 'usuarios_modulos.fk_modulo', '=', 'modulos.id')
              ->select('modulos.*')
              ->where([
                ['usuarios_modulos.fk_usuario', $idUsuario],
                ['usuarios_modulos.estado', 1],
                ['modulos.estado', 1],
                ['modulos.nombre', $modulo]
              ])->get();
    
    if (!$permiso->isEmpty()) {
      $resp["success"] = true;
      $resp['msj'] = 'Tienes acceso';
    }else{
      $resp["success"] = false;
      $resp['msj'] = "No tienes acceso";
    }

    return $resp;
  }
}
