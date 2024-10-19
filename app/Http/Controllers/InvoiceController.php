<?php

namespace App\Http\Controllers;

use App\Mail\DecrocheMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\facturacion;
use App\Models\Carrito;
use App\Models\productos;
use App\Models\det_factura;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function procesarOrden(){
        $usuario = Auth::user();
        $total = 0;
        $num_factura = $this->generarNumeroServicio(); 
        
        // Obtener los productos del carrito para el usuario autenticado
        $carritoItems = Carrito::where('user_id', $usuario->id)->get();

        foreach ($carritoItems as $carritoItem) {
            $producto = productos::findOrFail($carritoItem->producto_id);
            if ($producto) {
                $total += $producto->precio * $carritoItem->cantidad;
            }
        }

        // Crear y guardar la factura
        $factura = new facturacion();
        $factura->user_id = $usuario->id;
        $factura->numero_factura = $num_factura;
        $factura->total = $total;
        $factura->save(); // No olvides guardar la factura en la base de datos

        // Llamar a det_facturas para guardar los detalles de la factura
        $id_det_factura = $factura->id;
        $this->det_facturas($factura->id, $carritoItems);
        
        // Mostrar la factura
        return $this->mostrarFactura($num_factura, $id_det_factura);
    }

    public function det_facturas($factura_id, $carritoItems)
    {
        foreach ($carritoItems as $carritoItem) {
            $producto = productos::findOrFail($carritoItem->producto_id);
            
            if ($producto) {
                $det_factura = new det_factura();
                $det_factura->id_factura = $factura_id;
                $det_factura->producto_id = $carritoItem->producto_id;
                $det_factura->cantidad = $carritoItem->cantidad;
                $det_factura->save(); // Guarda los detalles de la factura en la base de datos
            }
        }

        
    }

    public function mostrarFactura($num_factura, $id_det_factura){
        // Configura el cliente y el comprador
        $client = new Party([
            'name'          => 'DeCroche',
            'phone'         => '(57) 3209925729',
            'custom_fields' => [
                'nota'        => 'Gracias por tu compra',
                'business id' => '365#GG',
            ],
        ]);
    
        $customer = new Party([
            'name'          => Auth::user()->detUsu->nombres,
            'address'       => Auth::user()->detEnvios->direccion,
            'email'         => Auth::user()->detEnvios->email,
            'custom_fields' => [
                'order number' => $num_factura,
                'email' => Auth::user()->detEnvios->email,
            ],
        ]);
    
        // Generar los ítems de la factura
        $items = [];
        $carritoItems = Carrito::where('user_id', Auth::user()->id)->get();
        foreach ($carritoItems as $carritoItem) {
            $producto = productos::findOrFail($carritoItem->producto_id);
            if ($producto) {
                $items[] = InvoiceItem::make($producto->nombre)
                    ->description($producto->descripcion)
                    ->pricePerUnit($producto->precio)
                    ->quantity($carritoItem->cantidad);
            }
        }
    
        $notes = [
            'Notas adicionales sobre el pedido.',
        ];
        $notes = implode("<br>", $notes);
    
        // Generar la factura
        $invoice = Invoice::make('DECROCHE')
            ->series('BIG')
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('COP')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . '' . $num_factura)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('animacion-inicio/client-side/images/decrochea.png'))
            ->save('facturas');
    
        // Obtener la URL del PDF
        $pdfUrl = route('factura.pdf', ['filename' => $invoice->filename]);
        
        $pdfPath = storage_path('app/public/facturas/' . $invoice->filename);
        
        // ENVIAR CORREO
        Mail::to(Auth::user()->detEnvios->email)->send(new DecrocheMail($id_det_factura, $pdfPath,  $num_factura));
        
        Carrito::where('user_id', Auth::user()->id)->delete();


        // Limpia el carrito después de procesar la orden
    
        return view('usuario.redirigirFactura', [
            'pdfUrl' => $pdfUrl,
            'redirectUrl' => route('perfilRol')
        ]);



        
    }

    public function mostrarPdf($filename)
    {
        $pdfPath = storage_path('app/public/Facturas/' . $filename);
        return response()->file($pdfPath);
        
    }



    
    private function generarNumeroServicio()
    {
        return 'NS-' . strtoupper(uniqid());
    }
}
