<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $personas = Persona::with('user', 'documentos')->get();
        
        return response()->json($personas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombres" => "required"
        ]);

        $per = new Persona();
        $per->nombres = $request->nombres;
        $per->apellidos = $request->apellidos;
        $per->ci_nit = $request->ci_nit;
        $per->direccion = $request->direccion;
        $per->user_id = $request->user_id;
        $per->save();
        
        return response()->json(["mensaje" => "Persona Registrada"]);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $persona = Persona::with('user', 'documentos')->findOrFail($id);
        return response()->json($persona);
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
