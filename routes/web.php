<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroControlador;
use App\Http\Controllers\SessionControlador;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\MesasControlador;
use App\Http\Controllers\ProductosControlador;
use App\Http\Controllers\MensajeControlador;
use App\Http\Controllers\OrdenControlador;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');
/*
Route::get('/productos',[ProductosControlador::class, 'index'])
->name('productos.index');

Route::get('/productos/crear',[ProductosControlador::class, 'crear'])
->name('productos.crear');

Route::post('/productos/crear',[ProductosControlador::class, 'guardar'])
->name('productos.guardar');
*/
//Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');


Route::resource('productos', ProductosControlador::class);

Route::get('/register',[RegistroControlador::class, 'create'])
->middleware('guest')
->name('register.index');

Route::post('/register',[RegistroControlador::class, 'store'])
->name('register.store');

Route::get('/login',[SessionControlador::class, 'create'])
->middleware('guest')
->name('login.index');

Route::post('/login',[SessionControlador::class, 'store'])
->name('login.store');

Route::get('/logout',[SessionControlador::class, 'destroy'])
->middleware('auth')
->name('login.destroy');

Route::get('/admin',[AdminControlador::class,'index'])
->middleware('auth.admin')
->name('admin.index');
Route::get('/mostrar',[ProductosControlador::class,'compras'])
->name('productos.mostrar');
Route::get('/nosotros',[ProductosControlador::class,'nosotros'])
->name('productos.nosotros');
Route::get('cart',[ProductosControlador::class,'cart'])
->name('cart');
Route::get('añadir-carrito/{id}',[ProductosControlador::class,'añadirCarrito'])
->name('añadir-carrito');
Route::patch('update-cart', [ProductosControlador::class, 'update'])
->name('update_cart');
Route::delete('remove-from-cart', [ProductosControlador::class, 'remove'])
->name('remove_from_cart');
//-------------------------------Mesas--------------------------------
Route::resource('mesas', MesasControlador::class);
Route::get('/generar',[MesasControlador::class,'generar_qr']);
Route::get('/qrcode',[MesasControlador::class,'qrcode']);
//----------------------------Mensaje------------------------
Route::resource('mensaje', MensajeControlador::class);
Route::get('/contacto',[MensajeControlador::class,'contacto'])
->name('mensaje.contacto');
Route::get('/buscar-id-mesa', [OrdenControlador::class,'buscarIdMesa']);
Route::get('mesas/descargar-qr/{id}', [MesasControlador::class,'descargarQR'])->name('descargar.qr');
/*Route::get('/mensajes',[MensajeControlador::class,'index'])
->name('mensaje.mostrar');
Route::post('/mandar',[MensajeControlador::class, 'store'])
->name('mensaje.store');*/

//-----------------------Orden-------------------------

Route::get('/pedidos',[OrdenControlador::class,'realizado'])
->name('orden.realizado');
Route::post('/session',[OrdenControlador::class, 'guardarCompra'])
->name('orden.historial');
Route::middleware(['auth'])->group(function () {
    // Otras rutas que requieren autenticación...

    Route::get('/mostrar-orden', [OrdenControlador::class, 'mostrarOrden'])->name('orden.historial');
});
//Route::match(['get', 'post'], '/session', [OrdenControlador::class, 'guardarCompra']);
Route::get('/clientes',[RegistroControlador::class,'index'])
->name('usuario.index');
Route::get('/admin/historial', [OrdenControlador::class,'mostrarHistorialAdmin'])->name('orden.realizado');
