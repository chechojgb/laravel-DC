<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pqr_servicios;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ModelNotFoundException;

class pqrServicios extends Controller
{
    public function showPqr($pqr){
        $title = '';

        switch($pqr) {
            case 'reclamo':
                $title = 'Reclamo';
                break;
            case 'queja':
                $title = 'Queja';
                break;
            case 'peticion':
                $title = 'Petición';
                break;
            default:
                abort(404); // Si el valor de pqr no es válido
        }

        return view('servicios.pqr', compact('title'));
    }

    public function storePqr(Request $request){
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3',
            'email' => 'required|email|',
            'detalle' => 'required|string|min:10',
            'motivo' => 'required|string',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }
        
        // Procesamiento del archivo adjunto
        $rutaFoto = null;
        if ($request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('animacion-inicio/Uploads/pqr', 'public');
        }
        
        $num_servicio = $this->generarNumeroServicio(); 

    
        // Guardar los datos en la base de datos
        $radicado = new pqr_servicios();
        $radicado->num_servicio = $num_servicio;  // Asignar un número de servicio único
        $radicado->nombre = $request->nombre;
        $radicado->email = $request->email;
        $radicado->motivo = $request->motivo;
        $radicado->detalle = $request->detalle;
        $radicado->foto = $rutaFoto;
        $radicado->estado = 'Sin contestar';
        $radicado->tipo_servicio = $request->tipo_servicio;
        $radicado->respuesta = 'Sin respuesta';
        $radicado->save();

        return response()->json([
            'status' => 'success',
            'radicado' => $radicado->id,
            'redirect' => route('servicios.radicado', ['radicado' => $radicado->num_servicio])
        ]);

    }
    
    // Ejemplo de función para generar un número de servicio único
    private function generarNumeroServicio(){
        return 'NS-' . strtoupper(uniqid());
    }

    public function showRadicado ($radicado){
        $radicados = pqr_servicios::where('num_servicio', $radicado)->first();

        // Verifica si el radicado existe
        if (!$radicados) {
            abort(404); // O maneja el caso de producto no encontrado como prefieras
        }



        // Retorna a la vista con el radicado
        return view('servicios.radicado', ['radicados' => $radicados]);
    }
    

    public function buscarConsulta(Request $request){
        $consulta = pqr_servicios::where('num_servicio', $request->num_servicio)->first();

        if (!$consulta) {
            return response()->json(['error' => 'Consulta no encontrada'], 404);
        }

        return response()->json([
            'nombre' => $consulta->nombre,
            'email' => $consulta->email,
            'motivo' => $consulta->motivo,
            'detalle' => $consulta->detalle,
            'tipo_servicio' => $consulta->tipo_servicio,
            'fecha' => $consulta->created_at->format('d/m/Y'),
            'estado' => $consulta->estado,
            'respuesta' => $consulta->respuesta,
        ]);
    }

    //ACCIONES ADMINISTRADOR
    public function verPqrAdmin (){
        $peticiones = pqr_servicios::all();

        return view('administrador.pqr.admiVerPqr', ['peticiones' => $peticiones]);
    }

    public function obtenerPeticion($id){
        $peticion = pqr_servicios::where('id_servicios', $id)->first();
        return response()->json($peticion);
    }

    public function actualizarPqr(Request $request){
        // Encuentra la petición (PQR) por su número de servicio
        $peticion = pqr_servicios::find($request->idPqr);
    
        if ($peticion) {
            // Actualiza los datos del PQR en la tabla `pqr_servicios`
            $peticion->update([
                'estado' => $request->estado,
                'respuesta' => $request->respuesta,
            ]);
    
            return redirect()->route('admiVerPqr')->with('success', 'PQR actualizado con éxito');
        }
    

    }
    
    public function expoPqrAdmin(){
        $radicados = pqr_servicios::all();

        return view('administrador.pqr.admiExpoPqr', ['radicados' => $radicados]);
    }
    
}
