@extends('layouts.admin')

@section('title', 'Pedidos')


@section('content')

<section class="food_section layout_padding">
  <div class="container">
    </br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach($ordenes as $orden)
        <div class="col">
          <div class="card border-warning  h-100">
            <div class="card-body">
              <h3>Detalles de la Orden</h3>

              <p>ID de la Orden: {{ $orden->id }}</p>
              <p>Usuario : {{ $orden->usuario->name }}</p>
              <p>Numero de mesa: {{ $orden->mesa->nombre }}</p>
              <!-- Mostrar otras propiedades de la orden según sea necesario -->

              <!-- Iterar sobre los productos en el carrito -->
              <h3>Productos en el Carrito:</h3>
              <ul>
                @foreach(json_decode($orden->carrito, true) as $producto)
                  <li>{{ $producto['nombre'] }} - Cantidad: {{ $producto['cantidad'] }}</li>
                @endforeach
              </ul>

              <p>Total: S/{{ $orden->cantidad }}</p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">{{ $orden->created_at }}</small>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>


@endsection