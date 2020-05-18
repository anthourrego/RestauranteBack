<?php

namespace App\Http\Controllers;

use App\Platos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlatosController extends Controller
{
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
    $validar = Platos::where('nombre', $request->nombre)->get();
    if($validar->isEmpty()){
      $plato = new Platos;
      $plato->nombre = $request->nombre;
      $plato->descripcion = $request->descripcion;
      $plato->imagen = '';
      $plato->estado = 1;
      $plato->plato_dia = 0;
      $plato->precio = $request->precio;
      $plato->fk_creador = $request->creador;
      if($plato->save()){
        $resp["success"] = true;
        $resp["msj"] = "Se ha creado el plato";
        $resp["plato"] = $plato;
      }else{
        $resp["success"] = false;
        $resp["msj"] = "No se ha creado el plato";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "El nombre del plato ya se encuentra registrado";
    }
    return $resp;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Platos  $platos
   * @return \Illuminate\Http\Response
   */
  public function show(Platos $platos)
  { 
    $platos = DB::table('platos')
            ->join('usuarios', 'platos.fk_creador', '=', 'usuarios.id')
            ->select('platos.*', 'usuarios.nombres AS creador')
            ->where([
              ['platos.estado', 1],
              ['platos.id', '<>', 1]
            ])
            ->get();
    if (!$platos->isEmpty()) {
      $resp["success"] = true;
      $resp["msj"] = $platos;
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No hay datos";
    }
    return $resp;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Platos  $platos
   * @return \Illuminate\Http\Response
   */
  public function edit(Platos $platos)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Platos  $platos
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Platos $platos)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Platos  $platos
   * @return \Illuminate\Http\Response
   */
  public function destroy(Platos $platos)
  {
      //
  }

  public function eliminar(Request $request){
    $plato = Platos::find($request->id);
  
    if(!is_null($plato)){
      $plato->estado = 0;

      if ($plato->save()) {
        $resp["success"] = true;
        $resp["msj"] = "Se ha eliminado el plato";
      }else{
        $resp["success"] = false;
        $resp["msj"] = "No se han guardado cambios";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No se ha encontrado el plato";
    }
    return $resp; 
  }

  public function dia(Request $request){
    $plato = Platos::find($request->id);
  
    if(!is_null($plato)){
      if ($plato->plato_dia) {
        $plato->plato_dia = 0;
      }else{
        $plato->plato_dia = 1;
      }

      if ($plato->save()) {
        $resp["success"] = true;
        $resp["msj"] = "Se ha actualizo el plato del día";
      }else{
        $resp["success"] = false;
        $resp["msj"] = "No se han guardado cambios";
      }
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No se ha encontrado el plato";
    }
    return $resp; 
  }


  public function platosDia(){
    $platos = Platos::where([
                      ['estado', 1],
                      ['plato_dia', 1]
                    ])->get();
    if (!$platos->isEmpty()) {
      $resp["success"] = true;
      $resp["msj"] = $platos;
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No hay datos";
    }
    return $resp;
  }
}
