@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 pt-24 pb-24">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Productos de {{ $usuario->name }}</h2>

        {{-- Productos del usuario --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
            @forelse ($productos as $producto)
                <div
                    class="card p-4 bg-white rounded-2xl shadow-lg h-full flex flex-col justify-between transition-transform hover:scale-105">
                    <!-- Imagen del producto -->
                    <div
                        class="w-full h-[220px] flex justify-center items-center border-2 border-gray-200 rounded-xl overflow-hidden bg-gray-50">
                        <img src="{{ asset($producto->image) }}" alt="{{ $producto->title }}"
                            class="object-contain h-full max-w-full">
                    </div>

                    <!-- Detalles del producto -->
                    <div class="mt-4 text-center flex-grow">
                        <h5 class="text-xl font-semibold text-gray-800 mb-1">{{ $producto->title }}</h5>
                        <p class="text-sm text-gray-600 capitalize mb-2">{{ str_replace('_', ' ', $producto->type) }}</p>
                        <p class="text-lg font-bold text-green-600 mb-1">${{ $producto->price }}</p>
                        <p class="text-sm text-gray-500 mb-2">
                            <i class="fas fa-map-marker-alt mr-1 text-red-500"></i>
                            {{ $producto->location->address ?? 'Ubicación no disponible' }}
                        </p>
                    </div>

                    <!-- Botón Comprar -->
                    <div class="mt-4">
                        <a href="{{ route('payment.form', $producto->id) }}"
                            class="block w-full bg-primary hover:bg-secondary text-white text-sm text-center font-medium py-3 px-4 rounded-xl transition duration-300 ease-in-out">
                            <i class="fas fa-shopping-cart mr-2"></i>Comprar
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3 text-gray-600">Este usuario no tiene productos disponibles.</p>
            @endforelse
        </div>

        {{-- Paginación --}}
        <div class="mt-8 flex justify-center">
            <nav role="navigation" aria-label="Pagination Navigation"
                class="inline-flex items-center space-x-2 text-sm font-medium">

                {{-- Botón anterior --}}
                @if ($productos->onFirstPage())
                    <span class="px-3 py-2 rounded-lg bg-gray-300 text-white cursor-not-allowed">
                        <i class="fas fa-angle-left mr-1"></i> Anterior
                    </span>
                @else
                    <a href="{{ $productos->previousPageUrl() }}"
                        class="px-3 py-2 rounded-lg bg-primary hover:bg-secondary text-white transition">
                        <i class="fas fa-angle-left mr-1"></i> Anterior
                    </a>
                @endif

                {{-- Números de página --}}
                @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="px-3 py-2 rounded-lg {{ $productos->currentPage() === $page ? 'bg-secondary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Botón siguiente --}}
                @if ($productos->hasMorePages())
                    <a href="{{ $productos->nextPageUrl() }}"
                        class="px-3 py-2 rounded-lg bg-primary hover:bg-secondary text-white transition">
                        Próximo <i class="fas fa-angle-right ml-1"></i>
                    </a>
                @else
                    <span class="px-3 py-2 rounded-lg bg-gray-300 text-white cursor-not-allowed">
                        Próximo <i class="fas fa-angle-right ml-1"></i>
                    </span>
                @endif
            </nav>
        </div>


        {{-- Información de contacto y redes sociales del usuario --}}
        @if ($usuario->reference)
            <div class="bg-white rounded-xl shadow-lg p-6 mt-12 text-center border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Información de Contacto</h3>

                @if ($usuario->reference->phone)
                    <p class="text-gray-700 mb-2">
                        <i class="fas fa-phone text-green-600 mr-2"></i>{{ $usuario->reference->phone }}
                    </p>
                @endif

                @if ($usuario->reference->contact_email)
                    <p class="text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>{{ $usuario->reference->contact_email }}
                    </p>
                @endif

                <div class="flex justify-center gap-4 mt-4 text-2xl">
                    @if ($usuario->reference->whatsapp_link)
                        <a href="{{ $usuario->reference->whatsapp_link }}" target="_blank"
                            class="text-green-600 hover:text-green-800">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if ($usuario->reference->facebook_link)
                        <a href="{{ $usuario->reference->facebook_link }}" target="_blank"
                            class="text-blue-700 hover:text-blue-900">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if ($usuario->reference->instagram_link)
                        <a href="{{ $usuario->reference->instagram_link }}" target="_blank"
                            class="text-pink-600 hover:text-pink-800">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($usuario->reference->youtube_link)
                        <a href="{{ $usuario->reference->youtube_link }}" target="_blank"
                            class="text-red-600 hover:text-red-800">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                    @if ($usuario->reference->tiktok_link)
                        <a href="{{ $usuario->reference->tiktok_link }}" target="_blank"
                            class="text-black hover:text-gray-700">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- Botón flotante de WhatsApp si existe --}}
    @if ($usuario->reference && $usuario->reference->whatsapp_link)
        <a href="{{ $usuario->reference->whatsapp_link }}"
            class="fixed bottom-5 right-5 w-14 h-14 bg-green-500 text-white rounded-full shadow-lg flex items-center justify-center text-2xl hover:bg-green-600 transition"
            target="_blank" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif

    {{-- Iconos flotantes a la izquierda --}}
    @if ($usuario->reference)
        <div class="fixed top-1/3 left-0 z-50 flex flex-col items-center space-y-2 pl-1">
            @if ($usuario->reference->whatsapp_link)
                <a href="{{ $usuario->reference->whatsapp_link }}" target="_blank"
                    class="bg-green-500 text-white w-10 h-10 flex items-center justify-center rounded-r hover:bg-green-600 transition"
                    title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            @endif
            @if ($usuario->reference->instagram_link)
                <a href="{{ $usuario->reference->instagram_link }}" target="_blank"
                    class="bg-pink-500 text-white w-10 h-10 flex items-center justify-center rounded-r hover:bg-pink-600 transition"
                    title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            @endif
            @if ($usuario->reference->youtube_link)
                <a href="{{ $usuario->reference->youtube_link }}" target="_blank"
                    class="bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-r hover:bg-red-700 transition"
                    title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            @endif
            @if ($usuario->reference->facebook_link)
                <a href="{{ $usuario->reference->facebook_link }}" target="_blank"
                    class="bg-blue-600 text-white w-10 h-10 flex items-center justify-center rounded-r hover:bg-blue-700 transition"
                    title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            @endif
            @if ($usuario->reference->tiktok_link)
                <a href="{{ $usuario->reference->tiktok_link }}" target="_blank"
                    class="bg-black text-white w-10 h-10 flex items-center justify-center rounded-r hover:bg-gray-800 transition"
                    title="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            @endif
        </div>
    @endif
@endsection
