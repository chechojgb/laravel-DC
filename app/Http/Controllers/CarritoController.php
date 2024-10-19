<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;
use App\Models\usuarios;
use App\Models\productos;
use App\Models\detalles_envio;
use LaravelLang\Publisher\Console\Update;

class CarritoController extends Controller
{
    // public function index(){
    //     if (auth::check()) {
            
    //     }
    // }

    public function addToCart($id_pro){
        $producto = productos::findOrFail($id_pro);

        if (Auth::check()) {
            $carrito = Carrito::where('user_id', Auth::id())
                              ->where('producto_id', $id_pro)
                              ->first();

            if ($carrito) {
                if ($carrito->cantidad >= 1 && $carrito->cantidad < $producto->stock) {
                    $carrito->cantidad += 1;
                    $carrito->save();
                }
            }else{
                Carrito::create([
                    'user_id' => Auth::id(),
                    'producto_id' => $id_pro,
                    'cantidad' => 1,
                ]);

            }
            return redirect()->route('/');
        }else {
            // Usuario no autenticado, almacena en la sesión
            $carrito = session()->get('carrito', []);
            if (isset($carrito[$id_pro]) && $carrito[$id_pro]['cantidad'] >= 1 && $carrito[$id_pro]['cantidad'] < $producto->stock) {
                $carrito[$id_pro]['cantidad'] += 1;
            } else {
                $carrito[$id_pro] = [
                    "nombre" => $producto->nombre,
                    "id" => $producto->id_pro,
                    "cantidad" => 1,
                    "precio" => $producto->precio,
                ];
            }
            session()->put('carrito', $carrito);
            return redirect()->route('/');
        }
    }

    public function index() {
        $total = 0;
    
        if (Auth::check()) {
            // Usuarios autenticados: carrito desde la base de datos
            $carritos = Carrito::with('producto')->where('user_id', Auth::id())->get();
    
            // Calcular el total
            foreach ($carritos as $carrito) {
                $total += $carrito->producto->precio * $carrito->cantidad;
            }
    
        } else {
            // Usuarios no autenticados: carrito desde la sesión
            $carritos = session()->get('carrito', []);
    
            // Calcular el total
            foreach ($carritos as $carrito) {
                $total += $carrito['precio'] * $carrito['cantidad'];
            }
        }
    
        // Pasar el total a la vista
        return view('usuario.carrito', [
            'carritos' => $carritos,
            'total' => $total
        ]);
    }
    

    public function delete($id){
        
        if (Auth::check()) {
            $carrito = Carrito::findOrFail($id);
            $carrito->delete(); 
        }else{
            $carrito = session()->get('carrito', []);

            if (isset($carrito[$id])) {
                unset($carrito[$id]);
                session()->put('carrito', $carrito); 
            }
        }
        return redirect()->route('verCarrito');
    }

    public function sumarCarrito($id){
        $carrito = Carrito::findOrFail($id);
        $producto = productos::findOrFail($carrito->producto_id);
    
        // Encuentra el producto asociado con el carrito
        if (Auth::check()) {
            
    
            if ($carrito->cantidad >= 1 && $carrito->cantidad < $producto->stock) {
                $carrito->cantidad += 1;
                $carrito->save();
            }
        } else {
            // For unauthenticated users, retrieve the cart from the session
            $carrito = session()->get('carrito', []);
    
            if (isset($carrito[$id]) && $carrito[$id]['cantidad'] >= 1 && $carrito[$id]['cantidad'] < $producto->stock) {
                $carrito[$id]['cantidad'] += 1;
                session()->put('carrito', $carrito);
            }
        }

        return redirect()->route('verCarrito');
    }

   
    

    public function restarCarrito($id){

        if (Auth::check()) {
            
            $carrito = Carrito::findOrFail($id);
    
            if ($carrito->cantidad > 1 ) {
                $carrito->cantidad -= 1;
                $carrito->save();
            }
        } else {
            // For unauthenticated users, retrieve the cart from the session
            $carrito = session()->get('carrito', []);
    
            if (isset($carrito[$id]) && $carrito[$id]['cantidad'] > 1 ) {
                $carrito[$id]['cantidad'] -= 1;
                session()->put('carrito', $carrito);
            }
        }

        return redirect()->route('verCarrito');
    }

    public function validarCarrito(){
        if (Auth::check()) {
            // Verifica la existencia del carrito y de los detalles de envío
            $carrito = Carrito::where('user_id', Auth::id())->exists();
            $envio = detalles_envio::where('user_id', Auth::id())->exists();

            if (!$carrito) {
                // Si no hay productos en el carrito
                return response()->json(['status' => 'NotProduct']);
            }

            if (!$envio) {
                // Si no hay detalles de envío
                return response()->json(['status' => 'NotEnvio']);
            }

            // Si el carrito y el detalle de envío existen
            return response()->json(['status' => 'success']);
        } else {
            // Si el usuario no está autenticado
            return response()->json(['status' => 'notAuth']);
        }
    }


    public function pagar(){
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Recupera los productos en el carrito del usuario autenticado
            $carrito = Carrito::where('user_id', Auth::id())->get();

            $total = 0;
            // Itera sobre los productos en el carrito para calcular el total
            foreach ($carrito as $carrit) {
                $producto = productos::find($carrit->producto_id); // Recupera el producto específico
                $total += $carrit->cantidad * $producto->precio; // Calcula el total
            }

            return view('usuario.pagar', compact('total'));
        } else {
            // Redirige a la página de inicio de sesión si el usuario no está autenticado
            return redirect()->route('login');
        }
    }



}
