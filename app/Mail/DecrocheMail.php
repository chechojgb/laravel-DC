<?php

namespace App\Mail;

use App\Models\det_factura;
use App\Models\detalles_envio;
use App\Models\Carrito;
use App\Models\productos;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DecrocheMail extends Mailable
{
    use Queueable, SerializesModels;

    private $id_det_factura;
    private $pdfPath;
    private $num_factura;

    /**
     * Create a new message instance.
     */
    public function __construct($id_det_factura, $pdfPath,  $num_factura)
    {
        $this->id_det_factura = $id_det_factura;
        $this->pdfPath = $pdfPath; // Asignar la ruta del archivo PDF
        $this->num_factura =  $num_factura;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Soporte de compra Decroche',
            
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Obtén los detalles necesarios para el correo
        $det_envios = detalles_envio::where('user_id', Auth::user()->id)->first();
        $det_facturas = det_factura::where('id_factura', $this->id_det_factura)->get();
        $productos = productos::whereIn('id_pro', $det_facturas->pluck('producto_id'))->get();
    
        // Extrae los datos necesarios
        $direccion = $det_envios->direccion ?? '';
        $ciudad = $det_envios->ciudad ?? '';
        $correo = $det_envios->email ?? '';
        $celular = $det_envios->telefono ?? '';
        $nombre_completo = Auth::user()->detUsu->nombres ?? '';

        // dd($det_envios, $det_facturas, $productos);
        

         // Limpia el carrito después de procesar la orden
        //  Carrito::where('user_id', Auth::user()->id)->delete();
        return new Content(
            view: 'mails.facturaMail',
            with: [
                'id_factura' => $this->num_factura,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'correo' => $correo,
                'celular' => $celular,
                'nombre_completo' => $nombre_completo,
                'productos' => $productos,
                'det_facturas' => $det_facturas,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->pdfPath)->as('Factura.pdf')->withMime('application/pdf')
        ];
    }
}
