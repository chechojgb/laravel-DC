<?php

namespace App\Http\Controllers;

use App\Models\det_factura;
use App\Models\productos;
use App\Models\prod_opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionProducto extends Controller
{
    protected $user_id;

    public function __construct()
    {
        // Asegurarse de que el usuario esté autenticado antes de acceder al controlador
        $this->middleware('auth');
        
    }

    public function calificacionProducto($id_pro) {
        $usuario = Auth::user();
        
        // Obtener el producto específico
        $producto = productos::find($id_pro);
    
        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Obtener la primera compra del producto por el usuario
        $primeraCompra = det_factura::whereHas('facturacion', function($query) use ($usuario) {
            $query->where('user_id', $usuario->id);
        })
        ->where('producto_id', $id_pro)
        ->orderBy('created_at', 'asc') // Ordenar por fecha de creación
        ->first(); // Obtener el primer registro

        // Cargar la calificación del producto
        $calificacion = $this->cargarCalificacion($id_pro);
    
        return view('usuario.calificar', [
            'producto' => $producto,
            'usuario' => $usuario,
            'primeraCompra' => $primeraCompra,
            'calificacion' => $calificacion // Pasar los detalles de la primera compra a la vista
        ]);
    }
    
    private function cargarCalificacion($id_pro) {
        // Obtener la calificación del usuario para el producto
        $user_id = Auth::user()->id;
        $calificacion = prod_opinion::where('id_usuario', $user_id) // Usar $this->user_id
            ->where('producto_id', $id_pro)
            ->first(); // Obtener el primer registro

        return $calificacion ? $calificacion->calificacion : 0; // Devolver la calificación o 0 si no existe
    }
    public function storeCalificacion($id_pro, $calificacion) {
        $id_user = Auth::user()->id;
    
        // Verificar si el usuario ya calificó el producto
        $opinionExistente = prod_opinion::where('id_usuario', $id_user)
            ->where('producto_id', $id_pro)
            ->first();
    
        if ($opinionExistente) {
            return redirect()->back()->with('error', 'Ya has calificado este producto.');
        }
    
        // Guardar la calificación en la base de datos
        $saveCalificacion = new prod_opinion();
        $saveCalificacion->producto_id = $id_pro;
        $saveCalificacion->id_usuario = $id_user;
        $saveCalificacion->calificacion = $calificacion;
        $saveCalificacion->save();
    
        return redirect()->route('calificacion', ['id_pro' => $id_pro])->with('success', 'Calificación guardada exitosamente.');
    }
}
