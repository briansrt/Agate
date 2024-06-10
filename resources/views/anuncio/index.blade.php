@extends('layouts.app')
@section('content')
<div class="container">
<div class="d-flex flex-column justify-content-center align-items-center h-100 p-3">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div>
        <a class="btn btn-success" href="{{ url('anuncio/create') }}">Registrar Nuevo Anuncio</a>
    </div>
    <br>
    <br>
    
    <table class="table table-striped">
        <thead class="table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Tipo Anuncio</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Valor</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anuncios as $anuncio)
                <tr>
                    <td>{{ $anuncio->codigoanuncio }}</td>
                    <td>{{ $anuncio->codigocliente }}</td>
                    <td>{{ $anuncio->codigotiposanuncio }}</td>
                    <td>{{ $anuncio->fechainicio }}</td>
                    <td>{{ $anuncio->fechafin }}</td>
                    <td>{{ $anuncio->valor }}</td>
                    <td>
                        <a href="{{ url('/anuncio/'.  $anuncio->codigoanuncio .'/edit') }}" class="btn btn-warning">Editar</a>
    
                        <form action="{{ url('/anuncio/'.$anuncio->codigoanuncio) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres borrarlo?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $anuncios -> links() !!}
</div>
</div>
@endsection