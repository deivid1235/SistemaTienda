<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Serie;
use App\Models\Sucursal;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        $tipoDocumentos = TipoDocumento::all();
        $sucursales = Sucursal::all();
        $roles = Role::all();
        $series = Serie::all();
        $permisos = $this->obtenerPermisos();
        return view('admin.usuario.index', compact('usuarios', 'tipoDocumentos','sucursales','roles','series','permisos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'numero' => 'required|string|max:50',
            'nombre' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'correo_personal' => 'nullable|email|max:150',
            'celular' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
            'fecha_contratacion' => 'nullable|date',
            'fecha_vencimiento_contrato' => 'nullable|date',
            'sucursal_id' => 'required|exists:sucursals,id',
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'serie_id' => 'required|exists:series,id',
            'estado' => 'required',
            'correo_laboral' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->nombre . ' ' . $request->apellidos;
            $user->email = $request->correo_laboral;
            $user->password = Hash::make($request->password);
            $user->save();
            $usuario = new Usuario();
            $usuario->user_id = $user->id;
            $usuario->tipo_documento = $request->tipo_documento;
            $usuario->numero = $request->numero;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $usuario->correo_personal = $request->correo_personal;
            $usuario->celular = $request->celular;
            $usuario->direccion = $request->direccion;
            $usuario->fecha_contratacion = $request->fecha_contratacion;
            $usuario->fecha_vencimiento_contrato = $request->fecha_vencimiento_contrato;
            $usuario->sucursal_id = $request->sucursal_id;
            $usuario->rol_id = $request->rol_id;
            $usuario->tipo_documento_id = $request->tipo_documento_id;
            $usuario->serie_id = $request->serie_id;
            $usuario->estado = $request->estado;
            if ($request->hasFile('foto')) {
                $carpeta = public_path('uploads/usuarios');
                if (!file_exists($carpeta)) {
                    mkdir($carpeta, 0755, true);
                }
                $foto = $request->file('foto');
                $nombreFoto = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->move($carpeta, $nombreFoto);
                $usuario->foto = 'uploads/usuarios/' . $nombreFoto;
            }
            $usuario->save();
            $rol = Role::findById($request->rol_id);
            $user->assignRole($rol);
            $permisosSeleccionados = $request->input('permisos', []);
            $permisos = Permission::whereIn('id', $permisosSeleccionados)->get();
            $user->syncPermissions($permisos);
        });
        return redirect()
            ->route('usuario')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function show(Usuario $usuario)
    {
        //
    }

    public function edit(Usuario $usuario)
    {
        //
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'numero' => 'required|string|max:50',
            'nombre' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'correo_personal' => 'nullable|email|max:150',
            'celular' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
            'fecha_contratacion' => 'nullable|date',
            'fecha_vencimiento_contrato' => 'nullable|date',
            'sucursal_id' => 'required|exists:sucursals,id',
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'serie_id' => 'required|exists:series,id',
            'estado' => 'required',
            'correo_laboral' => 'required|email|max:150|unique:users,email,' . $usuario->user_id,
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        DB::transaction(function () use ($request, $usuario) {
            $user = User::findOrFail($usuario->user_id);
            $user->name = $request->nombre . ' ' . $request->apellidos;
            $user->email = $request->correo_laboral;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $usuario->tipo_documento = $request->tipo_documento;
            $usuario->numero = $request->numero;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $usuario->correo_personal = $request->correo_personal;
            $usuario->celular = $request->celular;
            $usuario->direccion = $request->direccion;
            $usuario->fecha_contratacion = $request->fecha_contratacion;
            $usuario->fecha_vencimiento_contrato = $request->fecha_vencimiento_contrato;
            $usuario->sucursal_id = $request->sucursal_id;
            $usuario->rol_id = $request->rol_id;
            $usuario->tipo_documento_id = $request->tipo_documento_id;
            $usuario->serie_id = $request->serie_id;
            $usuario->estado = $request->estado;
            if ($request->hasFile('foto')) {
                $carpeta = public_path('uploads/usuarios');
                if (!file_exists($carpeta)) {
                    mkdir($carpeta, 0755, true);
                }
                $foto = $request->file('foto');
                $nombreFoto = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->move($carpeta, $nombreFoto);
                $usuario->foto = 'uploads/usuarios/' . $nombreFoto;
            }

            $usuario->save();
            $rol = Role::findById($request->rol_id);
            $user->syncRoles([$rol]);
            $permisosSeleccionados = $request->input('permisos', []);
            $permisos = Permission::whereIn('id', $permisosSeleccionados)->get();
            $user->syncPermissions($permisos);
        });

        return redirect()
            ->route('usuario')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        DB::transaction(function () use ($usuario) {
            $user = User::find($usuario->user_id);
            if ($usuario->foto) {
                $rutaFoto = public_path($usuario->foto);
                if (file_exists($rutaFoto)) {
                    unlink($rutaFoto);
                }
            }
            $usuario->delete();
            if ($user) { $user->delete();}
        });
        return redirect()
            ->route('usuario')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    private function obtenerPermisos()
    {
        return Permission::all()->groupBy(function ($permiso) {
            if (str_starts_with($permiso->name, 'admin.dashboard.')) {
                return 'Dashboard';
            }
            if (
                str_starts_with($permiso->name, 'admin.cliente.') ||
                str_starts_with($permiso->name, 'admin.tipocliente.')
            ) {
                return 'Clientes';
            }
            if (
                str_starts_with($permiso->name, 'configuracion.banco.') ||
                str_starts_with($permiso->name, 'configuracion.moneda.') ||
                str_starts_with($permiso->name, 'configuracion.cuentabancaria.') ||
                str_starts_with($permiso->name, 'configuracion.tarjeta.') ||
                str_starts_with($permiso->name, 'configuracion.plataforma.') ||
                str_starts_with($permiso->name, 'configuracion.metodopago.') ||
                str_starts_with($permiso->name, 'configuracion.metodogasto.') ||
                str_starts_with($permiso->name, 'configuracion.motivogasto.') ||
                str_starts_with($permiso->name, 'configuracion.motivoingreso.') ||
                str_starts_with($permiso->name, 'configuracion.tipocomprobante.') ||
                str_starts_with($permiso->name, 'configuracion.comprobantegasto.')
            ) {
                return 'Finanzas';
            }
            if (str_starts_with($permiso->name, 'configuracion.traslado.')) {
                return 'Guías de Remisión';
            }
            if (str_starts_with($permiso->name, 'configuracion.tipodocumento.')) {
                return 'Documentos Avanzados';
            }
            if (
                str_starts_with($permiso->name, 'admin.usuario.') ||
                str_starts_with($permiso->name, 'admin.sucursal.') ||
                str_starts_with($permiso->name, 'admin.serie.') ||
                str_starts_with($permiso->name, 'configuracion.roles.')
            ) {
                return 'Usuarios / Locales & Series';
            }
            if (
                str_starts_with($permiso->name, 'admin.configuracion.') ||
                str_starts_with($permiso->name, 'configuracion.atributo.') ||
                str_starts_with($permiso->name, 'configuracion.detraccion.') ||
                str_starts_with($permiso->name, 'configuracion.unidad.') ||
                str_starts_with($permiso->name, 'configuracion.compania.') ||
                str_starts_with($permiso->name, 'configuracion.login.') ||
                str_starts_with($permiso->name, 'configuracion.estilo.')
            ) {
                return 'Configuration';
            }
            return 'Otros';
        });
    }
}