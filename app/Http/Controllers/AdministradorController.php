<?php

namespace App\Http\Controllers;

use App\Models\det_factura;
use Illuminate\Http\Request;
use App\Models\det_usu;
use App\Models\usuarios;
use App\Models\detalles_envio;
use App\Models\Facturacion;
use App\Models\productos;
use App\Models\det_productos;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdministradorController extends Controller
{
    
    //ADMINISTRADOR

    //usuarios

    public function dashboardAdmin() {
        $usuarios = usuarios::count();
        $productos = productos::count();
        $ventas = Facturacion::count();
        $productosData = $this->cargarRueda(); // Obtener los datos de productos
        
        // Pasar $productosData a la vista
        return view('administrador.dashboard', compact('usuarios', 'productos', 'ventas', 'productosData'));
    }
    
    private function cargarRueda() {
        $productos = productos::all(); // Obtener todos los productos
    
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

    public function verUserAdmin (){
        $usuarios = usuarios::all();

        return view('administrador.usuario.admiVerUser', ['usuarios' => $usuarios]);
    }

    public function expoUserAdmin(){
        $usuarios = usuarios::all();

        return view('administrador.usuario.admiExpoUser', ['usuarios' => $usuarios]);
    }

    public function registerUserStore(Request $request){
        $rules = [
            'documento' => 'required|min:5',
            'email' => 'required|email|unique:usuarios,email',
            'nombres' => 'required|string|min:3',
            'apellidos' => 'required|string|min:3',
            'rol' => 'required|string',
            'telefono' => 'required|numeric',
            'password' => 'required|min:3|confirmed',
        ];

        $rutaFoto = null;
        if ($request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('animacion-inicio/Uploads/fotosUsu', 'public');
        }else{
            $rutaFoto = 'animacion-inicio/Uploads/fotosUsu/predefinido.jpg';
        }

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
        $usuario->documento = $request->documento;
        $usuario->save();
    
        // Crear y guardar el detalle del usuario
        $det_usu = new det_usu();
        $det_usu->id_usuario = $usuario->id; // Asignar el ID del usuario
        $det_usu->nombres = $request->nombres;
        $det_usu->apellidos = $request->apellidos;
        $det_usu->rol = $request->rol;
        $det_usu->estado = $request->estado;
        $det_usu->telefono = $request->telefono;
        $det_usu->foto = $rutaFoto;
        $det_usu->save();
    
        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request, $id){
        // Aquí se podría realizar alguna validación adicional si es necesario
    
        // Encontrar la tarea por su ID y eliminarla
        $usuario = usuarios::findOrFail($id);
        
        $usuario->delete();
    
        // Redirigir de vuelta a la vista de tareas con un mensaje de éxito

        return redirect()->route('admiVerUser');
    }

    public function obtenerUsuario($id){
        $usuario = usuarios::with('detUsu')->find($id);
        return response()->json($usuario);
    }

    public function actualizarUsuario(Request $request){
        // Encuentra el usuario con la relación `detUsu`
        $usuario = usuarios::with('detUsu')->find($request->id);

        if ($usuario) {
            // Actualiza los datos del usuario en la tabla `usuarios`
            $usuario->update([
                'email' => $request->email,
            ]);

            // Actualiza los datos relacionados en la tabla `detUsu`
            $usuario->detUsu->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'rol' => $request->rol,
                'estado' => $request->estado,
            ]);
            
            return redirect()->route('admiVerUser')->with('success', 'Usuario actualizado con éxito');
        }

        return redirect()->route('admiVerUser')->with('error', 'Usuario no encontrado');
    }

    


    //productos


    
    public function verProveedor(){
        // Obtener solo los valores de la columna 'proveedor' sin duplicados
        $proveedores = det_productos::pluck('proveedor')->unique();
        
        // Pasar los resultados a la vista
        return view('administrador.productos.admiRegistrarProd', ['proveedores' => $proveedores]);
    }

    public function verProdAdmin (){
        $productos = productos::all();

        return view('administrador.productos.admiVerProd', ['productos' => $productos]);
    }
    public function expoProdAdmin(){
        $productos = productos::all();

        return view('administrador.productos.admiExpoProd', ['productos' => $productos]);
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
    
        // Crear y guardar el producto
        $productos = new productos();
        $productos->nombre = $request->nombre;
        $productos->categoria = $request->categoria;
        $productos->descripcion = $request->descripcion;
        $productos->estado = $request->estado;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;
        $productos->save();
    
        // Crear y guardar el detalle del producto
        $det_prod = new det_productos();
        $det_prod->id_productos = $productos->id_pro; // Asignar el ID del producto
        $det_prod->proveedor = $request->proveedor;
        $det_prod->foto = $rutaFoto; // Guardar la ruta de la foto
        $det_prod->save();
    
        return response()->json(['status' => 'success']);
    }

    public function destroyProd(Request $request, $id){
        // Aquí se podría realizar alguna validación adicional si es necesario
    
        // Encontrar la tarea por su ID y eliminarla
        $tarea = productos::findOrFail($id);
        $tarea->delete();
    
        // Redirigir de vuelta a la vista de tareas con un mensaje de éxito

        return redirect()->route('admiVerProd');
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
            ]);

            // Actualiza los datos relacionados en la tabla `detUsu`
            $producto->detProducto->update([
                'proveedor' => $request->proveedor,
            ]);
            
            return redirect()->route('admiVerProd')->with('success', 'Producto actualizado con éxito');
        }

        return redirect()->route('admiVerProd')->with('error', 'Producto no encontrado');
    }


    //FIN DE ACCIONES DE ADMINISTRADOR
}
