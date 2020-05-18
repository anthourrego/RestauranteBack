<?php

namespace App\Http\Controllers;

use App\Promociones;
use App\Platos;
use Illuminate\Http\Request;

class PromocionesController extends Controller
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
  public function create(Request $request)
  {
    $resp["success"] = false;

    $plato = Platos::find($request->id);
  
    if(!is_null($plato)){
      $plato->promocion = 1;

      if ($plato->save()) {
        $promo = new Promociones;
        $promo->fk_plato = $request->id;
        $promo->descripcion = $request->descripcion;
        $promo->precio = $request->precio;
        $promo->estado = 1;
        $promo->fk_creador = $request->creador;

        if($promo->save()){
            $resp["success"] = true;
            $resp["msj"] = "Se ha creado la promoción";
        }else{
            $resp["msj"] = "No se ha creado la promoción";
        }
      }else{
        $resp["msj"] = "No se han guardado cambios";
      }
    }else{
      $resp["msj"] = "No se ha encontrado el plato";
    }

    return $resp;
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
   * @param  \App\Promociones  $promociones
   * @return \Illuminate\Http\Response
   */
  public function show(Promociones $promociones)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Promociones  $promociones
   * @return \Illuminate\Http\Response
   */
  public function edit(Promociones $promociones)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Promociones  $promociones
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $resp["success"] = false;

    $plato = Platos::find($request->id);
    if(!empty($plato)){
      $plato->promocion = 0;
      if ($plato->save()) {
        $promo = Promociones::where([
                            ['fk_plato', $request->id],
                            ['estado', 1]
                          ])->first();

        if(!empty($promo)){
          $promo->estado = 0;
          if ($promo->save()) {
            $resp['success'] = true;
            $resp["msj"] = "Se ha borrado la promoción";
          } else {
            $resp["msj"] = "No se han guardado cambios";
          }
        }else{
          $resp["msj"] = "No se han guardado cambios las promoción";
        }
      } else {
        $resp["msj"] = "No se han guardado cambios de los platos";
      }
    } else {
      $resp["msj"] = "No se ha encontrado el plato";
    }
    
    return $resp;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Promociones  $promociones
   * @return \Illuminate\Http\Response
   */
  public function destroy(Promociones $promociones)
  {
      //
  }
}
