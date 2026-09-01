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
    Route::get('/configuracion/menu', function () { return view('admin.configuracion.configuracion_menu');})->middleware('auth')->name('configuracion.menu');
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

});