<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function createPaymentPreference()
    {
        // Configura MercadoPago con el token de acceso
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // Obtiene los productos del carrito para usuarios autenticados
        if (Auth::check()) {
            // Usuarios autenticados: carrito desde la base de datos
            $carritos = Carrito::with('producto')->where('user_id', Auth::id())->get();

            // Prepara los datos de los items para la preferencia
            $items = [];
            foreach ($carritos as $carrito) {
                $items[] = [
                    "title" => $carrito->producto->nombre, // Asegúrate de que este campo exista en tu modelo Producto
                    "quantity" => $carrito->cantidad,
                    "unit_price" => $carrito->producto->precio // Asegúrate de que este campo exista en tu modelo Producto
                ];
            }

            // Crea una instancia del cliente de preferencias
            $client = new PreferenceClient();

            $backUrls = array(
                'success' => route('mercadopago.success'),
                'failure' => route('mercadopago.failed')
            );
            // Define los datos de la preferencia
            $preference = $client->create([
                "items" => $items,
                "back_urls" => $backUrls,
            ]);
            
            
            // Devuelve el ID de la preferencia para el frontend
            return response()->json(['id' => $preference->id]);
        }

        return response()->json(['error' => 'No estás autenticado.'], 401);
    }

    public function success(Request $request){
        $invoiceController = app(InvoiceController::class);
        
        // Llamar al método procesarOrden
        return $invoiceController->procesarOrden();
    }

    public function failed(Request $request)
    {
        // Aquí manejas lo que sucede cuando el pago falla

        // return view('payment.failed'); // Una vista que muestre que el pago falló


        $invoiceController = app(InvoiceController::class);
        
        // Llamar al método procesarOrden
        return $invoiceController->procesarOrden();
    }
    
    public function pending(Request $request)
    {
        // Aquí manejas lo que sucede cuando el pago queda pendiente

        return view('payment.pending'); // Una vista que muestre que el pago está pendiente
    }
}



