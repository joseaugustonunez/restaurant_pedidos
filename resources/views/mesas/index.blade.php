@extends('layouts.admin')

@section('title', 'Mesas')

@section('mostrar')

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="m-5">

    <table class="table table-hover">
      <thead>
        <tr >
          <th >ID</th>
          <th >Codigo</th>
          <th >Nombre</th>
          <th >Estado</th>
          <th >Capacidad</th>
          <th >QR</th>
          <th >Created</th>
          <th >Updated</th>
          <th >Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($mesas as $row)
            
    
        <tr>
          <td >{{ $row->id}}</td>
          <td >{{ $row->codigo}}</td>
          <td >{{ $row->nombre}}</td>
          <td >{{ $row->estado}}</td>
          <td >{{ $row->capacidad}}</td>
          <td >
            <img src="{{ asset($row->qr) }}" alt="{{ $row->nombre}}" class="img-fluid" width="120px">
          </td>
          <td >{{ $row->created_at}}</td>
          <td >{{ $row->updated_at}}</td>
          <td >
            <div class="d-grid gap-2 col-6 mx-auto">
         <form action="{{ route('mesas.destroy', $row->id)}}" method="POST">
           @csrf
           @method('delete')
           <button class="btn btn-outline-danger" >
            eliminar</button>
        </form>
          <a href="{{ route('descargar.qr', $row->id) }}" class="btn btn-outline-success" download>
              Descargar
          </a>
          </div>
          </td>
        </tr>
     
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>
@endsection