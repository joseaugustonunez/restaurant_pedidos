@extends('layouts.header')

@section('title', 'Contacto')

@section('content')
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>Contactarse</h2>
        </div>
        <div class="card border-dark mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('images/o2.jpg') }}" class="img-fluid rounded-start" alt="Imagen">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="{{ route('mensaje.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Ingresar Comentario</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

