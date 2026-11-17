<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hoja de {{ $reclamo->tipo_reclamo }} #{{ str_pad($reclamo->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15px 0;
        }

        body {
            margin: 0;
            padding: 15px 0;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8.5pt;
            line-height: 1.25;
            color: #000;
            background: #fff;
        }

        .sheet-wrapper {
            width: 90%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-table {
            margin-bottom: 10px;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 5px 7px;
        }

        .logo-cell {
            width: 28%;
            text-align: center;
            vertical-align: middle;
        }

        .title-cell {
            width: 47%;
            text-align: center;
            vertical-align: middle;
        }

        .info-cell {
            width: 25%;
            font-size: 8pt;
            vertical-align: middle;
            background-color: #fafafa;
        }

        .section-title {
            background-color: #d9d9d9;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            border: 1px solid #000;
            border-bottom: none;
            margin-top: 10px;
            text-transform: uppercase;
            font-size: 8.5pt;
        }

        .section-title-left {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
            padding: 4px 8px;
            border: 1px solid #000;
            border-bottom: none;
            margin-top: 8px;
            font-size: 8.5pt;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 5px 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .label {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 20%;
        }

        .value {
            width: 30%;
        }

        .value-full {
            width: 80%;
        }

        .text-box {
            border: 1px solid #000;
            border-top: none;
            padding: 6px 8px;
            text-align: justify;
            line-height: 1.3;
            min-height: 42px;
            word-wrap: break-word;
        }

        .text-box-lg {
            min-height: 92px;
        }

        .legal-notes {
            margin-top: 10px;
            font-size: 7.2pt;
            text-align: justify;
            color: #444;
            line-height: 1.25;
        }

        .legal-notes p {
            margin: 4px 0;
        }

        .signatures {
            margin-top: 50px;
            text-align: center;
            font-size: 8.5pt;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto;
            padding-top: 5px;
        }

        .company-name {
            font-size: 10pt;
            font-weight: bold;
            color: #0f1d3a;
            letter-spacing: 0.5px;
        }

        .document-number {
            font-size: 9.5pt;
            color: #b08d2c;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="sheet-wrapper">
        @php
            $path = public_path('uploads/companias/' . $compania->logo);
            $base64 = null;
            if (file_exists($path)) {
                $data = file_get_contents($path);
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $mime = match ($extension) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'webp' => 'image/webp',
                    default => 'image/png',
                };
                $base64 = 'data:' . $mime . ';base64,' . base64_encode($data);
            }
            $nombres = trim(($reclamo->primer_nombre ?? '') . ' ' .($reclamo->segundo_nombre ?? ''));
            $apellidos = trim(($reclamo->primer_apellido ?? '') . ' ' .($reclamo->segundo_apellido ?? ''));
            $nombreCompleto = trim($nombres . ' ' . $apellidos);
        @endphp
        {{-- ENCABEZADO --}}
        <table class="header-table">
            <tr>
                <td rowspan="3" class="logo-cell">
                    @if($base64)
                        <img src="{{ $base64 }}" width="120" style="max-height: 46px; object-fit: contain;">
                    @else
                        <b style="font-size: 14pt;">GRUPOAOSC</b>
                    @endif
                    <br>
                    <span class="company-name">GRUPOAOSC</span>
                </td>
                <td rowspan="3" class="title-cell">
                    <span style="font-size: 12pt; font-weight: bold; color: #0f1d3a;">
                        LIBRO DE RECLAMACIONES
                    </span>
                    <br><br>
                    <span style="font-size: 9pt; font-weight: bold; background-color: #eee; padding: 4px 10px; border: 1px solid #ccc;">
                        HOJA DE {{ strtoupper($reclamo->tipo_reclamo) }}
                    </span>
                </td>
                <td class="info-cell">
                    <b>N° Documento:</b><br>
                    <span class="document-number">{{ str_pad($reclamo->id, 6, '0', STR_PAD_LEFT) }}-{{ $reclamo->created_at?->format('Y') ?? date('Y') }}</span>
                </td>
            </tr>
            <tr>
                <td class="info-cell">
                    <b>Fecha:</b> {{ $reclamo->created_at?->format('d/m/Y') ?? '-' }}
                </td>
            </tr>
            <tr>
                <td class="info-cell">
                    <b>Hora:</b> {{ $reclamo->created_at?->format('H:i') ?? '-' }} hrs
                </td>
            </tr>
        </table>
        <div class="section-title">
            1. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE
        </div>
        <table class="data-table">
            <tr>
                <td class="label">Nombres:</td>
                <td class="value">{{ $nombres ?: '-' }}</td>
                <td class="label">Apellidos:</td>
                <td class="value">{{ $apellidos ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label">{{ $reclamo->tipo_documento }}:</td>
                <td class="value">{{ $reclamo->numero_documento }}</td>
                <td class="label">Teléfono:</td>
                <td class="value">{{ $reclamo->telefono }}</td>
            </tr>
            <tr>
                <td class="label">Correo:</td>
                <td class="value">{{ $reclamo->correo }}</td>
                <td class="label">Ubicación:</td>
                <td class="value">
                    {{ $reclamo->distrito }}, {{ $reclamo->provincia }} - {{ $reclamo->departamento }}
                </td>
            </tr>
            <tr>
                <td class="label">Dirección:</td>
                <td class="value-full" colspan="3">{{ $reclamo->direccion }}</td>
            </tr>
        </table>
        <div class="section-title">
            2. IDENTIFICACIÓN DEL BIEN O SERVICIO CONTRATADO
        </div>
        <table class="data-table">
            <tr>
                <td class="label">Servicio Contratado:</td>
                <td class="value-full" colspan="3">
                    {{ $reclamo->servicio_contratado }}
                </td>
            </tr>
            <tr>
                <td class="label">Monto Reclamado:</td>
                <td class="value">{{ $reclamo->monto_reclamado !== null? 'S/ ' . number_format((float) $reclamo->monto_reclamado, 2): 'No aplica' }}</td>
                <td class="label">N° Orden / Recibo:</td>
                <td class="value">
                    {{ $reclamo->numero_orden ?: 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="label">Identificación / Detalle:</td>
                <td class="value-full" colspan="3">
                    {{ $reclamo->identificacion_servicio ?: 'Sin identificación específica detallada.' }}
                </td>
            </tr>
        </table>
        <div class="section-title">3. DETALLE DE LA RECLAMACIÓN Y PEDIDO DEL CONSUMIDOR</div>
        <table class="data-table">
            <tr>
                <td class="label" style="text-align: center; background-color: #fff;" colspan="4">
                    <b>TIPO:</b>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    RECLAMO ( {{ strtolower($reclamo->tipo_reclamo) == 'reclamo' ? 'X' : ' ' }} )
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    QUEJA ( {{ strtolower($reclamo->tipo_reclamo) == 'queja' ? 'X' : ' ' }} )
                </td>
            </tr>
        </table>
        <div class="section-title-left" style="margin-top: 0;">Motivo:</div>
        <div class="text-box">{!! nl2br(e($reclamo->motivo)) !!}</div>
        <div class="section-title-left"> Detalle de la Solicitud:</div>
        <div class="text-box text-box-lg">{!! nl2br(e($reclamo->detalle_solicitud)) !!}</div>
        <div class="section-title-left"> Pedido Concreto:</div>
        <div class="text-box">{!! nl2br(e($reclamo->pedido_concreto)) !!}</div>
        {{-- INFORMACIÓN LEGAL --}}
        <div class="legal-notes">
            <p>
                <b>RECLAMO:</b> Disconformidad relacionada a los productos o servicios. &nbsp;|&nbsp;
                <b>QUEJA:</b> Disconformidad no relacionada a los productos o servicios; o malestar o descontento respecto a la atención al público.
            </p>
            <p>
                <i>La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito 
                previo para interponer una denuncia ante el INDECOPI. El proveedor deberá dar respuesta al reclamo en un plazo no mayor a treinta (30) días calendario.
                </i>
            </p>
        </div>
        <table class="signatures">
            <tr>
                <td style="width: 50%; text-align: center;">
                    <div class="signature-line">
                        <b>Firma del Consumidor</b><br>
                        {{ $nombreCompleto }}<br>
                        {{ $reclamo->tipo_documento }}: {{ $reclamo->numero_documento }}
                    </div>
                </td>
                <td style="width: 50%; text-align: center;">
                    <div class="signature-line">
                        <b>Representante de la Empresa</b><br>
                        Firma y Sello<br>
                        <b>GRUPOAOSC</b>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>