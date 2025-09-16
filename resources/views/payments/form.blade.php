@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 max-w-2xl pt-28 pb-24">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold text-center text-primary mb-6 uppercase tracking-wide">
                Confirmación de Pago
            </h2>

            <div class="text-center mb-6">
    <p class="text-sm text-gray-600 mb-1">Producto seleccionado:</p>
    <p class="text-xl font-semibold text-gray-800">{{ $product->title }}</p>
    <form action="{{ route('payment.process', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-gray-50 p-6 rounded-xl shadow-inner border border-dashed border-gray-300">
                @csrf

    <div class="my-4">
        <label for="amount" class="block text-sm text-gray-700 mb-1">Selecciona cantidad:</label>
        <input type="number" name="amount" id="amount" min="1" value="{{ old('amount', 1) }}"
               class="border border-gray-300 rounded px-3 py-2 w-32 text-center focus:outline-none focus:ring focus:border-blue-300"
               required>
    </div>

    <p class="text-sm text-gray-500 mt-2">
        <strong>Tipo:</strong> {{ ucfirst($product->type) }} |
        <strong>Kg:</strong> {{ $product->amount }} kg |
        <strong>Precio:</strong> ${{ number_format($product->price, 2) }}
    </p>
</div>


            <div class="mb-8 text-center">
                <p class="text-base text-gray-700 mb-2">
                    Para completar tu compra, escanea el siguiente código QR y realiza el pago exacto.
                </p>
                <p class="text-lg font-semibold text-gray-800 mb-3">
                    Método de Pago: <span class="text-green-600">Código QR</span>
                </p>
                @if ($product->user && $product->user->reference && $product->user->reference->qr_image)
                    <img src="{{ asset($product->user->reference->qr_image) }}" alt="Código QR de Pago"
                        class="mx-auto w-64 h-64 object-contain border-2 border-gray-300 rounded-xl p-2 bg-white shadow-md">
                @else
                    <div class="text-red-500 font-semibold text-center mb-4">
                        ⚠️ Este vendedor aún no ha subido su código QR de pago.
                    </div>
                @endif

            </div>

            
                <div class="mb-4">
                    <label for="receipt" class="block mb-2 text-sm font-medium text-gray-700">
                        📎 Subir comprobante de pago
                    </label>
                    <input type="file" name="receipt" accept="image/*" required
                        class="block w-full text-sm text-gray-800 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-primary file:text-white file:py-2 file:px-4 file:rounded-lg file:text-sm file:font-semibold hover:file:bg-secondary transition">
                    <p class="text-xs text-gray-500 mt-1">Archivos permitidos: JPG, PNG | Tamaño máximo: 2MB</p>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-primary hover:bg-secondary text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                        Enviar Comprobante de Pago
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <a href="{{ url()->previous() }}"
                    class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition-all shadow-md">
                    ← Volver
                </a>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600">
                Una vez enviado el comprobante, tu pago será verificado manualmente.<br>
                Recibirás una constancia de tu compra en pantalla.
            </div>
        </div>
    </div>
@endsection
