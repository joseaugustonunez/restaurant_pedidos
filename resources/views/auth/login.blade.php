@extends('layouts.header')

@section('title', 'Login')

@section('content')
<div class="block mx-auto my-12 p-8 bg-white w-1/3 border
 border-gray-200 rounded-lg shadow-lg">
<h1 class = " text-5xl text-center font-bold">Login</h1>

<form class="mt-4" method="POST" action="">

    @csrf

    <input type="email" class="form-control mb-2 " placeholder="Correo Electronico" id="email" name="email">
    <input type="password" class="form-control mb-3 " placeholder="Contraseña" id="password" name="password">

    @error('message')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{$message}}</p>
   @enderror
    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
    <p>¿No tienes cuenta? <a class="link-opacity-50" href="{{ route('register.index')}}">Registrarse</a></p>
    <p>¿Olvidaste tu Contraseña? <a class="link-opacity-50" href="">Recuperar</a></p>
</form>
</div>

@endsection
