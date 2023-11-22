@extends('layouts.admin')

@section('title', 'Crear')

@section('content')
<!--<nav class="h6-16 flex justify-end py-4 px-16">
    <a href="{{route('productos.index')}}" class="border border-blue-500 
    rounded px-4 pt-1 h-10 bg-white text-blue-500 font-semibold mx-2">Productos</a>
    <a href="{{route('productos.create')}}" class="text-white rounded px-4 pt-1 h-10 bg-blue-500 
    font-semibold mx-2 hover:bg-blue-600">Crear</a>
    </nav>-->
<main class="p-16 flex justify-center">
<form action="{{route('productos.store')}}" method="POST" class="bg-white w-1/3 p-4 border-gray-100 shadow-xl rounded-lg" enctype="multipart/form-data">
@csrf
<h2 class="text-2xl text-center py-4 mb-4 font-semibold">Crear Productos</h2>
<input class="form-control mb-2 " placeholder="Nombre" name="nombre">
<input class="form-control mb-2" placeholder="Categoria" name="categoria">
<input class="form-control mb-2" placeholder="Precio" name="precio">
<input class="form-control mb-2" type="file" id="formFile" name="imagen">
<input class="form-control mb-2" placeholder="Descripcion" name="descripcion">
<button type="submit" class="my-3 w-full bg-blue-500 p-2 font-semibold rounded text-white hover:bg-blue-600">Guardar</button>
</form>
</main>


@endsection