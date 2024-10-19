<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\pqrServicios;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\facturasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\calificacionProducto;
use App\mail\DecrocheMail;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', [productosController::class, 'index'])->name('/');



Route::get('/google-auth/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');

Route::get('/google-auth/callback', [LoginController::class, 'handleGoogleCallback'])->name('google.callback');




Route::get('/logueo', function () {
    return view('usuario.sesion.logueo');
})->name('logueo');

Route::get('/registro', function () {
    return view('usuario.sesion.registro');
});


Route::get('/privado', function () {
    return view('usuario.sesion.hola');
})->name('privado');

Route::get('/perfil', function () {
    return view('usuario.sesion.perfil');
})->name('perfil');



Route::get('/verFacturas', [facturasController::class, 'verFacturasUsuario'])->name('verFacturas');
Route::get('/productosComprados', [facturasController::class, 'verProductosComprados'])->name('productosComprados');
Route::get('/calificacion/{id_pro}', [calificacionProducto::class, 'calificacionProducto'])->name('calificacion');
Route::post('/calificarProducto/{id_pro}/{calificacion}', [calificacionProducto::class, 'storeCalificacion'])->name('calificarProducto');

//Registro y logueo de usuarios
Route::post('/validar.registro.usu', [LoginController::class, 'registerUsuario'])->name('validar.registro.usu');

Route::post('/inicio.sesion', [LoginController::class, 'login'])->name('inicio.sesion');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/perfilRol', [LoginController::class, 'perfilRol'])->name('perfilRol');
Route::post('/actualizarDireccion', [LoginController::class, 'actualizarDireccion'])->name('actualizarDireccion');
Route::post('/actualizarPerfil', [LoginController::class, 'actualizarPerfil'])->name('actualizarPerfil');
Route::post('/cambiarClave', [LoginController::class, 'cambiarClave'])->name('cambiarClave');

//CARGADO DE PRODUCTOS

Route::get('/productos/{categoria}', [productosController::class, 'show'])->name('productos.show');
Route::get('/detalles-producto/{id_pro}', [ProductosController::class, 'showDet'])->name('detalles.producto.show');
//Busqueda de productos

Route::get('/buscar', [productosController::class, 'buscar'])->name('buscar');


//SERVICIOS

Route::get('/servicios', function () {return view('servicios.servicios');})->name('servicios');
Route::get('/politicas', function () {return view('servicios.politicas');})->name('politicas');
Route::get('/canalAtencion', function () {return view('servicios.canalAtencion');})->name('canalAtencion');
Route::get('/seguimientoCasos', function () {return view('servicios.seguimientoCasos');})->name('seguimientoCasos');

Route::get('/servicios.show/{pqr}', [pqrServicios::class, 'showPqr'])->name('servicios.show');
Route::post('/guardarPqr', [pqrServicios::class, 'storePqr'])->name('guardarPqr');
Route::get('/servicios.radicado/{radicado}', [pqrServicios::class, 'showRadicado'])->name('servicios.radicado');
Route::post('/buscar.consulta', [pqrServicios::class, 'buscarConsulta'])->name('buscar.consulta');

//ADMINISTRADOR

