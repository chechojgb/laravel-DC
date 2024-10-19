<?php

namespace App\Http\Controllers;

use App\Models\det_productos;
use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productosController extends Controller
{
    /*
    *index para mostrar todos los elementos
    *store para guardar un elemento
    *update para actualizar un elemento
    *destroy para eleminar un elemento
    *edit para mostrar el formulario de edicion
    */

    public function index(){
        $productos = productos::where('estado', 'Activo')
        ->with('detOpinion') // Cargar las opiniones relacionadas
        ->get();
        

        return view('welcome', ['productos' => $productos]);
    }



    public function show($categoria) {
        // Obtener los productos que coinciden con la categoría
        $productos = productos::where('categoria', $categoria)
                          ->where('estado', 'Activo')
                          ->get();
        $det_productos = det_productos::all();
    
        // Retornar la vista con los productos y sus detalles
        return view('productos.categorias', ['productos' => $productos]);
    }
    

    public function buscar(Request $request){
        $query = $request->input('query');
        $productos = productos::where('nombre', 'like', '%' . $query . '%')->get();
        return response()->json($productos);
    }

    public function showDet($id_pro){
        // Recupera un solo producto con su detalle relacionado
        $productos = Productos::find($id_pro);

        // Verifica si el producto existe
        if (!$productos) {
            abort(404); // O maneja el caso de producto no encontrado como prefieras
        }

        // Recupera todos los productos
        $productosAll = Productos::all();

        // Retorna a la vista con el producto y todos los productos
        return view('productos.detalleProductos', [
            'productos' => $productos,
            'productosAll' => $productosAll
        ]);
    }
    
    


    

    
    

}
