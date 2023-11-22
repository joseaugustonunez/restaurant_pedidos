@extends('layouts.admin')

@section('title', 'Mesas')

@section('content')
<main class="p-16 flex justify-center">
    <form action="{{ route('mesas.store') }}" method="POST" class="bg-white w-1/3 p-4 border-gray-100 shadow-xl rounded-lg" enctype="multipart/form-data">
        @csrf
        <h2 class="text-2xl text-center py-4 mb-4 font-semibold">Crear Mesas</h2>
        <div class="mb-2">
            <label for="codigo" class="block text-sm font-medium text-gray-700">Codigo</label>
            <input type="number" class="form-control" placeholder="Codigo" name="codigo" id="codigo">
        </div>
        <div class="mb-2">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre">
        </div>
        <div class="mb-2">
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select class="form-select" aria-label="Default select example" name="estado" id="estado">
                <option value="disponible" selected>Disponible</option>
                <option value="ocupado">Ocupado</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="estado" class="block text-sm font-medium text-gray-700">Capacidad</label>
            <input type="number" class="form-control mb-2" name="capacidad" min="1">
        </div>
        <div class="mb-4">
            <label for="qrcode" class="block text-sm font-medium text-gray-700">Código QR</label>
            <div id="qrcode"></div>
            <input type="hidden" name="qr" id="qr">
        </div>

        <button type="submit" class="my-3 w-full bg-blue-500 p-2 font-semibold rounded text-white hover:bg-blue-600">Guardar</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const codigoInput = document.getElementById("codigo");
        const nombreInput = document.getElementById("nombre");
        const qrcodeElement = document.getElementById("qrcode");
        const codigoQRInput = document.getElementById("qr");

        codigoInput.addEventListener("input", function () {
            const valorNombre = codigoInput.value;

            // Limpia el contenido anterior del elemento qrcode
            qrcodeElement.innerHTML = '';

            if (valorNombre) {
                // Genera el código QR con el valor del campo "nombre"
                const qrcode = new QRCode(qrcodeElement, {
                    text: valorNombre,
                    width: 128,
                    height: 128
                });

                // Actualiza el campo oculto con el valor del código QR
                codigoQRInput.value = qrcodeElement.querySelector('img').src;
            }
        });
    });
</script>
@endsection