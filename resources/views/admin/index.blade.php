@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

<h1 class = " text-5xl text-center pt-24">Bienvenido {{auth()->user()->name}}</h1>

@endsection