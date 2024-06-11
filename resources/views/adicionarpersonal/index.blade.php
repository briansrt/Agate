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
        <a class="btn btn-success" href="{{ url('adicionarpersonal/create') }}">Adicionar Personal a Campaña</a>
    </div>
    <br>
    <br>
    
    <table class="table table-striped">
        <thead class="table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Campaña</th>
                <th scope="col">Contacto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adicionarpersonals as $adicionarpersonal)
                <tr>
                    <td>{{ $adicionarpersonal->codigoadicionarpersonal }}</td>
                    <td>{{ $adicionarpersonal->codigocliente }}</td>
                    <td>{{ $adicionarpersonal->codigocampana }}</td>
                    <td>{{ $adicionarpersonal->codigocontacto }}</td>
                    <td>
                        <a href="{{ url('/adicionarpersonal/'.  $adicionarpersonal->codigoadicionarpersonal .'/edit') }}" class="btn btn-warning">Editar</a>
    
                        <form action="{{ url('/adicionarpersonal/'.$adicionarpersonal->codigoadicionarpersonal) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres borrarlo?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $adicionarpersonals -> links() !!}
</div>
</div>
@endsection