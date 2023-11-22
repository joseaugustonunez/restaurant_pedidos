@extends('layouts.header')

@section('content')
<style>
    .btn-container {
        display: flex;
        align-items: center;
    }

    .btn-container svg {
        width: 24px;
        height: 24px;
        margin-right: 8px; /* Opcional: para agregar un espacio entre el icono y el texto */
    }
</style>
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Nombre</th>
            <th style="width:10%">Precio</th>
            <th style="width:8%">Cantidad</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $detalles)
                @php $total += $detalles['precio'] * $detalles['cantidad'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $detalles['imagen'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $detalles['nombre'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">S/{{ $detalles['precio'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $detalles['cantidad'] }}" class="form-control quantity cart_update" min="1" />
                    </td>
                    <td data-th="Subtotal" class="text-center subtotal">S/{{ $detalles['precio'] * $detalles['cantidad'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Eliminar</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align:right;"><h3><strong>Total: <span id="total">S/{{ $total }}</span></strong></h3></td>
        </tr>
        <tr>
            <td colspan="5">
                <label>Mesa : <button type="button" class="btn btn-outline-warning" disabled><span id="mesaEscaneada"></span></button></label>
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ url('/qrcode') }}" class="btn btn-warning">
                    <div class="btn-container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 80C0 53.5 21.5 32 48 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80zM64 96v64h64V96H64zM0 336c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336zm64 16v64h64V352H64zM304 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H304c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48zm80 64H320v64h64V96zM256 304c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16v96c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16v64c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V304zM368 480a16 16 0 1 1 0-32 16 16 0 1 1 0 32zm64 0a16 16 0 1 1 0-32 16 16 0 1 1 0 32z"/></svg>
                        <span>Seleccionar Mesa</span>
                    </div>
                </a>
            </td>
            <td colspan="5" style="text-align:right;">
                <form action="{{ url('/session') }}" method="POST" id="checkout-form">
                    <a href="{{ url('/mostrar') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continuar Comprando</a>
                    <input type="hidden" name="cart" value="{{ json_encode(session('cart')) }}">
                    @csrf
                   
                    <!-- Campo oculto para almacenar el número de mesa -->
                    <input type="hidden" name="mesa_id" id="mesa_id" value="">
                    <button class="btn btn-success" type="submit" id="checkout-live-button"  onclick="return validarMesaEscaneada();"><i class="fa fa-money"></i> Guardar Compra</button>
                </form>
            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".cart_update").change(function (e) {
        e.preventDefault();
    
        var ele = $(this);
    
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                cantidad: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
    
    $(".cart_remove").click(function (e) {
        e.preventDefault();
    
        var ele = $(this);
    
        if(confirm("¿Realmente quieres eliminar?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    // Llamar a la función después de cargar el documento
    $(document).ready(function () {
        procesarMesaDesdeURL();
    });

    function procesarMesaDesdeURL() {
        var urlParams = new URLSearchParams(window.location.search);
        var mesaNombre = urlParams.get('mesa');
        console.log('Nombre de la mesa escaneada:', mesaNombre);

        if (mesaNombre) {
            $("#mesaEscaneada").text(mesaNombre);

            // Verificar que el nombre de la mesa no esté vacío
            if (mesaNombre.trim() !== '') {
                // Asignar el nombre de la mesa directamente al campo oculto
                $("#mesa_id").val(mesaNombre);

                // Mostrar el nombre de la mesa escaneada al lado de "Mesa"
                $("#nombreMesaEscaneada").text("Mesa: " + mesaNombre);
            } else {
                console.error("El nombre de la mesa escaneada está vacío.");
                alert("El nombre de la mesa escaneada está vacío.");
            }
        }
    }
    function validarMesaEscaneada() {
        var mesa_id = $("#mesa_id").val();

        if (mesa_id.trim() === '') {
            alert('Por favor, escanea una mesa antes de guardar la compra.');
            return false; // Evitar que el formulario se envíe
        }

        // Si el campo mesa_id tiene un valor, permitir que el formulario se envíe
        return true;
    }
</script>
@endsection
