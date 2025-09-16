<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Plan Actual - {{ $pago->plan->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            padding: 15px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .info-item {
            margin-bottom: 6px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Encabezado -->
        <div class="header">
            <div class="title">📄 Mi Plan de Servicio Actual</div>
            <div style="color:#666;">Fecha de emisión: {{ now()->format('d/m/Y') }}</div>
        </div>

        <!-- Sección Usuario -->
        <div class="section">
            <div class="section-title">Datos del Usuario</div>
            <div class="info-item"><span class="label">Nombre:</span> {{ $pago->user->name }}</div>
            <div class="info-item"><span class="label">Correo:</span> {{ $pago->user->email }}</div>
            @if ($pago->user->username)
                <div class="info-item"><span class="label">Usuario:</span> {{ $pago->user->username }}</div>
            @endif
        </div>

        <!-- Sección Plan -->
        <div class="section">
            <div class="section-title">Plan Contratado</div>
            <div class="info-item"><span class="label">Nombre del Plan:</span> {{ $pago->plan->name }}</div>
            <div class="info-item"><span class="label">Descripción:</span> {{ $pago->plan->description }}</div>
            <div class="info-item"><span class="label">Duración:</span> {{ $pago->plan->duration }} días</div>
            <div class="info-item"><span class="label">Precio:</span> Bs {{ number_format($pago->plan->cost, 2) }}</div>
        </div>

        <!-- Observaciones -->
        @if ($pago->observations)
        <div class="section">
            <div class="section-title">Observaciones</div>
            <div class="info-item">{{ $pago->observations }}</div>
        </div>
        @endif

    </div>
</body>
</html>
