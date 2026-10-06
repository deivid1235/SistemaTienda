<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            //configuracion
            'admin.dashboard.index',
            'admin.configuracion.menu',
            'admin.configuracion.index',
            //Banco
            'configuracion.banco.index',
            'configuracion.banco.store',
            'configuracion.banco.update',
            'configuracion.banco.destroy',
            // Monedas
            'configuracion.moneda.index',
            'configuracion.moneda.store',
            'configuracion.moneda.update',
            'configuracion.moneda.destroy',
            // Cuentas bancarias
            'configuracion.cuentabancaria.index',
            'configuracion.cuentabancaria.store',
            'configuracion.cuentabancaria.update',
            'configuracion.cuentabancaria.destroy',
            // Tarjetas
            'configuracion.tarjeta.index',
            'configuracion.tarjeta.store',
            'configuracion.tarjeta.update',
            'configuracion.tarjeta.destroy',
            // Plataformas
            'configuracion.plataforma.index',
            'configuracion.plataforma.store',
            'configuracion.plataforma.update',
            'configuracion.plataforma.destroy',
            // Métodos de pago
            'configuracion.metodopago.index',
            'configuracion.metodopago.store',
            'configuracion.metodopago.update',
            'configuracion.metodopago.destroy',
            // Métodos de gasto
            'configuracion.metodogasto.store',
            'configuracion.metodogasto.update',
            'configuracion.metodogasto.destroy',
            // Atributos
            'configuracion.atributo.index',
            'configuracion.atributo.store',
            'configuracion.atributo.update',
            'configuracion.atributo.destroy',
            // Detracciones
            'configuracion.detraccion.index',
            'configuracion.detraccion.store',
            'configuracion.detraccion.update',
            'configuracion.detraccion.destroy',
            // Unidades
            'configuracion.unidad.index',
            'configuracion.unidad.store',
            'configuracion.unidad.update',
            'configuracion.unidad.destroy',
            // Traslados
            'configuracion.traslado.index',
            'configuracion.traslado.store',
            'configuracion.traslado.update',
            'configuracion.traslado.destroy',
            // Configuración de la empresa
            'configuracion.compania.index',
            'configuracion.compania.store',
            'configuracion.compania.update',
            'configuracion.compania.eliminar-logo',
            // Configuración de login
            'configuracion.login.index',
            'configuracion.login.update',
            'configuracion.login.imagenes.store',
            'configuracion.login.imagenes.update',
            'configuracion.login.imagenes.destroy',
            // Configuración - Estilos
            'configuracion.estilo.index',
            'configuracion.estilo.store',
            'configuracion.estilo.editar',
            'configuracion.estilo.update',
            'configuracion.estilo.eliminar',
            'configuracion.estilo.activar',
            // Configuración - Motivo de gasto
            'configuracion.motivogasto.index',
            'configuracion.motivogasto.store',
            'configuracion.motivogasto.update',
            'configuracion.motivogasto.destroy',
            // Configuración - Motivo de ingreso
            'configuracion.motivoingreso.index',
            'configuracion.motivoingreso.store',
            'configuracion.motivoingreso.update',
            'configuracion.motivoingreso.destroy',
            // Configuración - Comprobante de ingreso
            'configuracion.tipocomprobante.index',
            'configuracion.tipocomprobante.store',
            'configuracion.tipocomprobante.update',
            'configuracion.tipocomprobante.destroy',
            // Configuración - Comprobante de gasto
            'configuracion.comprobantegasto.store',
            'configuracion.comprobantegasto.update',
            'configuracion.comprobantegasto.destroy',
            // Configuración - Roles
            'configuracion.roles.index',
            'configuracion.roles.store',
            'configuracion.roles.edit',
            'configuracion.roles.update',
            'configuracion.roles.destroy',
            // Tipos de documento
            'configuracion.tipodocumento.index',
            'configuracion.tipodocumento.store',
            'configuracion.tipodocumento.update',
            'configuracion.tipodocumento.destroy',
            // Sucursal
            'admin.sucursal.index',
            'admin.sucursal.store',
            'admin.sucursal.update',
            'admin.sucursal.destroy',
            // Tipo de cliente
            'admin.tipocliente.index',
            'admin.tipocliente.store',
            'admin.tipocliente.update',
            'admin.tipocliente.destroy',
            // Clientes
            'admin.cliente.index',
            'admin.cliente.store',
            'admin.cliente.edit',
            'admin.cliente.update',
            'admin.cliente.destroy',
            'admin.cliente.consulta.documento',
            // Series
            'admin.serie.store',
            'admin.serie.update',
            'admin.serie.destroy',
            //Usuarios
            'admin.usuario.index',
        
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'ADMINISTRADOR',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions(Permission::all());
    }
}