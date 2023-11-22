@extends('layouts.admin')

@section('title', 'Home')

@section('mostrar')

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="m-5">

    <table class="table table-hover">
      <thead>
        <tr >
          <th >ID</th>
          <th >Nombre</th>
          <th >Categoria</th>
          <th >Precio</th>
          <th >Imagen</th>
          <th >Descripcion</th>
          <th >Created</th>
          <th >Updated</th>
          <th >Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productos as $row)
            
    
        <tr>
          <td >{{ $row->id}}</td>
          <td >{{ $row->nombre}}</td>
          <td >{{ $row->categoria}}</td>
          <td >{{ $row->precio}}</td>
          <td >
            <img src="{{asset($row->imagen)}}" alt="{{ $row->nombre}}" class="img-fluid" width="120px">
          </td>
          <td >{{ $row->descripcion}}</td>
          <td >{{ $row->created_at}}</td>
          <td >{{ $row->updated_at}}</td>
          <td >
            <div class="d-grid gap-2 col-6 mx-auto">
         <form action="{{ route('productos.destroy', $row->id)}}" method="POST">
           @csrf
           @method('delete')
           <button class="btn btn-outline-danger" >
            eliminar</button>
        </form>
            <a href="{{ route('productos.edit', $row->id)}}" class="btn btn-outline-success">Editar</a>
          </div>
          </td>
        </tr>
     
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>
@endsection