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
    //Ubigeo
    Route::get('/ubigeo/departamentos', [App\Http\Controllers\UbigeoController::class, 'departamentos'])->name('ubigeo.departamentos') ->middleware('auth');
    Route::get('/ubigeo/provincias/{codigo}', [App\Http\Controllers\UbigeoController::class, 'provincias'])->name('ubigeo.provincias')->middleware('auth');
    Route::get('/ubigeo/distritos/{codigo}', [App\Http\Controllers\UbigeoController::class, 'distritos'])->name('ubigeo.distritos')->middleware('auth');
    
    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('dashboard')->middleware('auth', 'can:admin.dashboard.index');
    Route::get('/configuracion/menu', function () {
    $estilos = \App\Models\Estilo::all();$estiloActivo = \App\Models\Estilo::where('estado', 'ACTIVO')->first();
    return view('admin.configuracion.configuracion_menu', compact('estilos', 'estiloActivo'));})->middleware('auth', 'can:admin.configuracion.menu')->name('configuracion.menu');
    //Ruta general de configuraciones
    Route::view('/configuracion', 'admin.configuracion.configuracion_menu')->name('configuracion.index')->middleware('auth', 'can:admin.configuracion.index');
    //Lista de bancos
    Route::get('/configuracion/banco', [App\Http\Controllers\BancoController::class, 'index'])->name('configuracion.banco')->middleware('auth', 'can:configuracion.banco.index');
    Route::post('/configuracion/banco', [App\Http\Controllers\BancoController::class, 'store'])->name('configuracion.banco.store')->middleware('auth', 'can:configuracion.banco.store');
    Route::put('/configuracion/banco/{banco}', [App\Http\Controllers\BancoController::class, 'update'])->name('configuracion.banco.update')->middleware('auth', 'can:configuracion.banco.update');
    Route::delete('/configuracion/banco/{banco}', [App\Http\Controllers\BancoController::class, 'destroy'])->name('configuracion.banco.destroy')->middleware('auth', 'can:admin.configuracion.banco.destroy');
    //Lista de monedas
    Route::get('/configuracion/moneda', [App\Http\Controllers\MonedaController::class, 'index'])->name('configuracion.moneda')->middleware('auth','can:configuracion.moneda.index');
    Route::post('/configuracion/moneda', [App\Http\Controllers\MonedaController::class, 'store'])->name('configuracion.moneda.store')->middleware('auth','can:configuracion.moneda.store');
    Route::put('/configuracion/moneda/{moneda}', [App\Http\Controllers\MonedaController::class, 'update'])->name('configuracion.moneda.update')->middleware('auth','can:configuracion.moneda.update');
    Route::delete('/configuracion/moneda/{moneda}', [App\Http\Controllers\MonedaController::class, 'destroy'])->name('configuracion.moneda.destroy')->middleware('auth','can:configuracion.moneda.destroy');
    //Lista de cuenta bancarias
    Route::get('/configuracion/cuentabancaria', [App\Http\Controllers\CuentaBancariaController::class, 'index'])->name('configuracion.cuentabancaria')->middleware('auth','can:configuracion.cuentabancaria.index');
    Route::post('/configuracion/cuentabancaria', [App\Http\Controllers\CuentaBancariaController::class, 'store'])->name('configuracion.cuentabancaria.store')->middleware('auth','can:configuracion.cuentabancaria.store');
    Route::put('/configuracion/cuentabancaria/{cuentabancaria}', [App\Http\Controllers\CuentaBancariaController::class, 'update'])->name('configuracion.cuentabancaria.update')->middleware('auth','can:configuracion.cuentabancaria.update');
    Route::delete('/configuracion/cuentabancaria/{cuentabancaria}', [App\Http\Controllers\CuentaBancariaController::class, 'destroy'])->name('configuracion.cuentabancaria.destroy')->middleware('auth','can:configuracion.cuentabancaria.destroy');
    // Lista de tarjetas
    Route::get('/configuracion/tarjeta', [App\Http\Controllers\TarjetaController::class, 'index'])->name('configuracion.tarjeta')->middleware('auth','can:configuracion.tarjeta.index');
    Route::post('/configuracion/tarjeta', [App\Http\Controllers\TarjetaController::class, 'store'])->name('configuracion.tarjeta.store')->middleware('auth','can:configuracion.tarjeta.store');
    Route::put('/configuracion/tarjeta/{tarjeta}', [App\Http\Controllers\TarjetaController::class, 'update'])->name('configuracion.tarjeta.update')->middleware('auth','can:configuracion.tarjeta.update');
    Route::delete('/configuracion/tarjeta/{tarjeta}', [App\Http\Controllers\TarjetaController::class, 'destroy'])->name('configuracion.tarjeta.destroy')->middleware('auth','can:configuracion.tarjeta.destroy');
    // Lista de plataformas
    Route::get('/configuracion/plataforma', [App\Http\Controllers\PlataformaController::class, 'index'])->name('configuracion.plataforma')->middleware('auth','can:configuracion.plataforma.index');
    Route::post('/configuracion/plataforma', [App\Http\Controllers\PlataformaController::class, 'store'])->name('configuracion.plataforma.store')->middleware('auth','can:configuracion.plataforma.store');
    Route::put('/configuracion/plataforma/{plataforma}', [App\Http\Controllers\PlataformaController::class, 'update'])->name('configuracion.plataforma.update')->middleware('auth','can:configuracion.plataforma.update');
    Route::delete('/configuracion/plataforma/{plataforma}', [App\Http\Controllers\PlataformaController::class, 'destroy'])->name('configuracion.plataforma.destroy')->middleware('auth','can:configuracion.plataforma.destroy');
    // Métodos de pago
    Route::get('/configuracion/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'index'])->name('configuracion.metodopago')->middleware('auth','can:configuracion.metodopago.index');
    Route::post('/configuracion/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'store'])->name('configuracion.metodopago.store')->middleware('auth','can:configuracion.metodopago.store');
    Route::put('/configuracion/metodopago/{metodopago}', [App\Http\Controllers\MetodoPagoController::class, 'update'])->name('configuracion.metodopago.update')->middleware('auth','can:configuracion.metodopago.update');
    Route::delete('/configuracion/metodopago/{metodopago}', [App\Http\Controllers\MetodoPagoController::class, 'destroy'])->name('configuracion.metodopago.destroy')->middleware('auth','can:configuracion.metodopago.destroy');
    //metodo gasto 
    Route::post('/configuracion/metodopago/gasto', [App\Http\Controllers\MetodoGastoController::class, 'store'])->name('configuracion.metodogasto.store')->middleware('auth','can:configuracion.metodogasto.store');
    Route::put('/configuracion/metodopago/gasto/{metodoGasto}', [App\Http\Controllers\MetodoGastoController::class, 'update']) ->name('configuracion.metodogasto.update')->middleware('auth','can:configuracion.metodogasto.update');
    Route::delete('/configuracion/metodopago/gasto/{metodoGasto}', [App\Http\Controllers\MetodoGastoController::class, 'destroy'])->name('configuracion.metodogasto.destroy')->middleware('auth','can:configuracion.metodogasto.destroy');
    //Lista de atributos
    Route::get('/configuracion/atributo', [App\Http\Controllers\AtributoController::class, 'index'])->name('configuracion.atributo')->middleware('auth','can:configuracion.atributo.index');
    Route::post('/configuracion/atributo', [App\Http\Controllers\AtributoController::class, 'store'])->name('configuracion.atributo.store')->middleware('auth','can:configuracion.atributo.store');
    Route::put('/configuracion/atributo/{atributo}', [App\Http\Controllers\AtributoController::class, 'update'])->name('configuracion.atributo.update')->middleware('auth','can:configuracion.atributo.update');
    Route::delete('/configuracion/atributo/{atributo}', [App\Http\Controllers\AtributoController::class, 'destroy'])->name('configuracion.atributo.destroy')->middleware('auth','can:configuracion.atributo.destroy');
    //Lista de detracciones
    Route::get('/configuracion/detraccion', [App\Http\Controllers\DetraccionController::class, 'index'])->name('configuracion.detraccion')->middleware('auth','can:configuracion.detraccion.index');
    Route::post('/configuracion/detraccion', [App\Http\Controllers\DetraccionController::class, 'store'])->name('configuracion.detraccion.store')->middleware('auth','can:configuracion.detraccion.store');
    Route::put('/configuracion/detraccion/{detraccion}', [App\Http\Controllers\DetraccionController::class, 'update'])->name('configuracion.detraccion.update')->middleware('auth','can:configuracion.detraccion.update');
    Route::delete('/configuracion/detraccion/{detraccion}', [App\Http\Controllers\DetraccionController::class, 'destroy'])->name('configuracion.detraccion.destroy')->middleware('auth','can:configuracion.detraccion.destroy');
    //Lista de unidades
    Route::get('/configuracion/unidad', [App\Http\Controllers\UnidadController::class, 'index'])->name('configuracion.unidad')->middleware('auth','can:configuracion.unidad.index');
    Route::post('/configuracion/unidad', [App\Http\Controllers\UnidadController::class, 'store'])->name('configuracion.unidad.store')->middleware('auth','can:configuracion.unidad.store');
    Route::put('/configuracion/unidad/{unidad}', [App\Http\Controllers\UnidadController::class, 'update'])->name('configuracion.unidad.update')->middleware('auth','can:configuracion.unidad.update');
    Route::delete('/configuracion/unidad/{unidad}', [App\Http\Controllers\UnidadController::class, 'destroy'])->name('configuracion.unidad.destroy')->middleware('auth','can:configuracion.unidad.destroy');
    //Lista de traslados
    Route::get('/configuracion/traslado', [App\Http\Controllers\TrasladoController::class, 'index'])->name('configuracion.traslado')->middleware('auth','can:configuracion.traslado.index');
    Route::post('/configuracion/traslado', [App\Http\Controllers\TrasladoController::class, 'store'])->name('configuracion.traslado.store')->middleware('auth','can:configuracion.traslado.store');
    Route::put('/configuracion/traslado/{traslado}', [App\Http\Controllers\TrasladoController::class, 'update'])->name('configuracion.traslado.update')->middleware('auth','can:configuracion.traslado.update');
    Route::delete('/configuracion/traslado/{traslado}', [App\Http\Controllers\TrasladoController::class, 'destroy'])->name('configuracion.traslado.destroy')->middleware('auth','can:configuracion.traslado.destroy');
    // Configuración de la empresa
    Route::get('/configuracion/compania', [App\Http\Controllers\CompaniaController::class, 'index'])->name('configuracion.compania')->middleware('auth','can:configuracion.compania.index');
    Route::post('/configuracion/compania', [App\Http\Controllers\CompaniaController::class, 'store'])->name('configuracion.compania.store')->middleware('auth','can:configuracion.compania.store');
    Route::put('/configuracion/compania/{id}', [App\Http\Controllers\CompaniaController::class, 'update'])->name('configuracion.compania.update')->middleware('auth','can:configuracion.compania.update');
    Route::delete('/configuracion/compania/{id}/eliminar-logo', [App\Http\Controllers\CompaniaController::class, 'eliminarLogo'])->name('configuracion.compania.eliminar-logo')->middleware('auth','can');
    
    //configuración de login
    Route::get('/configuracion/login', [App\Http\Controllers\LoginController::class, 'index'])->name('configuracion.login')->middleware('auth','can:configuracion.login.index');
    Route::put('/configuracion/login', [App\Http\Controllers\LoginController::class, 'update'])->name('configuracion.login.update')->middleware('auth','can:configuracion.login.update');
    Route::post('/configuracion/login/imagenes', [App\Http\Controllers\LoginImagenController::class, 'store'])->name('configuracion.login.imagenes.store')->middleware('auth','can:configuracion.login.imagenes.store');
    Route::put('/configuracion/login/imagenes/{loginImagen}', [App\Http\Controllers\LoginImagenController::class, 'update'])->name('configuracion.login.imagenes.update')->middleware('auth','can:configuracion.login.imagenes.update');
    Route::delete('/configuracion/login/imagenes/{loginImagen}', [App\Http\Controllers\LoginImagenController::class, 'destroy'])->name('configuracion.login.imagenes.destroy')->middleware('auth','can:configuracion.login.imagenes.destroy');
    //Estilos
    Route::get('/configuracion', function () {$estilos = \App\Models\Estilo::all();$estiloActivo = \App\Models\Estilo::where('estado', 'ACTIVO')->first();
    return view('admin.configuracion.configuracion_menu', compact('estilos', 'estiloActivo'));})->name('configuracion')->middleware('auth','can:configuracion.index');
    Route::get('/configuracion/estilo', [App\Http\Controllers\EstiloController::class, 'index'])->name('configuracion.estilo')->middleware('auth','can:configuracion.estilo.index');
    Route::post('/configuracion/estilo', [App\Http\Controllers\EstiloController::class, 'store'])->name('configuracion.estilo.store')->middleware('auth','can:configuracion.estilo.store');
    Route::get('/configuracion/estilo/{id}/editar', [App\Http\Controllers\EstiloController::class, 'editar'])->name('configuracion.estilo.editar') ->middleware('auth','can:configuracion.estilo.editar');
    Route::put('/configuracion/estilo/{id}', [App\Http\Controllers\EstiloController::class, 'update'])->name('configuracion.estilo.update')->middleware('auth','can:configuracion.estilo.update');
    Route::delete('/configuracion/estilo/{id}', [App\Http\Controllers\EstiloController::class, 'destroy'])->name('configuracion.estilo.eliminar')->middleware('auth','can:configuracion.estilo.eliminar');
    Route::put('/configuracion/estilo/{id}/activar', [App\Http\Controllers\EstiloController::class, 'activar'])->name('configuracion.estilo.activar')->middleware('auth','can:configuracion.estilo.activar');
    //Motivo de gatos 
    Route::get('/configuracion/motivogasto', [App\Http\Controllers\MotivoGastoController::class, 'index'])->name('configuracion.motivogasto')->middleware('auth','can:configuracion.motivogasto.index');
    Route::post('/configuracion/motivogasto', [App\Http\Controllers\MotivoGastoController::class, 'store'])->name('configuracion.motivogasto.store')->middleware('auth','can:configuracion.motivogasto.store');
    Route::put('/configuracion/motivogasto/{id}', [App\Http\Controllers\MotivoGastoController::class, 'update'])->name('configuracion.motivogasto.update')->middleware('auth','can:configuracion.motivogasto.update');
    Route::delete('/configuracion/motivogasto/{id}', [App\Http\Controllers\MotivoGastoController::class, 'destroy'])->name('configuracion.motivogasto.destroy')->middleware('auth','can:configuracion.motivogasto.destroy');
    // Motivo de ingreso
    Route::get('/configuracion/motivoingreso', [App\Http\Controllers\MotivoIngresoController::class, 'index'])->name('configuracion.motivoingreso')->middleware('auth','can:configuracion.motivoingreso.index');
    Route::post('/configuracion/motivoingreso', [App\Http\Controllers\MotivoIngresoController::class, 'store'])->name('configuracion.motivoingreso.store')->middleware('auth','can:configuracion.motivoingreso.store');
    Route::put('/configuracion/motivoingreso/{id}', [App\Http\Controllers\MotivoIngresoController::class, 'update'])->name('configuracion.motivoingreso.update')->middleware('auth','can:configuracion.motivoingreso.update');
    Route::delete('/configuracion/motivoingreso/{id}', [App\Http\Controllers\MotivoIngresoController::class, 'destroy'])->name('configuracion.motivoingreso.destroy')->middleware('auth','can:configuracion.motivoingreso.destroy');
    // Comprobante Ingreso
    Route::get('/configuracion/tipocomprobante', [App\Http\Controllers\ComprobanteIngresoController::class, 'index'])->name('configuracion.tipocomprobante')->middleware('auth','can:configuracion.tipocomprobante.index');
    Route::post('/configuracion/tipocomprobante', [App\Http\Controllers\ComprobanteIngresoController::class, 'store'])->name('configuracion.comprobanteingreso.store')->middleware('auth','can:configuracion.comprobanteingreso.store');
    Route::put('/configuracion/tipocomprobante/{id}', [App\Http\Controllers\ComprobanteIngresoController::class, 'update'])->name('configuracion.comprobanteingreso.update')->middleware('auth','can:configuracion.comprobanteingreso.update');
    Route::delete('/configuracion/tipocomprobante/{id}', [App\Http\Controllers\ComprobanteIngresoController::class, 'destroy'])->name('configuracion.comprobanteingreso.destroy')->middleware('auth','can:configuracion.comprobanteingreso.destroy');
    // Comprobante Gasto
    Route::post('/configuracion/tipocomprobante/gasto', [App\Http\Controllers\ComprobanteGastoController::class, 'store'])->name('configuracion.comprobantegasto.store')->middleware('auth','can:configuracion.comprobantegasto.store');
    Route::put('/configuracion/tipocomprobante/gasto/{id}', [App\Http\Controllers\ComprobanteGastoController::class, 'update'])->name('configuracion.comprobantegasto.update')->middleware('auth','can:configuracion.comprobantegasto.update');
    Route::delete('/configuracion/tipocomprobante/gasto/{id}', [App\Http\Controllers\ComprobanteGastoController::class, 'destroy'])->name('configuracion.comprobantegasto.destroy')->middleware('auth','can:configuracion.comprobantegasto.destroy');
    // Roles
    Route::get('/configuracion/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('configuracion.roles')->middleware('auth','can:configuracion.roles.index');
    Route::post('/configuracion/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('configuracion.roles.store')->middleware('auth','can:configuracion.roles.store');
    Route::get('/configuracion/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('configuracion.roles.edit')->middleware('auth','can:configuracion.roles.edit');
    Route::put('/configuracion/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('configuracion.roles.update')->middleware('auth','can:configuracion.roles.update');
    Route::delete('/configuracion/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('configuracion.roles.destroy')->middleware('auth','can:configuracion.roles.destroy');
    // Tipo de documento
    Route::get('/configuracion/tipodocumento', [App\Http\Controllers\TipoDocumentoController::class, 'index'])->name('configuracion.tipodocumento')->middleware('auth','can:configuracion.tipodocumento.index');
    Route::post('/configuracion/tipodocumento', [App\Http\Controllers\TipoDocumentoController::class, 'store'])->name('configuracion.tipodocumento.store')->middleware('auth','can:configuracion.tipodocumento.store');
    Route::put('/configuracion/tipodocumento/{id}', [App\Http\Controllers\TipoDocumentoController::class, 'update'])->name('configuracion.tipodocumento.update')->middleware('auth','can:configuracion.tipodocumento.update');
    Route::delete('/configuracion/tipodocumento/{id}', [App\Http\Controllers\TipoDocumentoController::class, 'destroy'])->name('configuracion.tipodocumento.destroy')->middleware('auth','can:configuracion.tipodocumento.destroy');
    //Sucursal    
    Route::get('/admin/sucursal', [App\Http\Controllers\SucursalController::class, 'index'])->name('sucursal')->middleware('auth','can:admin.sucursal.index');
    Route::post('/admin/sucursal', [App\Http\Controllers\SucursalController::class, 'store'])->name('sucursal.store')->middleware('auth','can:admin.sucursal.store');
    Route::put('/admin/sucursal/{id}', [App\Http\Controllers\SucursalController::class, 'update'])->name('sucursal.update')->middleware('auth','can:admin.sucursal.update');
    Route::delete('/admin/sucursal/{id}', [App\Http\Controllers\SucursalController::class, 'destroy'])->name('sucursal.destroy')->middleware('auth','can:admin.sucursal.destroy');
    //TipoCliente
    Route::get('/admin/tipocliente', [App\Http\Controllers\TipoClienteController::class, 'index'])->name('tipocliente')->middleware('auth','can:admin.tipocliente.index');
    Route::post('/admin/tipocliente', [App\Http\Controllers\TipoClienteController::class, 'store'])->name('tipocliente.store')->middleware('auth','can:admin.tipocliente.store');
    Route::put('/admin/tipocliente/{tipoCliente}', [App\Http\Controllers\TipoClienteController::class, 'update'])->name('tipocliente.update')->middleware('auth','can:admin.tipocliente.update');
    Route::delete('/admin/tipocliente/{tipoCliente}', [App\Http\Controllers\TipoClienteController::class, 'destroy'])->name('tipocliente.destroy')->middleware('auth','can:admin.tipocliente.destroy');
    //Cliente
    Route::get('/admin/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente')->middleware( 'auth','can:admin.cliente.index');
    Route::post('/admin/cliente', [App\Http\Controllers\ClienteController::class, 'store'])->name('cliente.store')->middleware( 'auth','can:admin.cliente.store');
    Route::put('/admin/cliente/{cliente}', [App\Http\Controllers\ClienteController::class, 'update'])->name('cliente.update')->middleware('auth','can:admin.cliente.update');
    Route::delete('/admin/cliente/{cliente}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('cliente.destroy')->middleware('auth','can:admin.cliente.destroy');
    Route::get('/admin/cliente/consulta-documento', [App\Http\Controllers\ClienteController::class, 'consultaDocumento'])->name('cliente.consulta.documento')->middleware('auth','can:admin.cliente.consulta.documento');
    
    // Series
    Route::post('/admin/sucursal/series', [App\Http\Controllers\SerieController::class, 'store'])->name('configuracion.serie.store')->middleware('auth','can:admin.serie.store');
    Route::put('/admin/sucursal/series/{id}', [App\Http\Controllers\SerieController::class, 'update'])->name('configuracion.serie.update')->middleware('auth','can:admin.serie.update');
    Route::delete('/admin/sucursal/series/{id}', [App\Http\Controllers\SerieController::class, 'destroy'])->name('configuracion.serie.destroy')->middleware('auth','can:admin.serie.destroy');
    //Usuarios
    Route::get('/admin/usuario', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuario')->middleware('auth','can:admin.usuario.index');
    Route::post('/admin/usuario', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario.store')->middleware('auth');
    Route::put('/admin/usuario/{usuario}', [App\Http\Controllers\UsuarioController::class, 'update']) ->name('usuario.update') ->middleware('auth');
    Route::delete('/admin/usuario/{usuario}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuario.destroy')->middleware('auth');

});
