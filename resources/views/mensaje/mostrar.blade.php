@extends('layouts.admin')

@section('title', 'Mensajes')

@section('content')
<section class="food_section layout_padding">
  <div class="container">
  </br>
  <div class="row row-cols-1 row-cols-md-3 g-4"> 
      @foreach ($mensaje as $row)
      <div class="col">
        <div class="card border-dark h-100">
          <div class="card-body">
            <h5 class="card-title">{{ $row->usuario->name}}</h5>
            <p class="card-text"> {{ $row->mensaje}}</p>
            <form action="{{ route('mensaje.destroy', $row->id)}}" method="POST">
              @csrf
              @method('delete')
              <button class="btn btn-outline-danger" >
               eliminar</button>
           </form>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">{{ $row->created_at}}</small>
          </div>
        </div>
      </div>
      @endforeach
    </div>
      
  </div>
</section>
@endsection