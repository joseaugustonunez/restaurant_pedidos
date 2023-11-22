@extends('layouts.admin')

@section('title', 'Clientes')

@section('mostrar')

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <div class="m-5">

    <table class="table table-hover">
      <thead>
        <tr >
          <th >ID</th>
          <th >Nombre</th>
          <th >Correo</th>
          <th>Rol</th>
          <th >Creación</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($user as $row)
            
    
        <tr>
          <td >{{ $row->id}}</td>
          <td >{{ $row->name}}</td>
          <td >{{ $row->email}}</td>
          <td >{{ $row->role}}</td>
          <td >{{ $row->created_at}}</td>
          <td >
          </td>
        </tr>
     
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>
@endsection