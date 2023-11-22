@extends('layouts.admin')

@section('title', 'Editar')

@section('content')
<main class="p-16 flex justify-center">
<form action="{{route('productos.update', $producto->id)}}" method="POST" class="bg-white w-1/3 p-4 border-gray-100 shadow-xl rounded-lg" enctype="multipart/form-data">
@csrf
@method('put')
<h2 class="text-2xl text-center py-4 mb-4 font-semibold">Editar Productos{{$producto->id}}</h2>
<input  class="form-control mb-2 " placeholder="Titulo" name="nombre" value="{{$producto->nombre}}">
<input  class="form-control mb-2 " placeholder="Country" name="categoria" value="{{$producto->categoria}}">
<input  class="form-control mb-2 " placeholder="Price" name="Precio" value="{{$producto->precio}}">
<input class="form-control" type="file" id="formFile" name="imagen" value="{{$producto->imagen}}">
<input  class="form-control mb-2 " placeholder="Price" name="descripcion" value="{{$producto->descripcion}}">
<button type="submit" class="my-3 w-full bg-blue-500 p-2 font-semibold rounded text-white hover:bg-blue-600">Guardar</button>
</form>
</main>
@endsection