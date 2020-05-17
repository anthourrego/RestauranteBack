<?php

namespace App\Http\Controllers;

use App\Platos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlatosController extends Controller
{
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
            $plato->estado = $request->estado;
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
        $platos = DB::table('platos AS pl')
              ->join('usuarios AS usu', 'pl.fk_creador', '=', 'usu.id')
              ->select('pl.*', 'usu.nombres AS fk_creador', 'usu.apellidos AS apellidos')
              ->where('pl.estado', 1)
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
}
