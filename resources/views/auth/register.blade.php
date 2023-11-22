@extends('layouts.header')

@section('title', 'Register')

@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-1/3 border
 border-gray-200 rounded-lg shadow-lg">
<h1 class = " text-5xl text-center font-bold">Registrar</h1>

<form class="mt-4" method="POST" action="">

    @csrf

    <input type="text" class="form-control mb-2" placeholder="Nombres y Apellidos" id="name" name="name">

    @error('name')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{$message}}</p>
    @enderror

    <input type="email" class="form-control mb-2" placeholder="Correo Electronico" id="email" name="email">
    @error('email')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{$message}}</p>
    @enderror
    <input type="password" class="form-control mb-2" placeholder="Contraseña" id="password" name="password">
    @error('password')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{$message}}</p>
    @enderror
    <input type="password" class="form-control mb-3" placeholder="Confirmacion de Contraseña" id="password_confirmation" name="password_confirmation">
  
    <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
</form>
</div>

@endsection
