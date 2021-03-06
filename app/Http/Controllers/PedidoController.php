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
        $pedidoDetalle->fk_pedido = $pedido->id;
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

  public function listaPedidos(){
    $pedidos = Pedido::where('estado', 1)->get();

    if (!$pedidos->isEmpty()) {
      $resp["success"] = true;
      $resp["msj"] = $pedidos;
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No hay datos";
    }
    return $resp;
  }

  public function detallePedido($idPedido){
    $detalles = PedidosDetalles::where('fk_pedido', $idPedido)
      ->join('platos', 'fk_plato', '=', 'platos.id')
      ->get();
    if (!$detalles->isEmpty()) {
      $resp["success"] = true;
      $resp["msj"] = $detalles;
    }else{
      $resp["success"] = false;
      $resp["msj"] = "No hay datos";
    }
    return $resp;
  }

  public function cambiarEstadoPedido(Request $request){
    $detalles = PedidosDetalles::where('fk_pedido', $request->pedido)->get();
    if (!$detalles->isEmpty()) {
      $total = 0;
      for ($i=0; $i < count($detalles) ; $i++) { 
        $detalles[$i]->estado = 0;
        if ($detalles[$i]->save()) {
          $total = $total + 1;
        }
      }
      if (count($detalles) === $total) {
        $pedido = Pedido::where('id', $request->pedido)->update(['estado' => 0]);
        $resp["success"] = true;
        $resp["msj"] = "Pedido completado.";
      } else {
        $resp["success"] = false;
        $resp["msj"] = "Se completaron " . $total . " pedidos.";
      }
    } else {
      $resp["success"] = false;
      $resp["msj"] = "No existe pedido.";
    }
    return $resp;
  }

}
