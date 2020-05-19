<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidosDetalles;
use Illuminate\Http\Request;

class PedidoController extends Controller
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
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function show(Pedido $pedido)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function edit(Pedido $pedido)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Pedido $pedido)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function destroy(Pedido $pedido)
  {
      //
  }

  public function realizarPedido(Request $request)
  {
    $resp["success"] = false;

    $pedido = new Pedido();
    $pedido->nro_documento = $request->nro_documento;
    $pedido->nombre_completo = $request->nombres . ' ' . $request->apellidos;
    $pedido->direccion = $request->direccion;
    $pedido->telefono = $request->telefono;
    $pedido->total = $request->total;
    $pedido->estado = 1;

    if ($pedido->save()) {
      $contPerdidoDetalle = 0;
      $pedidoDetalle = new PedidosDetalles();
      for ($i=0; $i < count($request->listaProductos); $i++) { 
        $pedidoDetalle = new PedidosDetalles();
        if (isset($request->listaProductos[$i]->fk_plato)) {
          $pedidoDetalle->fk_plato = 1;
          $pedidoDetalle->fk_promocion = $request->listaProductos[$i]['id'];
        }else{
          $pedidoDetalle->fk_plato = $request->listaProductos[$i]['id'];
          $pedidoDetalle->fk_promocion = 1;
        }
        $pedidoDetalle->fk_pedido = 13;
        $pedidoDetalle->cantidad = $request->listaProductos[$i]['cantidad'];
        $pedidoDetalle->precio = $request->listaProductos[$i]['precio'];
        $pedidoDetalle->estado = 1;

        if ($pedidoDetalle->save()) {
          $contPerdidoDetalle++;
        }
        
      }
      if ($contPerdidoDetalle == count($request->listaProductos)) {
        $resp["success"] = true;
        $resp["msj"] = "Se ha realizado su pedido";
      }else{
        $resp["msj"] = "No ha realizado su pedido";
      }
    } else {
      $resp["msj"] = "No se han guardado cambios";
    }

    return $resp;
  }
}
