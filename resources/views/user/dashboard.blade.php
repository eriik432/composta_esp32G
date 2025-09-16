<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Compostaje IoT - Villa Israel</title>

    <!-- CSS FILES -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Estilos generales */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Barra lateral */
        #layoutSidenav {
            display: flex;
        }

        #layoutSidenav_nav {
            width: 225px;
            height: 100vh;
            position: fixed;
            z-index: 1038;
            transform: translateX(-225px);
            transition: transform 0.15s ease-in-out;
        }

        #layoutSidenav_content {
            width: 100%;
            margin-left: 0;
            transition: margin 0.15s ease-in-out;
        }

        .sb-sidenav {
            height: 100%;
            overflow-y: auto;
        }

        .sb-sidenav-dark {
            background-color: #412101ff;
            color: rgba(255, 255, 255, 1);
        }

        .sb-sidenav-menu {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .sb-sidenav-menu-heading {
            padding: 1.75rem 1rem 0.75rem;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.25);
        }

        .sb-sidenav-menu .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 1);
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .sb-sidenav-menu .nav-link:hover {
            color: rgba(255, 255, 255, 0.75);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sb-sidenav-menu .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sb-sidenav-menu .nav-link .sb-nav-link-icon {
            margin-right: 0.5rem;
        }

        .sb-sidenav-footer {
            padding: 0.75rem;
            background-color: rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Barra superior */
        .sb-topnav {
            height: 56px;
            z-index: 1039;
            background-image: linear-gradient(90deg, #381c00ff, #69350dff, #a55a2bff) !important;
            background-size: cover;
            background-repeat: no-repeat;
        }


        .sb-topnav .navbar-brand {
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            text-decoration: none;
            white-space: nowrap;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Contenido principal */
        .main-content {
            margin-top: 56px;
            padding: 20px;
            transition: margin-left 0.15s ease-in-out;
        }

        /* Efectos para el header */
        #mainHeader {
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.5, 1);
            will-change: transform;
        }

        #mainHeader.hide {
            transform: translateY(-100%);
        }

        #mainHeader.scrolled {
            background: linear-gradient(to right, rgba(27, 94, 32, 0.98), rgba(46, 125, 50, 0.98));
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Hero section */
        .hero-section {
            position: relative;
            height: 70vh;
            overflow: hidden;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            background-blend-mode: overlay;
            background-color: rgba(55, 65, 81, 0.7);
        }

        .hero-image.active {
            opacity: 1;
        }

        /* Efecto hover para tarjetas */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Footer moderno */
        .footer-link {
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer-link:hover {
            color: #a7f3a0;
            transform: translateX(5px);
        }

        .social-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            color: #a7f3a0;
        }

        /* Estilos para las tarjetas */
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .card .image-container {
            width: 100%;
            max-width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            margin: auto;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card h5 {
            text-align: center;
        }

        /* Estilos del mapa */
        #contenedor-del-mapa {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            margin-top: 20px;
        }

        /* Estilo para el marcador personalizado */
        .custom-marker {
            position: relative;
            width: 50px;
            height: 70px;
            background-color: transparent;
        }

        .custom-marker img {
            position: absolute;
            top: -2px;
            left: 5px;
            width: 40px;
            height: 40px;
            border-radius: 100%;
            border: 3px solid #ee0000;
            box-shadow: 0 0 5px rgba(255, 1, 1, 0.5);
        }

        /* Estilos para el carrusel */
        .swiper {
            width: 80%;
            max-width: 1200px;
            height: auto;
            margin: 20px auto;
            padding-bottom: 30px;
        }

        .swiper-slide {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9f9f9;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Media queries */
        @media (min-width: 992px) {
            #layoutSidenav_nav {
                transform: translateX(0);
            }

            #layoutSidenav_content {
                margin-left: 225px;
            }

            .sb-topnav {
                padding-left: 225px;
            }
        }

        @media (max-width: 768px) {
            #contenedor-del-mapa {
                height: 300px;
            }

            .card {
                flex-direction: column;
                align-items: stretch;
            }

            .card .image-container {
                margin-bottom: 15px;
                width: 100%;
                height: auto;
            }
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2e7d32',
                        secondary: '#1b5e20',
                        tertiary: '#a7f3a0',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Barra de navegación superior -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-gray-800 ps-16">
        <a class="navbar-brand ps-3" href="/admin/dashboard/">Inicio</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars text-white"></i>
        </button>

        <ul class="flex items-center gap-4 ms-auto me-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw text-white"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <button onclick="document.getElementById('editModal').showModal()" class="dropdown-item">Editar Perfil</button>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <button onclick="document.getElementById('editModalR').showModal()" class="dropdown-item">Agregar Referencias</button>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <!-- Botón para descargar el APK -->
                        <a href="{{ asset('Composta_IoT_APK/compost.apk') }}" class="dropdown-item" download>
                            Descargar APK
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        <dialog id="editModalR" class="rounded-xl p-0 max-w-2xl w-full shadow-xl backdrop:bg-black/40 z-50">
            <form method="POST" action="{{ route('references.store') }}" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl space-y-5">
                @csrf
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-address-book text-green-600"></i> Agregar Referencias
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Teléfono --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-blue-300">
                            <i class="fas fa-phone text-gray-400 px-2"></i>
                            <input type="text" name="phone" placeholder="Ej: +591 71234567"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('phone', auth()->user()->reference->phone ?? '') }}">
                        </div>
                    </div>

                    {{-- Correo --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">Correo de Contacto</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-blue-300">
                            <i class="fas fa-envelope text-gray-400 px-2"></i>
                            <input type="email" name="contact_email" placeholder="ejemplo@correo.com"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('contact_email', auth()->user()->reference->contact_email ?? '') }}">
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-green-400">
                            <i class="fab fa-whatsapp text-green-500 px-2"></i>
                            <input type="url" name="whatsapp_link" placeholder="https://wa.me/591..."
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('whatsapp_link', auth()->user()->reference->whatsapp_link ?? '') }}">
                        </div>
                    </div>

                    {{-- Facebook --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">Facebook</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-blue-600">
                            <i class="fab fa-facebook text-blue-600 px-2"></i>
                            <input type="url" name="facebook_link" placeholder="https://facebook.com/usuario"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('facebook_link', auth()->user()->reference->facebook_link ?? '') }}">
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">Instagram</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-pink-500">
                            <i class="fab fa-instagram text-pink-500 px-2"></i>
                            <input type="url" name="instagram_link" placeholder="https://instagram.com/usuario"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('instagram_link', auth()->user()->reference->instagram_link ?? '') }}">
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">YouTube</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-red-500">
                            <i class="fab fa-youtube text-red-500 px-2"></i>
                            <input type="url" name="youtube_link" placeholder="https://youtube.com/c/usuario"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('youtube_link', auth()->user()->reference->youtube_link ?? '') }}">
                        </div>
                    </div>

                    {{-- TikTok --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">TikTok</label>
                        <div class="flex items-center border rounded-md mt-1 focus-within:ring focus-within:border-black">
                            <i class="fab fa-tiktok text-black px-2"></i>
                            <input type="url" name="tiktok_link" placeholder="https://tiktok.com/@usuario"
                                class="w-full p-2 outline-none rounded-r-md"
                                value="{{ old('tiktok_link', auth()->user()->reference->tiktok_link ?? '') }}">
                        </div>
                    </div>

                    {{-- Imagen QR --}}
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen QR</label>
                        @if(!empty(auth()->user()->reference->qr_image))
                        <div class="mb-2">
                            <img src="{{ asset(auth()->user()->reference->qr_image) }}" alt="QR Image"
                                class="max-h-40 rounded-md shadow-md">
                        </div>
                        @endif
                        <input type="file" name="qr_image" accept="image/*"
                            class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="document.getElementById('editModalR').close()"
                        class="flex items-center gap-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit"
                        class="flex items-center gap-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-md">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </dialog>

        <!-- Modal: Editar Perfil -->
        <!-- Modal: Editar Perfil -->
        <dialog id="editModal" class="rounded-3xl p-0 max-w-xl w-full shadow-2xl backdrop:bg-black/40 z-50">
            <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-6 rounded-3xl space-y-6">
                @csrf
                @method('PUT')

                <!-- Título -->
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                    <i class="fas fa-user-edit text-green-600"></i> Editar Perfil
                </h2>

                <!-- Campos: grid responsive 2 columnas -->
                @php
                $fields = [
                ['name'=>'name','label'=>'Nombre','icon'=>'fa-user','required'=>true],
                ['name'=>'firstLastName','label'=>'Primer Apellido','icon'=>'fa-user','required'=>true],
                ['name'=>'secondLastName','label'=>'Segundo Apellido','icon'=>'fa-user','required'=>false],
                ['name'=>'username','label'=>'Usuario','icon'=>'fa-user-circle','required'=>true],
                ['name'=>'email','label'=>'Correo Electrónico','icon'=>'fa-envelope','required'=>true],
                ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($fields as $field)
                    <div class="relative group">
                        <i class="fas {{ $field['icon'] }} absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-green-600 transition-colors duration-300"></i>
                        <input type="{{ $field['name']=='email'?'email':'text' }}"
                            name="{{ $field['name'] }}"
                            value="{{ old($field['name'], auth()->user()->{$field['name']}) }}"
                            {{ $field['required'] ? 'required' : '' }}
                            placeholder=" "
                            class="peer w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-500 transition text-gray-800" />
                        <label class="absolute left-10 -top-2.5 text-gray-500 text-sm peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base transition-all duration-300">
                            {{ $field['label'] }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <!-- Acciones -->
                <div class="flex flex-col md:flex-row justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('editModal').close()"
                        class="flex items-center justify-center gap-2 px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl shadow transition duration-300">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg transition duration-300">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </dialog>



    </nav>

    <!-- Estructura principal -->
    <div id="layoutSidenav">
        <!-- Barra lateral -->
        <div id="layoutSidenav_nav" class="fixed top-0 left-0 h-screen w-64 bg-gray-800 text-white">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav pt-4">
                        <div class="sb-sidenav-menu-heading text-white">Menú Principal</div>

                        <a class="nav-link" href="/user/dashboard">
                            <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link text-white" href="/sales">
                            <div class="sb-nav-link-icon "><i class="fas fa-shopping-cart"></i></div>
                            Historial de Ventas
                        </a>

                        <a class="nav-link text-white" href="{{route('vista')}}">
                            <div class="sb-nav-link-icon text-white"><i class="fas fa-boxes"></i></div>
                            Gestión de Productos
                        </a>

                        <a class="nav-link" href="{{route('deployC')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Gestión de Comprobantes de Pago
                        </a>

                        <a class="nav-link" href="{{route('materiales.index')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-leaf"></i></div>
                            Materiales Compostables
                        </a>

                        <a class="nav-link" href="{{route('uplans.index')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Adquirir Planes
                        </a>

                        <a class="nav-link" href="{{route('select')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Gestión de Reportes
                        </a>

                        <div class="sb-sidenav-menu-heading text-white">Configuración</div>
                        <a class="nav-link" href="{{route('cambiarCU')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                            Cambiar Contraseña
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small text-white">Bienvenid@:</div>
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </nav>
        </div>



        @yield('content')



        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <script>
            // Toggle sidebar
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarToggle = document.getElementById('sidebarToggle');
                const layoutSidenav = document.getElementById('layoutSidenav_nav');
                const layoutSidenavContent = document.getElementById('layoutSidenav_content');
                const body = document.body;

                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (window.getComputedStyle(layoutSidenav).transform === 'matrix(1, 0, 0, 1, 0, 0)') {
                        layoutSidenav.style.transform = 'translateX(-225px)';
                        layoutSidenavContent.style.marginLeft = '0';
                    } else {
                        layoutSidenav.style.transform = 'translateX(0)';
                        layoutSidenavContent.style.marginLeft = '225px';
                    }
                });

                // Carrusel de imágenes
                const images = document.querySelectorAll('.hero-image');
                let currentIndex = 0;

                function changeImage() {
                    images.forEach(img => img.classList.remove('active'));
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].classList.add('active');
                }

                setInterval(changeImage, 5000);

                // Mapa
                var map = L.map('contenedor-del-mapa').setView([-17.3936, -66.1570], 10);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Restablecer mapa
                document.getElementById('restablecerBtn').addEventListener('click', function() {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('titulo');
                    url.searchParams.delete('categoria');
                    window.location.href = url.toString();
                });
            });
        </script>
</body>

</html>