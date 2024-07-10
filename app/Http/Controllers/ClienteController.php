<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Cliente::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cliente = new Cliente();
        $cliente->nombre_commpleto = $request->nombre_completo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->ci = $request->ci;
        $cliente->save();

        return response()->json(["message" => "Cliente registrado"]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
