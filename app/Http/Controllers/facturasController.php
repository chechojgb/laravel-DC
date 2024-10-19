<?php

namespace App\Http\Controllers;

use App\Models\detalles_envio;
use App\Models\facturacion;
use App\Models\productos;
use App\Models\det_factura;
use App\Models\usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    

    /**
     * Create a new instance of FacturasController.
     */
    public function __construct(){
        // Apply the 'auth' middleware to all methods in this controller
        $this->middleware('auth');

        
    }

    public function verComprasAdmin(){
        // Cargamos todas las relaciones necesarias para evitar consultas adicionales en la vista
        $facturacion = facturacion::with(['usuario', 'detFacturas'])->get();
        $envios = detalles_envio::whereIn('user_id', $facturacion->pluck('user_id'))->get();
        $productos = productos::all();

        return view('administrador.ventas.verCompras', [
            'facturacion' => $facturacion,
            'envios' => $envios,
            'productos' => $productos
        ]);
    }
    public function verComprasVendedor() {
        // Obtener el id del vendedor autenticado
        $vendedor_id = auth()->user()->id;
    
        // Filtrar facturas que contienen productos del vendedor autenticado
        $facturacion = facturacion::whereHas('detFacturas.producto', function($query) use ($vendedor_id) {
            $query->where('id_vendedor', $vendedor_id);
        })->with(['usuario', 'detFacturas.producto'])->get();
    
        // Obtener los detalles de envío de los usuarios relacionados con esas facturas
        $envios = detalles_envio::whereIn('user_id', $facturacion->pluck('user_id'))->get();
    
        return view('vendedor.ventas.verCompras', [
            'facturacion' => $facturacion,
            'envios' => $envios
        ]);
    }
    public function verFacturasUsuario() {
        // Obtener el usuario autenticado
        $usuario = auth()->user();
    
        // Obtener las facturas del usuario
        $facturas = facturacion::where('user_id', $usuario->id)->with('detFacturas')->get();
    
        return view('usuario.facturas', [
            'facturas' => $facturas,
            'usuario' => $usuario,
        ]);
    }
    public function verProductosComprados() {
        $usuario = auth()->user();
    
        // Obtener las facturas del usuario junto con los detalles de facturas
        $facturas = facturacion::where('user_id', $usuario->id)
                    ->with('detFacturas.producto') // Cargar los productos dentro de los detalles de la factura
                    ->get();
    
        // Obtener los productos comprados por el usuario sin repetir, sumando las cantidades
        $productosComprados = det_factura::whereHas('facturacion', function($query) use ($usuario) {
            $query->where('user_id', $usuario->id);
        })
        ->with('producto') // Cargar la relación del producto
        ->selectRaw('producto_id, SUM(cantidad) as total_comprado') // Sumar la cantidad comprada de cada producto
        ->groupBy('producto_id') // Agrupar por producto
        ->get();
    
        // Contar el total de productos comprados
        $totalProductosComprados = det_factura::whereHas('facturacion', function($query) use ($usuario) {
            $query->where('user_id', $usuario->id);
        })->count();
    
        // Obtener los detalles de los productos comprados para visualización
        $productos = productos::whereIn('id_pro', $productosComprados->pluck('producto_id'))->get();
    
        // Pasar la lista de productos y el total de productos a la vista
        return view('usuario.productosComprados', [
            'facturas' => $facturas,
            'productosComprados' => $productosComprados,
            'totalProductosComprados' => $totalProductosComprados,
            'productos' => $productos
        ]);
    }
    
    
    
    

}
