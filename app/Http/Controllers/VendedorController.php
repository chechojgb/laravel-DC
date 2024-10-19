<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\det_productos;
use App\Models\usuarios;
use App\Models\productos;
use App\Models\Facturacion;
use App\Models\det_factura;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class VendedorController extends Controller
{
    
    public function dashboardVendedor() {
        
        $id_vendedor = Auth::user()->id;
        $productos = productos::where('id_vendedor', $id_vendedor)->count();
        $ventas = facturacion::whereHas('detFacturas.producto', function($query) use ($id_vendedor) {
            $query->where('id_vendedor', $id_vendedor);
        })->with(['usuario', 'detFacturas.producto'])->count();

        $productosData = $this->cargarRueda(); // Obtener los datos de productos
        
        // Pasar $productosData a la vista
        return view('vendedor.dashboard', compact( 'productos', 'ventas', 'productosData'));
    }
    private function cargarRueda() {
        $id_vendedor = Auth::user()->id;
        $productos = productos::where('id_vendedor', $id_vendedor)->get(); // Obtener todos los productos
    
        if ($productos->isEmpty()) {
            return null; // No hay productos
        }
    
        $data = []; // Inicializar el arreglo de datos
    
        foreach ($productos as $producto) {
            // Contar cuántas veces aparece el producto en la tabla det_facturas
            $ventas = det_factura::where('producto_id', $producto->id_pro)->count();
    
            $color = '#' . substr(md5($producto->nombre), 0, 6); // Generar un color único basado en el nombre del producto
            $data[] = [
                "value" => $ventas, // Asignar el conteo de ventas
                "label" => $producto->nombre,
                "color" => $color // Asignar un color único al producto
            ];
        }
    
        return $data; // Devolver los datos
    }

    public function vistaProdVendedor(){
        // Obtener solo los valores de la columna 'proveedor' sin duplicados
        
        $nombre = Auth::user()->detUsu->nombres;
        // Pasar los resultados a la vista
        return view('vendedor.productos.vendedorRegistrarProd', compact('nombre'));
    }

    public function registerProdStore(Request $request){
        // Reglas de validación
        $rules = [
            'nombre' => 'required|string|min:5',
            'precio' => 'required|numeric',
            'categoria' => 'required|string|min:3',
            'proveedor' => 'required|string',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'estado' => 'required|string|min:3',
            'descripcion' => 'required|string|min:10',
            'stock' => 'required|numeric',
        ];
    
        // Validar la solicitud
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }
    
        // Manejar el archivo de foto
        $rutaFoto = 'animacion-inicio/Uploads/fotosProd/predefinido.png'; // Ruta por defecto
        if ($request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('animacion-inicio/Uploads/fotosProd', 'public');
        }
        $id_vendedor = Auth::user()->id;
        // Crear y guardar el producto
        $productos = new productos();
        $productos->nombre = $request->nombre;
        $productos->categoria = $request->categoria;
        $productos->descripcion = $request->descripcion;
        $productos->estado = $request->estado;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;
        $productos->id_vendedor = $id_vendedor;
        $productos->save();
    
        
        // Crear y guardar el detalle del producto
        $det_prod = new det_productos();
        $det_prod->id_productos = $productos->id_pro; // Asignar el ID del producto
        $det_prod->proveedor = $request->proveedor;
        $det_prod->foto = $rutaFoto; // Guardar la ruta de la foto
        
        $det_prod->save();
    
        return response()->json(['status' => 'success']);
    }
    public function verProdVendedor() {
        $id_vendedor = Auth::user()->id;
    
        // Obtener los detalles de los productos del vendedor autenticado junto con los datos del producto
        $productos = productos::where('id_vendedor', $id_vendedor)->get();
    
        return view('vendedor.productos.vendedorVerProd', ['productos' => $productos]);
    }
    public function obtenerProducto($id){
        $productos = productos::with('detProducto')->find($id);
        return response()->json($productos);
    }

    public function actualizarProducto(Request $request){
        // Encuentra el usuario con la relación `detUsu`
        $producto = productos::with('detProducto')->find($request->id_pro);

        if ($producto) {
            // Actualiza los datos del producto en la tabla `productos`
            $producto->update([
                'nombre' => $request->nombre,
                'categoria' => $request->categoria,
                'precio' => $request->precio,
                'estado' => $request->estado,
                'stock' => $request->stock,
            ]);

            // Actualiza los datos relacionados en la tabla `detUsu`
            $producto->detProducto->update([
                'proveedor' => $request->proveedor,
            ]);
            
            return redirect()->route('vendedorVerProd')->with('success', 'Producto actualizado con éxito');
        }

        return redirect()->route('vendedorVerProd')->with('error', 'Producto no encontrado');
    }
    public function destroyProd(Request $request, $id){
        // Aquí se podría realizar alguna validación adicional si es necesario
    
        // Encontrar la tarea por su ID y eliminarla
        $tarea = productos::findOrFail($id);
        $tarea->delete();
    
        // Redirigir de vuelta a la vista de tareas con un mensaje de éxito

        return redirect()->route('vendedorVerProd');
    }
    public function expoProdVendedor(){
        $id_vendedor = Auth::user()->id;
    
        // Obtener los detalles de los productos del vendedor autenticado junto con los datos del producto
        $productos = productos::where('id_vendedor', $id_vendedor)->get();

        return view('vendedor.productos.vendedorExpoProd', ['productos' => $productos]);
    }
    
    
    
    
}
