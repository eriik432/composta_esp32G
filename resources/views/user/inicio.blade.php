@extends('user.dashboard')
@section('content')
<div id="layoutSidenav_content" class='p-3'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ... tu CSS igual ... */
    </style>


    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Dashboard IoT - Compostaje con Sensores</h1>

    <!-- Alerta -->
    <div id="alerta" class="hidden bg-red-600 text-white text-center p-4 rounded mb-6">
        ⚠️ Niveles peligrosos detectados por el sensor MQ-135 ⚠️
    </div>

    <!-- Cards de sensores -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Temp. Ambiente (DHT22)</h2>
            <p id="temp" class="text-2xl font-bold text-gray-800">-- °C</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Humedad Ambiente (DHT22)</h2>
            <p id="hum" class="text-2xl font-bold text-gray-800">-- %</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Concentración de Gas (MQ-135)</h2>
            <p id="mq135" class="text-2xl font-bold text-gray-800">--</p>
            <p id="air_status" class="text-sm mt-1 text-green-600 font-medium">---</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Temp. Suelo (DS18B20)</h2>
            <p id="ds18b20" class="text-2xl font-bold text-gray-800">-- °C</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Humedad Suelo (Capacitivo v1.2)</h2>
            <p id="soil" class="text-2xl font-bold text-gray-800">-- %</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Exportar Reporte</h2>
            <p id="status" class="text-2xl font-bold text-gray-800">---</p>
            <button onclick="descargarCSV()" class="mt-3 bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm">
                📥 CSV
            </button>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-3">Gráfico de Tiempo Real</h3>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-3">Composición Estimada de Gases</h3>
            <canvas id="doughnutChart"></canvas>
        </div>
    </div>

    <audio id="alert_sound">
        <source src="alert.mp3" type="audio/mp3">
    </audio>

    <script>
    let lineChart, doughnutChart;
    let registros = @json($data);

    function actualizarCards(d) {
        document.getElementById("temp").textContent = d.temperature + " °C";
        document.getElementById("hum").textContent = d.humidity + " %";
        document.getElementById("mq135").textContent = d.mq135 + " ppm";
        document.getElementById("status").textContent = d.status;
        document.getElementById("ds18b20").textContent = d.ds18b20_temp + " °C";
        document.getElementById("soil").textContent = d.soil_moisture + " %";
        document.getElementById("air_status").textContent = d.air_quality_status;
    }

    function mostrarAlerta(d) {
        const alerta = document.getElementById("alerta");
        const alertSound = document.getElementById("alert_sound");
        if (d.air_quality_status === "Gases nocivos" || d.mq135 > 600) {
            alerta.classList.remove("hidden");
            alertSound.play();
        } else {
            alerta.classList.add("hidden");
        }
    }

    function dibujarGraficos(data) {
        const ctx = document.getElementById("lineChart").getContext("2d");
        if (lineChart) lineChart.destroy();
        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(d => d.date + " " + d.time),
                datasets: [
                    { label: "Temp. (°C)", data: data.map(d => d.temperature), borderColor: "red", fill: false, yAxisID: 'y1' },
                    { label: "Humedad (%)", data: data.map(d => d.humidity), borderColor: "blue", fill: false, yAxisID: 'y1' },
                    { label: "Temp. DS18B20 (°C)", data: data.map(d => d.ds18b20_temp), borderColor: "#f59e0b", fill: false, yAxisID: 'y1' },
                    { label: "Humedad Suelo (%)", data: data.map(d => d.soil_moisture), borderColor: "#8b5cf6", fill: false, yAxisID: 'y1' },
                    { label: "MQ-135", data: data.map(d => d.mq135), borderColor: "green", fill: false, yAxisID: 'y2' }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                stacked: false,
                scales: {
                    y1: {
                        type: 'linear',
                        position: 'left',
                        title: { display: true, text: 'Temperatura / Humedad (%)' },
                        min: 0, max: 100
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        title: { display: true, text: 'MQ-135 (valor)' },
                        min: 0, max: 1000,
                        grid: { drawOnChartArea: false }
                    },
                    x: {
                        title: { display: true, text: 'Fecha y Hora' }
                    }
                }
            }
        });

        const gases = {
            "NH₃": parseFloat(data.at(-1).ammonia),
            "CO₂": parseFloat(data.at(-1).co2),
            "CO": parseFloat(data.at(-1).co),
            "Benceno": parseFloat(data.at(-1).benzene),
            "Alcohol": parseFloat(data.at(-1).alcohol),
            "Humo": parseFloat(data.at(-1).smoke)
        };

        const ctx2 = document.getElementById("doughnutChart").getContext("2d");
        if (doughnutChart) doughnutChart.destroy();
        doughnutChart = new Chart(ctx2, {
            type: "doughnut",
            data: {
                labels: Object.keys(gases),
                datasets: [{
                    data: Object.values(gases),
                    backgroundColor: ["#4CAF50", "#FF9800", "#F44336", "#2196F3", "#9C27B0", "#607D8B"]
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    function descargarCSV() {
        const encabezado = "Fecha,Hora,Temp,Hum,MQ135,Estado,NH3,CO2,CO,Benceno,Alcohol,Humo,DS18B20,Suelo\n";
        const filas = registros.map(d => [
            d.date, d.time, d.temperature, d.humidity, d.mq135, d.air_quality_status,
            d.ammonia, d.co2, d.co, d.benzene, d.alcohol, d.smoke,
            d.ds18b20_temp, d.soil_moisture
        ].join(",")).join("\n");

        const blob = new Blob([encabezado + filas], { type: "text/csv;charset=utf-8;" });
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "datos_compost.csv";
        a.style.display = "none";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // Mostrar datos al cargar
    if (registros.length > 0) {
        actualizarCards(registros.at(-1));
        mostrarAlerta(registros.at(-1));
        dibujarGraficos(registros);
    }

    // Actualizar datos cada 15 segundos desde Laravel
    setInterval(async () => {
        try {
            const res = await fetch("{{ route('dashboard.datosJson') }}");
            const data = await res.json();
            registros = data;

            actualizarCards(data.at(-1));
            mostrarAlerta(data.at(-1));
            dibujarGraficos(data);
        } catch (e) {
            console.error("Error al actualizar datos:", e);
        }
    }, 10000);
</script>


    <div class="mt-8 text-center">
    <a href="{{ route('historial') }}"
       class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 font-semibold rounded-md shadow-sm hover:bg-blue-200 transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l-4-4m0 0l4-4m-4 4h16"/>
        </svg>
        Ver historial de lecturas
    </a>
</div>
</div>
@endsection
