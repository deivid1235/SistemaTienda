<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('dashboard');
    Route::get('/configuracion/menu', function () {
    $estilos = \App\Models\Estilo::all();$estiloActivo = \App\Models\Estilo::where('estado', 'ACTIVO')->first();
    return view('admin.configuracion.configuracion_menu', compact('estilos', 'estiloActivo'));})->middleware('auth')->name('configuracion.menu');
    //Ruta general de configuraciones
    Route::view('/configuracion', 'admin.configuracion.configuracion_menu')->name('configuracion.index');
    //Lista de bancos
    Route::get('/configuracion/banco', [App\Http\Controllers\BancoController::class, 'index'])->name('configuracion.banco')->middleware('auth');
    Route::post('/configuracion/banco', [App\Http\Controllers\BancoController::class, 'store'])->name('configuracion.banco.store')->middleware('auth');
    Route::put('/configuracion/banco/{banco}', [App\Http\Controllers\BancoController::class, 'update'])->name('configuracion.banco.update')->middleware('auth');
    Route::delete('/configuracion/banco/{banco}', [App\Http\Controllers\BancoController::class, 'destroy'])->name('configuracion.banco.destroy')->middleware('auth');
    //Lista de monedas
    Route::get('/configuracion/moneda', [App\Http\Controllers\MonedaController::class, 'index'])->name('configuracion.moneda')->middleware('auth');
    Route::post('/configuracion/moneda', [App\Http\Controllers\MonedaController::class, 'store'])->name('configuracion.moneda.store')->middleware('auth');
    Route::put('/configuracion/moneda/{moneda}', [App\Http\Controllers\MonedaController::class, 'update'])->name('configuracion.moneda.update')->middleware('auth');
    Route::delete('/configuracion/moneda/{moneda}', [App\Http\Controllers\MonedaController::class, 'destroy'])->name('configuracion.moneda.destroy')->middleware('auth');
    //Lista de cuenta bancarias
    Route::get('/configuracion/cuentabancaria', [App\Http\Controllers\CuentaBancariaController::class, 'index'])->name('configuracion.cuentabancaria')->middleware('auth');
    Route::post('/configuracion/cuentabancaria', [App\Http\Controllers\CuentaBancariaController::class, 'store'])->name('configuracion.cuentabancaria.store')->middleware('auth');
    Route::put('/configuracion/cuentabancaria/{cuentabancaria}', [App\Http\Controllers\CuentaBancariaController::class, 'update'])->name('configuracion.cuentabancaria.update')->middleware('auth');
    Route::delete('/configuracion/cuentabancaria/{cuentabancaria}', [App\Http\Controllers\CuentaBancariaController::class, 'destroy'])->name('configuracion.cuentabancaria.destroy')->middleware('auth');
    // Lista de tarjetas
    Route::get('/configuracion/tarjeta', [App\Http\Controllers\TarjetaController::class, 'index'])->name('configuracion.tarjeta')->middleware('auth');
    Route::post('/configuracion/tarjeta', [App\Http\Controllers\TarjetaController::class, 'store'])->name('configuracion.tarjeta.store')->middleware('auth');
    Route::put('/configuracion/tarjeta/{tarjeta}', [App\Http\Controllers\TarjetaController::class, 'update'])->name('configuracion.tarjeta.update')->middleware('auth');
    Route::delete('/configuracion/tarjeta/{tarjeta}', [App\Http\Controllers\TarjetaController::class, 'destroy'])->name('configuracion.tarjeta.destroy')->middleware('auth');
    // Lista de plataformas
    Route::get('/configuracion/plataforma', [App\Http\Controllers\PlataformaController::class, 'index'])->name('configuracion.plataforma')->middleware('auth');
    Route::post('/configuracion/plataforma', [App\Http\Controllers\PlataformaController::class, 'store'])->name('configuracion.plataforma.store')->middleware('auth');
    Route::put('/configuracion/plataforma/{plataforma}', [App\Http\Controllers\PlataformaController::class, 'update'])->name('configuracion.plataforma.update')->middleware('auth');
    Route::delete('/configuracion/plataforma/{plataforma}', [App\Http\Controllers\PlataformaController::class, 'destroy'])->name('configuracion.plataforma.destroy')->middleware('auth');
    // Métodos de pago
    Route::get('/configuracion/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'index'])->name('configuracion.metodopago')->middleware('auth');
    Route::post('/configuracion/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'store'])->name('configuracion.metodopago.store')->middleware('auth');
    Route::put('/configuracion/metodopago/{metodopago}', [App\Http\Controllers\MetodoPagoController::class, 'update'])->name('configuracion.metodopago.update')->middleware('auth');
    Route::delete('/configuracion/metodopago/{metodopago}', [App\Http\Controllers\MetodoPagoController::class, 'destroy'])->name('configuracion.metodopago.destroy')->middleware('auth');
    //metodo gasto 
    Route::post('/configuracion/metodopago/gasto', [App\Http\Controllers\MetodoGastoController::class, 'store'])->name('configuracion.metodogasto.store')->middleware('auth');
    Route::put('/configuracion/metodopago/gasto/{metodoGasto}', [App\Http\Controllers\MetodoGastoController::class, 'update']) ->name('configuracion.metodogasto.update')->middleware('auth');
    Route::delete('/configuracion/metodopago/gasto/{metodoGasto}', [App\Http\Controllers\MetodoGastoController::class, 'destroy'])->name('configuracion.metodogasto.destroy')->middleware('auth');
    //Lista de atributos
    Route::get('/configuracion/atributo', [App\Http\Controllers\AtributoController::class, 'index'])->name('configuracion.atributo')->middleware('auth');
    Route::post('/configuracion/atributo', [App\Http\Controllers\AtributoController::class, 'store'])->name('configuracion.atributo.store')->middleware('auth');
    Route::put('/configuracion/atributo/{atributo}', [App\Http\Controllers\AtributoController::class, 'update'])->name('configuracion.atributo.update')->middleware('auth');
    Route::delete('/configuracion/atributo/{atributo}', [App\Http\Controllers\AtributoController::class, 'destroy'])->name('configuracion.atributo.destroy')->middleware('auth');
    //Lista de detracciones
    Route::get('/configuracion/detraccion', [App\Http\Controllers\DetraccionController::class, 'index'])->name('configuracion.detraccion')->middleware('auth');
    Route::post('/configuracion/detraccion', [App\Http\Controllers\DetraccionController::class, 'store'])->name('configuracion.detraccion.store')->middleware('auth');
    Route::put('/configuracion/detraccion/{detraccion}', [App\Http\Controllers\DetraccionController::class, 'update'])->name('configuracion.detraccion.update')->middleware('auth');
    Route::delete('/configuracion/detraccion/{detraccion}', [App\Http\Controllers\DetraccionController::class, 'destroy'])->name('configuracion.detraccion.destroy')->middleware('auth');
    //Lista de unidades
    Route::get('/configuracion/unidad', [App\Http\Controllers\UnidadController::class, 'index'])->name('configuracion.unidad')->middleware('auth');
    Route::post('/configuracion/unidad', [App\Http\Controllers\UnidadController::class, 'store'])->name('configuracion.unidad.store')->middleware('auth');
    Route::put('/configuracion/unidad/{unidad}', [App\Http\Controllers\UnidadController::class, 'update'])->name('configuracion.unidad.update')->middleware('auth');
    Route::delete('/configuracion/unidad/{unidad}', [App\Http\Controllers\UnidadController::class, 'destroy'])->name('configuracion.unidad.destroy')->middleware('auth');
    //Lista de traslados
    Route::get('/configuracion/traslado', [App\Http\Controllers\TrasladoController::class, 'index'])->name('configuracion.traslado')->middleware('auth');
    Route::post('/configuracion/traslado', [App\Http\Controllers\TrasladoController::class, 'store'])->name('configuracion.traslado.store')->middleware('auth');
    Route::put('/configuracion/traslado/{traslado}', [App\Http\Controllers\TrasladoController::class, 'update'])->name('configuracion.traslado.update')->middleware('auth');
    Route::delete('/configuracion/traslado/{traslado}', [App\Http\Controllers\TrasladoController::class, 'destroy'])->name('configuracion.traslado.destroy')->middleware('auth');

    // Configuración de la empresa
    Route::get('/configuracion/compania', [App\Http\Controllers\CompaniaController::class, 'index'])->name('configuracion.compania')->middleware('auth');
    Route::post('/configuracion/compania', [App\Http\Controllers\CompaniaController::class, 'store'])->name('configuracion.compania.store')->middleware('auth');
    Route::put('/configuracion/compania/{id}', [App\Http\Controllers\CompaniaController::class, 'update'])->name('configuracion.compania.update')->middleware('auth');
    Route::delete('/configuracion/compania/{id}/eliminar-logo', [App\Http\Controllers\CompaniaController::class, 'eliminarLogo'])->name('configuracion.compania.eliminar-logo')->middleware('auth');
    
    //configuración de login
    Route::get('/configuracion/login', [App\Http\Controllers\LoginController::class, 'index'])->name('configuracion.login')->middleware('auth');
    Route::put('/configuracion/login', [App\Http\Controllers\LoginController::class, 'update'])->name('configuracion.login.update')->middleware('auth');
    Route::post('/configuracion/login/imagenes', [App\Http\Controllers\LoginImagenController::class, 'store'])->name('configuracion.login.imagenes.store')->middleware('auth');
    Route::put('/configuracion/login/imagenes/{loginImagen}', [App\Http\Controllers\LoginImagenController::class, 'update'])->name('configuracion.login.imagenes.update')->middleware('auth');
    Route::delete('/configuracion/login/imagenes/{loginImagen}', [App\Http\Controllers\LoginImagenController::class, 'destroy'])->name('configuracion.login.imagenes.destroy')->middleware('auth');
    //Estilos
    Route::get('/configuracion', function () {$estilos = \App\Models\Estilo::all();$estiloActivo = \App\Models\Estilo::where('estado', 'ACTIVO')->first();
    return view('admin.configuracion.configuracion_menu', compact('estilos', 'estiloActivo'));})->name('configuracion')->middleware('auth');
    Route::get('/configuracion/estilo', [App\Http\Controllers\EstiloController::class, 'index'])->name('configuracion.estilo')->middleware('auth');
    Route::post('/configuracion/estilo', [App\Http\Controllers\EstiloController::class, 'store'])->name('configuracion.estilo.store')->middleware('auth');
    Route::get('/configuracion/estilo/{id}/editar', [App\Http\Controllers\EstiloController::class, 'editar'])->name('configuracion.estilo.editar') ->middleware('auth');
    Route::put('/configuracion/estilo/{id}', [App\Http\Controllers\EstiloController::class, 'update'])->name('configuracion.estilo.update')->middleware('auth');
    Route::delete('/configuracion/estilo/{id}', [App\Http\Controllers\EstiloController::class, 'destroy'])->name('configuracion.estilo.eliminar')->middleware('auth');
    Route::put('/configuracion/estilo/{id}/activar', [App\Http\Controllers\EstiloController::class, 'activar'])->name('configuracion.estilo.activar')->middleware('auth');
    Route::delete('/configuracion/estilo/{id}', [App\Http\Controllers\EstiloController::class, 'destroy'])->name('configuracion.estilo.eliminar')->middleware('auth');
    //Motivo de gatos 
    Route::get('/configuracion/motivogasto', [App\Http\Controllers\MotivoGastoController::class, 'index'])->name('configuracion.motivogasto')->middleware('auth');
    Route::post('/configuracion/motivogasto', [App\Http\Controllers\MotivoGastoController::class, 'store'])->name('configuracion.motivogasto.store')->middleware('auth');
    Route::put('/configuracion/motivogasto/{id}', [App\Http\Controllers\MotivoGastoController::class, 'update'])->name('configuracion.motivogasto.update')->middleware('auth');
    Route::delete('/configuracion/motivogasto/{id}', [App\Http\Controllers\MotivoGastoController::class, 'destroy'])->name('configuracion.motivogasto.destroy')->middleware('auth');
    // Motivo de ingreso
    Route::get('/configuracion/motivoingreso', [App\Http\Controllers\MotivoIngresoController::class, 'index'])->name('configuracion.motivoingreso')->middleware('auth');
    Route::post('/configuracion/motivoingreso', [App\Http\Controllers\MotivoIngresoController::class, 'store'])->name('configuracion.motivoingreso.store')->middleware('auth');
    Route::put('/configuracion/motivoingreso/{id}', [App\Http\Controllers\MotivoIngresoController::class, 'update'])->name('configuracion.motivoingreso.update')->middleware('auth');
    Route::delete('/configuracion/motivoingreso/{id}', [App\Http\Controllers\MotivoIngresoController::class, 'destroy'])->name('configuracion.motivoingreso.destroy')->middleware('auth');
    // Comprobante Ingreso
    Route::get('/configuracion/tipocomprobante', [App\Http\Controllers\ComprobanteIngresoController::class, 'index'])->name('configuracion.tipocomprobante')->middleware('auth');
    Route::post('/configuracion/tipocomprobante', [App\Http\Controllers\ComprobanteIngresoController::class, 'store'])->name('configuracion.comprobanteingreso.store')->middleware('auth');
    Route::put('/configuracion/tipocomprobante/{id}', [App\Http\Controllers\ComprobanteIngresoController::class, 'update'])->name('configuracion.comprobanteingreso.update')->middleware('auth');
    Route::delete('/configuracion/tipocomprobante/{id}', [App\Http\Controllers\ComprobanteIngresoController::class, 'destroy'])->name('configuracion.comprobanteingreso.destroy')->middleware('auth');
    // Comprobante Gasto
    Route::post('/configuracion/tipocomprobante/gasto', [App\Http\Controllers\ComprobanteGastoController::class, 'store'])->name('configuracion.comprobantegasto.store')->middleware('auth');
    Route::put('/configuracion/tipocomprobante/gasto/{id}', [App\Http\Controllers\ComprobanteGastoController::class, 'update'])->name('configuracion.comprobantegasto.update')->middleware('auth');
    Route::delete('/configuracion/tipocomprobante/gasto/{id}', [App\Http\Controllers\ComprobanteGastoController::class, 'destroy'])->name('configuracion.comprobantegasto.destroy')->middleware('auth');

});
