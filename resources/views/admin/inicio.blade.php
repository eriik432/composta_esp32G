@extends('admin.dashboard')
@section('content')
<div id="layoutSidenav_content">
    <main class="main-content p-6 bg-gray-50 min-h-screen">

        <!-- Bienvenida -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 flex items-center justify-center bg-white rounded-full shadow">
                    <i class="fas fa-user text-green-600 text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">¡Bienvenido, {{ auth()->user()->username }}!</h1>
                    <p class="text-green-100 mt-1 text-sm md:text-base">Explora tu panel y gestiona tus planes de forma eficiente.</p>
                </div>
            </div>
            <div class="text-right">
                
            </div>
        </div>

        <!-- Aquí puedes agregar más contenido dinámico del main -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Ejemplo de tarjeta -->
            <div class="bg-white rounded-2xl shadow p-4 hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-800 text-lg mb-2">Planes Activos</h3>
                <p class="text-gray-500">Gestiona todos los planes que tienes actualmente activos.</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-800 text-lg mb-2">Comprobantes Rechazados</h3>
                <p class="text-gray-500">Revisa y administra los comprobantes rechazados de usuarios.</p>
            </div>
            
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Columna 1 -->
                <div class="footer-logo flex flex-col items-center md:items-start">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6m12-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Compostaje<span class="text-secondary">IoT</span></span>
                    </div>
                    <p class="text-gray-400 mb-4 text-center md:text-left">Sistema inteligente para el monitoreo de compostaje doméstico mediante tecnología IoT.</p>
                    
                    <div class="footer-social flex space-x-4 mt-6">
                        <a href="#" class="social-icon text-gray-400 hover:text-tertiary text-xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon text-gray-400 hover:text-tertiary text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon text-gray-400 hover:text-tertiary text-xl"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="footer-column">
                    <h3 class="text-xl font-semibold mb-4 text-white">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="footer-link text-gray-400">Inicio</a></li>
                        <li><a href="#" class="footer-link text-gray-400">Proyecto</a></li>
                        <li><a href="#" class="footer-link text-gray-400">Tecnología</a></li>
                    </ul>
                </div>
                
                <!-- Columna 3 -->
                <div class="footer-column">
                    <h3 class="text-xl font-semibold mb-4 text-white">Contacto</h3>
                    <ul class="space-y-3 footer-contact">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-secondary mt-1"></i>
                            <span class="text-gray-400">Av. Villa Israel #123, La Paz, Bolivia</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone-alt text-secondary"></i>
                            <span class="text-gray-400">+591 12345678</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
                <p>&copy; 2023 Sistema de Compostaje IoT - Villa Israel. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</div>
@endsection
