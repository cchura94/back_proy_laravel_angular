<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // http://127.0.0.1:8000/api/producto?q=mesa&page=1&limit=10
        // $q = isset($request->q);

        // $page = $request->page?$request->page:1;
        $limit = $request->limit ? $request->limit : 10;

        if (isset($request->q)) {
            // buscar
            $productos = Producto::where('nombre', 'like', '%' . $request->q . '%')
                ->orWhere('precio', 'like', '%' .  $request->q . '%')
                ->with('categoria')
                ->paginate($limit);
        } else {
            // sin busqueda
            $productos = Producto::with('categoria')
                ->paginate($limit);
        }

        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|max:200|min:3",
            "precio" => "required",
            "stock" => "required",
            "estado" => "required",
            "categoria_id" => "required"
        ]);

        DB::beginTransaction();

        try {

            $producto = new Producto();
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->categoria_id = $request->categoria_id;
            $producto->descripcion = $request->descripcion;
            $producto->estado = $request->estado;
            $producto->save();

            DB::commit();
            return response()->json(["message" => "Producto registrado"], 200);

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message" => "Ocurrió un error al registrar el producto"], 500);
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);

        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required|max:200|min:3",
            "precio" => "required",
            "stock" => "required",
            "estado" => "required",
            "categoria_id" => "required"
        ]);

            $producto = Producto::with('categoria')->findOrFail($id);
        
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->categoria_id = $request->categoria_id;
            $producto->descripcion = $request->descripcion;
            $producto->estado = $request->estado;
            $producto->update();

            return response()->json(["message" => "Producto actualizado"], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(["message" => "Producto eliminado"]);
    }

    public function actualizarImagen(Request $request, $id){
        $producto = Producto::find($id);
        if($file = $request->file('imagen')){
            $direccion_imagen = "";
            $direccion_imagen = time() . "-" . $file->getClientOriginalName();
            $file->move("imagenes/", $direccion_imagen);

            $direccion_imagen =  "imagenes/". $direccion_imagen;
            $producto->imagen =  $direccion_imagen;
            $producto->update(); 

            return response()->json(["message" => "Imagen Actualizada"]);
        }

    }
}
