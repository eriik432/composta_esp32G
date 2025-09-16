@extends('layouts.app')

@section('title', 'Proyecto - Compostero IoT')

@section('content')
    <div class="bg-gray-50 py-12 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 mt-20">Sistema de Compostaje Inteligente</h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                    Monitoreo en tiempo real de compostaje doméstico mediante tecnología IoT
                </p>
            </div>

            <!-- Imagen principal -->
            <div class="mb-16 rounded-xl overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                    alt="Compostero inteligente" class="w-full h-auto object-cover">
            </div>

            <!-- Sección de descripción -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-20">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">¿Qué es nuestro compostero IoT?</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Un sistema innovador que combina un contenedor de compostaje tradicional con sensores inteligentes
                        que monitorean:
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-green-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Temperatura interna</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-green-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Humedad del material</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-green-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Nivel de llenado</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-green-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Calidad del aire</span>
                        </li>
                    </ul>
                </div>
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <img src="https://manuals.plus/wp-content/uploads/2023/05/MEEC-TOOLS-GY6610-2800W-Compost-Shredder-Figure-1.jpg"
                        alt="Diagrama del compostero"
                        style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
                </div>
            </div>

            <!-- Características técnicas -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-20">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Tecnología Implementada</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Tarjeta 1 -->
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="text-center mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968260.png" alt="ESP32"
                                class="h-16 mx-auto">
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Microcontrolador ESP32</h3>
                        <p class="text-gray-600 text-center">
                            Cerebro del sistema, procesa datos de los sensores y los envía a la nube mediante WiFi.
                        </p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="text-center mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/2103/2103633.png" alt="Sensores"
                                class="h-16 mx-auto">
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Conjunto de Sensores</h3>
                        <p class="text-gray-600 text-center">
                            DHT22 (temperatura/humedad), MQ-135 (calidad aire), ultrasonico (nivel) y más.
                        </p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="text-center mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="Dashboard"
                                class="h-16 mx-auto">
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Dashboard Web</h3>
                        <p class="text-gray-600 text-center">
                            Visualización en tiempo real de los datos con gráficos y alertas configurables.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Galería de imágenes -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Galería del Proyecto</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1605007493699-af65834f8a00?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Prototipo inicial" class="w-full h-64 object-cover">
                        <div class="p-4 bg-white">
                            <h3 class="font-semibold text-lg">Prototipo inicial</h3>
                            <p class="text-gray-600 text-sm">Primeras versiones del compostero</p>
                        </div>
                    </div>

                    <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Instalación de sensores" class="w-full h-64 object-cover">
                        <div class="p-4 bg-white">
                            <h3 class="font-semibold text-lg">Instalación de sensores</h3>
                            <p class="text-gray-600 text-sm">Colocación de los componentes electrónicos</p>
                        </div>
                    </div>

                    <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Pruebas de campo" class="w-full h-64 object-cover">
                        <div class="p-4 bg-white">
                            <h3 class="font-semibold text-lg">Pruebas de campo</h3>
                            <p class="text-gray-600 text-sm">Validación en condiciones reales</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficios -->
            <div class="bg-gradient-to-r from-green-800 to-green-600 rounded-xl shadow-lg p-8 text-white">
                <h2 class="text-3xl font-bold text-center mb-12">Beneficios del Sistema</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center p-4">
                        <div
                            class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Eficiencia mejorada</h3>
                        <p class="text-green-100">Proceso de compostaje 30% más rápido</p>
                    </div>

                    <div class="text-center p-4">
                        <div
                            class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Calidad garantizada</h3>
                        <p class="text-green-100">Compost de mejor calidad con menos olores</p>
                    </div>

                    <div class="text-center p-4">
                        <div
                            class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Ahorro de tiempo</h3>
                        <p class="text-green-100">Reduce el tiempo de mantenimiento</p>
                    </div>

                    <div class="text-center p-4">
                        <div
                            class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Sostenibilidad</h3>
                        <p class="text-green-100">Reduce residuos orgánicos en vertederos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
