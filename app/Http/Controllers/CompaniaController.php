<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use Illuminate\Http\Request;

class CompaniaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compania = Compania::first();
        return view('admin.configuracion.compania.index', compact('compania'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $compania = Compania::first();
        if (!$compania) {
            $compania = new Compania();
        }
        $compania->ruc = $request->ruc;
        $compania->nombre = $request->nombre;
        $compania->nombre_comercial = $request->nombre_comercial;
        $compania->cuenta_detraccion = $request->cuenta_detraccion;
        $compania->titulo_web = $request->titulo_web;
        $compania->soap_tipo = $request->soap_tipo;
        $compania->soap_envio = $request->soap_envio;
        $compania->soap_usuario = $request->soap_usuario;
        $compania->soap_password = $request->soap_password;
        $compania->cpe_client_id = $request->cpe_client_id;
        $compania->cpe_client_secret = $request->cpe_client_secret;
        $compania->guias_soap_usuario = $request->guias_soap_usuario;
        $compania->guias_soap_password = $request->guias_soap_password;
        $compania->guias_client_id = $request->guias_client_id;
        $compania->guias_client_secret = $request->guias_client_secret;
        $compania->sire_client_id = $request->sire_client_id;
        $compania->sire_client_secret = $request->sire_client_secret;
        $compania->sire_usuario = $request->sire_usuario;
        $compania->sire_password = $request->sire_password;
        $compania->qr_api = $request->has('qr_api_habilitado');
        $compania->pse_habilitado = $request->has('servicio_pse_habilitado');
        $compania->pse_proveedor_id = $request->pse_proveedor_id;
        $compania->pse_usuario = $request->pse_usuario;
        $compania->pse_password = $request->pse_password;
        $compania->yape_habilitado = $request->has('pago_yape_habilitado');
        $compania->mercado_pago_habilitado = $request->has('mercado_pago_habilitado');
        if ($request->hasFile('logo')) {
            $archivo = $request->file('logo');
            $nombreArchivo = time() . '_logo.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/companias'), $nombreArchivo);
            $compania->logo = $nombreArchivo;
        }
        if ($request->hasFile('logo_app')) {
            $archivo = $request->file('logo_app');
            $nombreArchivo = time() . '_logo_app.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/companias'), $nombreArchivo);
            $compania->logo_app = $nombreArchivo;
        }
        if ($request->hasFile('rubrica')) {
            $archivo = $request->file('rubrica');
            $nombreArchivo = time() . '_rubrica.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/companias'), $nombreArchivo);
            $compania->rubrica = $nombreArchivo;
        }
        if ($request->hasFile('digital_certificate_qztray')) {
            $archivo = $request->file('digital_certificate_qztray');
            $nombreArchivo = time() . '_qztray.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/companias'), $nombreArchivo);
            $compania->digital_certificate_qztray = $nombreArchivo;
        }
        if ($request->hasFile('private_certificate_qztray')) {
            $archivo = $request->file('private_certificate_qztray');
            $nombreArchivo = time() . '_private_qztray.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/companias'), $nombreArchivo);
            $compania->private_certificate_qztray = $nombreArchivo;
        }
        $compania->save();
        return redirect()
            ->route('configuracion.compania')
            ->with('success', 'Los datos de la compañía se guardaron correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Compania $compania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compania $compania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int  $id)
    {
        $compania = Compania::findOrFail($id);

        // Datos de la empresa
        $compania->ruc = $request->ruc;
        $compania->nombre = $request->nombre;
        $compania->nombre_comercial = $request->nombre_comercial;
        $compania->cuenta_detraccion = $request->cuenta_detraccion;
        $compania->titulo_web = $request->titulo_web;

        // Entorno del sistema
        $compania->soap_tipo = $request->soap_tipo;
        $compania->soap_envio = $request->soap_envio;
        $compania->soap_usuario = $request->soap_usuario;
        $compania->soap_password = $request->soap_password;

        // Consulta integrada de CPE
        $compania->cpe_client_id = $request->cpe_client_id;
        $compania->cpe_client_secret = $request->cpe_client_secret;

        // Guías electrónicas
        $compania->guias_soap_usuario = $request->guias_soap_usuario;
        $compania->guias_soap_password = $request->guias_soap_password;
        $compania->guias_client_id = $request->guias_client_id;
        $compania->guias_client_secret = $request->guias_client_secret;

        // SIRE
        $compania->sire_client_id = $request->sire_client_id;
        $compania->sire_client_secret = $request->sire_client_secret;
        $compania->sire_usuario = $request->sire_usuario;
        $compania->sire_password = $request->sire_password;

        // QR API
        $compania->qr_api = $request->has('qr_api');

        // Servicio PSE
        $compania->pse_habilitado = $request->has('pse_habilitado');
        $compania->pse_proveedor_id = $request->pse_proveedor_id;
        $compania->pse_usuario = $request->pse_usuario;
        $compania->pse_password = $request->pse_password;

        // Configuración de pagos
        $compania->yape_habilitado = $request->has('yape_habilitado');
        $compania->mercado_pago_habilitado = $request->has('mercado_pago_habilitado');

        // Logo
        if ($request->hasFile('logo')) {
            $archivo = $request->file('logo');
            $nombreArchivo = time() . '_logo.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('uploads/companias'), $nombreArchivo);

            $compania->logo = $nombreArchivo;
        }

        // Logo APP
        if ($request->hasFile('logo_app')) {
            $archivo = $request->file('logo_app');
            $nombreArchivo = time() . '_logo_app.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('uploads/companias'), $nombreArchivo);

            $compania->logo_app = $nombreArchivo;
        }

        // Rúbrica
        if ($request->hasFile('rubrica')) {
            $archivo = $request->file('rubrica');
            $nombreArchivo = time() . '_rubrica.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('uploads/companias'), $nombreArchivo);

            $compania->rubrica = $nombreArchivo;
        }

        // Certificado digital QZ Tray
        if ($request->hasFile('digital_certificate_qztray')) {
            $archivo = $request->file('digital_certificate_qztray');
            $nombreArchivo = time() . '_qztray.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('uploads/companias'), $nombreArchivo);

            $compania->digital_certificate_qztray = $nombreArchivo;
        }

        // Certificado privado QZ Tray
        if ($request->hasFile('private_certificate_qztray')) {
            $archivo = $request->file('private_certificate_qztray');
            $nombreArchivo = time() . '_private_qztray.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('uploads/companias'), $nombreArchivo);

            $compania->private_certificate_qztray = $nombreArchivo;
        }

        $compania->save();

        return redirect()
            ->route('configuracion.compania')
            ->with('success', 'Los datos de la compañía se actualizaron correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compania $compania)
    {
        //
    }

    public function eliminarLogo(int  $id)
    {
        $compania = Compania::findOrFail($id);
        $compania->logo = null;
        $compania->save();
        return redirect()->back()->with('success', 'Logo eliminado correctamente.');
    }
}
