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
        <a class="btn btn-success" href="{{ url('tiposanuncio/create') }}">Registrar Nuevo Tipo Anuncio</a>
    </div>
    <br>
    <br>
    
    <table class="table table-striped">
        <thead class="table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiposanuncios as $tiposanuncio)
                <tr>
                    <td>{{ $tiposanuncio->codigotiposanuncio }}</td>
                    <td>{{ $tiposanuncio->nombre }}</td>
                    <td>
                        <a href="{{ url('/tiposanuncio/'.  $tiposanuncio->codigotiposanuncio .'/edit') }}" class="btn btn-warning">Editar</a>
    
                        <form action="{{ url('/tiposanuncio/'.$tiposanuncio->codigotiposanuncio) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres borrarlo?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $tiposanuncios -> links() !!}
</div>
</div>
@endsection