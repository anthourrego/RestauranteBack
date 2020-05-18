<?php

namespace App\Http\Controllers;

use App\Promociones;
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
        $resp["success"] = false;
        $resp["msj"] = "No se ha creado la promoción";
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
  public function update(Request $request, Promociones $promociones)
  {
      //
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
