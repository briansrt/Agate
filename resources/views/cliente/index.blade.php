

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
        <a class="btn btn-success" href="{{ url('cliente/create') }}">Registrar Nuevo Cliente</a>
    </div>
    <br>
    <br>
    
    <table class="table table-striped">
        <thead class="table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Celular</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->codigocliente }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellido }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->celular }}</td>
                    <td>
                        <a href="{{ url('/cliente/'.  $cliente->codigocliente .'/edit') }}" class="btn btn-warning">Editar</a>
    
                        <form action="{{ url('/cliente/'.$cliente->codigocliente) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres borrarlo?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $clientes -> links() !!}
</div>
</div>
@endsection