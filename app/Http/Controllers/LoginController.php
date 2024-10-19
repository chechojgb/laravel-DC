<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\det_usu;
use App\Models\usuarios;
use App\Models\detalles_envio;
use App\Models\Facturacion;
use App\Models\productos;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

     
    
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request){
        // Traemos la información desde Google
        $user_google = Socialite::driver('google')->user();

        // Buscar o crear un nuevo registro de usuario
        $usuario = usuarios::updateOrCreate(
            ['google_id' => $user_google->id], // Condición para encontrar el usuario
            [
                'email' => $user_google->email,
                'documento' => 'N/A',
            ]
        );

        // Buscar el detalle del usuario
        $det_usu = det_usu::where('id_usuario', $usuario->id)->first();

        // Si no se encuentra el detalle, crear uno nuevo
        if (!$det_usu) {
            $det_usu = det_usu::create([
                'id_usuario' => $usuario->id,
                'nombres' => $user_google->name,
                'apellidos' => '', // Si no tienes los apellidos separados, puedes dejarlos vacíos
                'rol' => 'Cliente',
                'estado' => 'Activo',
                'telefono' => 'N/A',
                'foto' => $user_google->avatar
            ]);
        }

        // Autenticar al usuario y el true es para mantener la sesión siempre activa
        Auth::login($usuario, true);

        // Obtener el detalle del usuario para redirigir según el rol
        $detUsu = $usuario->detUsu; // Asegúrate de que la relación esté definida en el modelo Usuario

        // Redirigir según el rol del usuario
        switch ($detUsu->rol) {
            case 'Cliente':
                return redirect('/');
            case 'Administrador':
                return redirect('/administrador');
            case 'Vendedor':
                return redirect('/vendedor');
            default:
                abort(404); // Si el valor de rol no es válido
        }
    }



    public function registerUsuario(Request $request) {
        // Validar los datos del formulario
        $rules = [
        'email' => 'required|email|unique:usuarios,email',
        'password' => 'required|min:6|confirmed',
        'nombres' => 'required|string|min:3',
        'apellidos' => 'required|string|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

    
        // Crear y guardar el usuario
        $usuario = new usuarios();
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->documento = 'N/A';
        $usuario->save();
    
        // Crear y guardar el detalle del usuario
        $det_usu = new det_usu();
        $det_usu->id_usuario = $usuario->id; // Asignar el ID del usuario
        $det_usu->nombres = $request->nombres;
        $det_usu->apellidos = $request->apellidos;
        $det_usu->rol = 'Cliente';
        $det_usu->estado = 'Activo';
        $det_usu->telefono = 'N/A';
        $det_usu->foto = 'animacion-inicio/Uploads/fotosUsu/predefinido.jpg';
        $det_usu->save();
    
        return response()->json(['status' => 'success']);
    }

    public function login(Request $request){
        // Validación de los datos de entrada
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);


        // Credenciales a comprobar
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }
    
    
        // Intentar autenticar al usuario con las credenciales
        $remember = $request->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();  //Obtiene el usuario en cado de que las credenciales esten correctas
            $detUsu = $user->detUsu; //Obtiene la asociacion de la tabla det_usu

            // Verificar el estado en la tabla asociada
            if ($detUsu && $detUsu->estado === 'Activo') {
            $request->session()->regenerate();
            
            // Redirigir según el rol del usuario
            switch ($detUsu->rol) {
                case 'Cliente':
                    return response()->json(['status' => 'cliente']);
                case 'Administrador':
                    return response()->json(['status' => 'administrador']);
                case 'Vendedor':
                    return response()->json(['status' => 'vendedor']);
                default:
                    Auth::logout(); // Desloguear en caso de rol desconocido
                    return response()->json(['status' => 'error', 'message' => 'Rol desconocido']);
            }
        }
            
            //Esto desloguea y retorna mensaje 
            Auth::logout();
            return response()->json(['status' => 'inactivo']);
        }
    
        // Si las credenciales no coinciden, retornar error
        return response()->json(['status' => 'invalido']);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('/');
    }




    

    public function perfilRol(){
        if (Auth::check()) {
            $user = Auth::user();  // Obtén el usuario autenticado
    
            if ($user->detUsu->rol == 'Administrador') {
                return redirect()->route('administrador');
            }
            if ($user->detUsu->rol == 'Vendedor') {
                return redirect()->route('vendedor');
            }
        }
    
        // Opcionalmente, puedes añadir una redirección o acción para otros roles o usuarios no autenticados
        return redirect()->route('/'); // Ejemplo de redirección a la página principal
    }

    public function actualizarDireccion(Request $request){
        $user = Auth::user(); // Puedes omitir la verificación de Auth::check() ya que asumes que la ruta está protegida.

        // Validación de los datos del request.
        $rules = [
            'ciudad' => 'required|string|max:255|min:3',
            'barrio' => 'required|string|max:255|min:4',
            'direccionEntrega' => 'required|string|max:255|min:4',
            'telefono' => 'required|string|max:15|min:4',
        ];
        

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        // Actualiza o crea la entrada en la tabla detalles_envio
        $usuario = detalles_envio::updateOrCreate(
            ['user_id' => $user->id], // Condición para encontrar el usuario
            [
                'ciudad' => $request->ciudad,
                'email' => $user->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccionEntrega,
                'barrio' => $request->barrio
            ]
        );

        return response()->json(['status' => 'success']);
    }
    

    public function actualizarPerfil(Request $request){
        $user = Auth::user(); // Puedes omitir la verificación de Auth::check() ya que asumes que la ruta está protegida.

        // Validación de las reglas.
        $rules = [
            'nombres' => 'required|string|max:255|min:3',
            'email' => 'required|string|max:255|min:4,confirmed',
        ];
        

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        $usuario = usuarios::updateOrCreate(
            ['id' => $user->id], // Condición para encontrar el usuario
            [
                'email' => $request->email,
            ]
        );

        $usuario = det_usu::updateOrCreate(
            ['id_usuario' => $user->id], // Condición para encontrar el usuario
            [
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function cambiarClave(Request $request){
        // Validar la entrada

        $rules = [
            'clave_actual' => 'required',
            'nueva_clave' => 'required|min:6',
        ];
        

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Buscar el usuario en la base de datos (esto asegura que se pueda guardar el cambio)
        $user = usuarios::find($usuario->id);

        // Verificar que la contraseña actual coincida con la ingresada
        if (!Hash::check($request->clave_actual, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'La contraseña actual es incorrecta.'], 400);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->nueva_clave);
        $user->save(); // Guardar los cambios en la base de datos

        return response()->json(['status' => 'success']);
    }



    
}
