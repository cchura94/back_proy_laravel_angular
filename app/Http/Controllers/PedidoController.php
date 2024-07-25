<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::paginate(10);

        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cliente_id" => "required",
            "productos" => "required"
        ]);

        DB::beginTransaction();

        try {
            // guardar pedido

            $pedido = new Pedido();
            $pedido->fecha = date("Y-m-d H:i:s");
            $pedido->estado = false;
            $pedido->observacion = $request->observacion;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->user_id = Auth::id();
            $pedido->save();

            // return $request["productos"];
            
            // asignar los productos al pedido
            foreach ($request["productos"] as $prod) {
                $pedido->productos()->attach($prod['producto_id'], ["cantidad" => $prod['cantidad']]);
            }


            // generar una respuesta
            $pedido->estado = true;
            $pedido->update();

            DB::commit();

            return response()->json(["message" => "pedido registrado"], 200);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(["Ocurrió un error al registrar el pedido", "error" => $e->getMessage()], 500);

        }

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
