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

        $admin = Role::firstOrCreate([
            'name' => 'ADMINISTRADOR',
            'guard_name' => 'web',
        ]);
        // Configuración
        Permission::create(['name' => 'admin.dashboard.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.configuracion.menu'])->syncRoles($admin);
        Permission::create(['name' => 'admin.configuracion.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.configuracion.store'])->syncRoles($admin);
        // Gestiones del sistema
        Permission::create(['name' => 'admin.gestiones.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestiones.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestiones.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestiones.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestiones.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestiones.destroy'])->syncRoles($admin);
        // Banco
        Permission::create(['name' => 'configuracion.banco.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.banco.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.banco.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.banco.destroy'])->syncRoles($admin);
        // Monedas
        Permission::create(['name' => 'configuracion.moneda.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.moneda.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.moneda.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.moneda.destroy'])->syncRoles($admin);
        // Cuentas bancarias
        Permission::create(['name' => 'configuracion.cuentabancaria.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentabancaria.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentabancaria.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentabancaria.destroy'])->syncRoles($admin);
        // Tarjetas
        Permission::create(['name' => 'configuracion.tarjeta.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tarjeta.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tarjeta.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tarjeta.destroy'])->syncRoles($admin);
        // Plataformas
        Permission::create(['name' => 'configuracion.plataforma.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.plataforma.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.plataforma.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.plataforma.destroy'])->syncRoles($admin);
        // Métodos de pago
        Permission::create(['name' => 'configuracion.metodopago.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.metodopago.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.metodopago.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.metodopago.destroy'])->syncRoles($admin);
        // Métodos de gasto
        Permission::create(['name' => 'configuracion.metodogasto.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.metodogasto.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.metodogasto.destroy'])->syncRoles($admin);
        // Atributos
        Permission::create(['name' => 'configuracion.atributo.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.atributo.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.atributo.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.atributo.destroy'])->syncRoles($admin);
        // Detracciones
        Permission::create(['name' => 'configuracion.detraccion.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.detraccion.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.detraccion.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.detraccion.destroy'])->syncRoles($admin);
        // Unidades
        Permission::create(['name' => 'configuracion.unidad.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.unidad.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.unidad.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.unidad.destroy'])->syncRoles($admin);
        // Traslados
        Permission::create(['name' => 'configuracion.traslado.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.traslado.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.traslado.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.traslado.destroy'])->syncRoles($admin);
        // Configuración de la empresa
        Permission::create(['name' => 'configuracion.compania.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.compania.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.compania.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.compania.eliminar-logo'])->syncRoles($admin);
        // Configuración de login
        Permission::create(['name' => 'configuracion.login.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.login.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.login.imagenes.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.login.imagenes.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.login.imagenes.destroy'])->syncRoles($admin);
        // Configuración - Estilos
        Permission::create(['name' => 'configuracion.estilo.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.estilo.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.estilo.editar'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.estilo.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.estilo.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.estilo.activar'])->syncRoles($admin);
        // Configuración - Motivo de gasto
        Permission::create(['name' => 'configuracion.motivogasto.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivogasto.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivogasto.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivogasto.destroy'])->syncRoles($admin);
        // Configuración - Motivo de ingreso
        Permission::create(['name' => 'configuracion.motivoingreso.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivoingreso.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivoingreso.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.motivoingreso.destroy'])->syncRoles($admin);
        // Configuración - Comprobante de ingreso
        Permission::create(['name' => 'configuracion.tipocomprobante.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipocomprobante.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipocomprobante.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipocomprobante.destroy'])->syncRoles($admin);
        // Configuración - Comprobante de gasto
        Permission::create(['name' => 'configuracion.comprobantegasto.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.comprobantegasto.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.comprobantegasto.destroy'])->syncRoles($admin);
        // Configuración - Roles
        Permission::create(['name' => 'configuracion.roles.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.roles.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.roles.edit'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.roles.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.roles.destroy'])->syncRoles($admin);
        // Tipos de documento
        Permission::create(['name' => 'configuracion.tipodocumento.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipodocumento.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipodocumento.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.tipodocumento.destroy'])->syncRoles($admin);
        // Sucursal
        Permission::create(['name' => 'admin.sucursal.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.sucursal.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.sucursal.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.sucursal.destroy'])->syncRoles($admin);
        // Tipo de cliente
        Permission::create(['name' => 'admin.tipocliente.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.tipocliente.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.tipocliente.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.tipocliente.destroy'])->syncRoles($admin);
        // Avanzado - Contable
        Permission::create(['name' => 'configuracion.contable.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.contable.store'])->syncRoles($admin);
        // Comisiones - Vendedores
        Permission::create(['name' => 'configuracion.vendedor.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.vendedor.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.vendedor.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.vendedor.destroy'])->syncRoles($admin);
        // Comisiones - Cuentas pendientes
        Permission::create(['name' => 'configuracion.cuentapendiente.index'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentapendiente.store'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentapendiente.update'])->syncRoles($admin);
        Permission::create(['name' => 'configuracion.cuentapendiente.destroy'])->syncRoles($admin);
        // Clientes
        Permission::create(['name' => 'admin.cliente.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.cliente.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.cliente.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.cliente.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.cliente.destroy'])->syncRoles($admin);
        Permission::create(['name' => 'admin.cliente.consulta.documento'])->syncRoles($admin);
        // Series
        Permission::create(['name' => 'admin.serie.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.serie.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.serie.destroy'])->syncRoles($admin);
        // Usuarios
        Permission::create(['name' => 'admin.usuario.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.usuario.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.usuario.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.usuario.destroy'])->syncRoles($admin);
        // Usuarios
        

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}

