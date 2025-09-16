@extends('layouts.app')

@section('title', 'Nosotros - Equipo del Proyecto')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Encabezado -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 mt-20">Nuestro Equipo</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Conoce al equipo detrás del desarrollo del sistema de compostaje inteligente con monitoreo IoT
                </p>
            </div>

            <!-- Descripción del proyecto -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Sobre el Proyecto</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-lg text-gray-600 mb-6">
                            Este proyecto nace de la necesidad de optimizar el proceso de compostaje doméstico, combinando
                            tecnología IoT con prácticas sostenibles para crear una solución innovadora y accesible.
                        </p>
                        <p class="text-lg text-gray-600">
                            Nuestro objetivo es democratizar el acceso a sistemas de compostaje inteligente, reduciendo la
                            cantidad de residuos orgánicos que terminan en vertederos y promoviendo la economía circular.
                        </p>
                    </div>
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <img src="https://eadic.com/wp-content/uploads/2020/05/Proyecto-2-1.jpg"
                            alt="Equipo trabajando en el compostero" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>

            <!-- Miembros del equipo -->
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Conoce al Equipo</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                <!-- Miembro 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80"
                            alt="Ronald Huanca Colque" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Ronald Huanca Colque</h3>
                        <p class="text-green-600 font-medium mb-4">Especialista en Hardware IoT</p>
                        <p class="text-gray-600 mb-4">
                            Encargado del diseño electrónico, programación de microcontroladores e integración de sensores
                            para el sistema de monitoreo.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-500 hover:text-green-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-blue-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Miembro 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80"
                            alt="Erik Edil Espindola Jimenez" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Erik Edil Espindola Jimenez</h3>
                        <p class="text-green-600 font-medium mb-4">Desarrollador Full Stack</p>
                        <p class="text-gray-600 mb-4">
                            Responsable del desarrollo de la plataforma web, dashboard de visualización de datos y
                            aplicación móvil para el monitoreo remoto.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-500 hover:text-green-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-blue-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuestra misión -->
            <div class="bg-gradient-to-r from-green-800 to-green-600 rounded-xl shadow-lg p-12 mt-16 text-white">
                <h2 class="text-3xl font-bold text-center mb-8">Nuestra Misión</h2>
                <p class="text-xl text-center max-w-4xl mx-auto text-green-100">
                    "Desarrollar soluciones tecnológicas accesibles que promuevan prácticas sostenibles, combinando
                    innovación IoT con conciencia ambiental para crear un impacto positivo en nuestra comunidad."
                </p>
            </div>
        </div>
    </div>
@endsection
