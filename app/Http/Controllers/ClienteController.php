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

    public function indexSearch(Request $request)
    {
        $cliente = Cliente::where('nombre_completo', "like", "%".$request->q."%")
                ->orWhere('ci', "like", "%".$request->q."%")
                ->first();
        return response()->json($cliente);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cliente = new Cliente();
        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->ci = $request->ci;
        $cliente->save();

        return response()->json($cliente);

        
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
