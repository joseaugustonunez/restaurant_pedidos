
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LARAVEL APP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
    <link rel="shortcut icon" href="{{asset('/images/favicon.png')}}" type="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-gray-100 text-gray-800">
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Panel de Administrador</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Inicio</a>
          </li>
      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{route("productos.create")}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Productos
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route("productos.create")}}">Crear</a></li>
              <li><a class="dropdown-item" href="{{route("productos.index")}}">Ver Productos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{route("productos.create")}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Mesas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route("mesas.create")}}">Crear</a></li>
              <li><a class="dropdown-item" href="{{route("mesas.index")}}">Ver Mesas</a></li>
            </ul>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{route("orden.realizado")}}">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{route("usuario.index")}}">Clientes</a>
          </li>
           </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{route("mensaje.index")}}">Comentarios</a>
          </li>
          </li>       
        </ul>
      
      </div>
    </div>
    <div class=" d-grid gap-2 d-md-flex justify-content-md-end">
      <div class="mx-auto p-2" style="width: 300px;">
      <p style="color: white;">Bienvenido <b>{{auth()->user()->name}}</b></p>
      </div>
      <div class="mw-200 " style="width: 100%;">
      <a href="{{ route('login.destroy')}}" class="btn btn-outline-danger" > Cerrar Sesion</a>
      </div>
    </div>
  </nav>
  
  @yield('content')
  @yield('mostrar')
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>