Route::middleware(['auth', 'Administrador'])->group(function () {
    
    Route::get('/administrador', [AdministradorController::class, 'dashboardAdmin'])->name('administrador');
    //ADMINISTRADOR-USUARIOS
    Route::get('/admiRegistrarUser', function () {return view('administrador.usuario.admiRegistrarUser');})->name('admiRegistrarUser');
    Route::post('/registroUserAdmin', [AdministradorController::class, 'registerUserStore'])->name('registroUserAdmin.storeAdmin');
    Route::post('/usuario.destroy/{id}', [AdministradorController::class, 'destroy'])->name('usario.destroy');
    Route::get('/usuarios/{id}', [AdministradorController::class, 'obtenerUsuario']);
    Route::post('/actualizar-usuario', [AdministradorController::class, 'actualizarUsuario'])->name('actualizar_usuario');
    Route::get('/admiVerUser', [AdministradorController::class, 'verUserAdmin'])->name('admiVerUser');
    Route::get('/admiExpoUser', [AdministradorController::class, 'expoUserAdmin'])->name('admiExpoUser');
    
    //ADMINISTRADOR-PRODUCTOS
    
    //3 rutas para ver las paginas de registrar, ver y exportar productos
    Route::get('/admiRegistrarProd', [AdministradorController::class, 'verProveedor'])->name('admiRegistrarProd');
    Route::get('/admiVerProd', [AdministradorController::class, 'verProdAdmin'])->name('admiVerProd');
    Route::get('/admiExpoProd', [AdministradorController::class, 'expoProdAdmin'])->name('admiExpoProd');
    
    //Rutas para registrar, exportar, editar o eliminar productos
    Route::post('/registroProdAdmin', [AdministradorController::class, 'registerProdStore'])->name('registroProdAdmin');
    Route::get('/admiVerProd', [AdministradorController::class, 'verProdAdmin'])->name('admiVerProd');
    Route::post('/producto.destroy/{id}', [AdministradorController::class, 'destroyProd'])->name('producto.destroy');
    Route::get('/producto/{id}', [AdministradorController::class, 'obtenerProducto']);
    Route::post('/actualizar_producto', [AdministradorController::class, 'actualizarProducto'])->name('actualizar_producto');
    Route::get('/admiExpoProd', [AdministradorController::class, 'expoProdAdmin'])->name('admiExpoProd');
    
    //ADMINISTRADOR-PQR
    
    //Rutas para ver, exportar y editar pqr
    //Rutas para ver, exportar y editar pqr
    Route::get('/admiVerPqr', [pqrServicios::class, 'verPqrAdmin'])->name('admiVerPqr');
    Route::get('/peticion/{id}', [pqrServicios::class, 'obtenerPeticion']);
    Route::post('/actualizar_pqr', [pqrServicios::class, 'actualizarPqr'])->name('actualizar_pqr');
    Route::get('/admiExpoPqr', [pqrServicios::class, 'expoPqrAdmin'])->name('admiExpoPqr');

    //VER COMPRAS

    Route::get('/adminVerCompras', [facturasController::class, 'verComprasAdmin'])->name('admiVerCompras');
});




//VENDEDOR

Route::middleware(['auth', 'Vendedor'])->group(function () {
    
    Route::get('/vendedor', [VendedorController::class, 'dashboardVendedor'])->name('vendedor');
    
    
    //VENDEDOR-PRODUCTOS
    
    //3 rutas para ver las paginas de registrar, ver y exportar productos
    Route::get('/vistaProdVendedor', [VendedorController::class, 'vistaProdVendedor'])->name('vistaProdVendedor');
    Route::get('/vendedorVerProd', [VendedorController::class, 'verProdVendedor'])->name('vendedorVerProd');
    Route::get('/verExpoProdVendedor', [VendedorController::class, 'expoProdVendedor'])->name('verExpoProdVendedor');
    
    //Rutas para registrar, exportar, editar o eliminar productos
    Route::post('/registroProdVendedor', [VendedorController::class, 'registerProdStore'])->name('registroProdAdmin');
    Route::post('/producto.destroy/{id}', [VendedorController::class, 'destroyProd'])->name('producto.destroy');
    Route::get('/producto/{id}', [VendedorController::class, 'obtenerProducto']);
    Route::post('/actualizar', [VendedorController::class, 'actualizarProducto'])->name('actualizarProductoVendedor');
    

    //VER COMPRAS VENDEDOR

    Route::get('/vendedorVerCompras', [facturasController::class, 'verComprasVendedor'])->name('vendedorVerCompras');
});



//AGREGAR PRODUCTOS AL CARRITO

Route::post('/agregarProducto/{id_pro}', [CarritoController::class, 'addToCart'])->name('agregarProducto');
Route::get('/verCarrito', [CarritoController::class, 'index'])->name('verCarrito');
Route::post('/eliminarCarrito/{id}', [CarritoController::class, 'delete'])->name('eliminarCarrito');
Route::post('/sumarCarrito/{id}', [CarritoController::class, 'sumarCarrito'])->name('sumarCarrito');
Route::post('/restarCarrito/{id}', [CarritoController::class, 'restarCarrito'])->name('restarCarrito');
Route::post('/validarCarrito', [CarritoController::class, 'validarCarrito'])->name('validarCarrito');

Route::get('/pagar', [CarritoController::class, 'pagar'])->name('pagar');

//SECURITY CONTROL
Route::get('/login', function () {return view('usuario.sesion.logueo');})->name('login');





//CONTROL DE PAGOS Y FACTURACION
Route::get('/get-payment-preference', [PaymentController::class, 'createPaymentPreference'])->name('get.payment.preference');
Route::get('/mercadopago-success', [PaymentController::class, 'success'])->name('mercadopago.success');
Route::get('/mercadopago-failed', [PaymentController::class, 'failed'])->name('mercadopago.failed');
Route::get('/success', [PaymentController::class, 'success'])->name('success');
Route::get('/factura/{filename}', [InvoiceController::class, 'mostrarPdf'])->name('factura.pdf');

Route::get('/enviarCorreoFactura/{num_factura}', [DecrocheMail::class, 'content'])->name('enviarCorreoFactura');