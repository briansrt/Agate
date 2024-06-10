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
        <a class="btn btn-success" href="{{ url('campaña/create') }}">Registrar Nueva Campaña</a>
    </div>
    <br>
    <br>
    
    <table class="table table-striped">
        <thead class="table-bordered">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">descripcion</th>
                <th scope="col">Presupuesto</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campañas as $campaña)
                <tr>
                    <td>{{ $campaña->codigocampana }}</td>
                    <td>{{ $campaña->codigocliente }}</td>
                    <td>{{ $campaña->descripcion }}</td>
                    <td>{{ $campaña->presupuesto }}</td>
                    <td>{{ $campaña->fechainicio }}</td>
                    <td>{{ $campaña->fechafin }}</td>
                    <td>
                        <a href="{{ url('/campaña/'.  $campaña->codigocampana .'/edit') }}" class="btn btn-warning">Editar</a>
    
                        <form action="{{ url('/campaña/'.$campaña->codigocampana) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres borrarlo?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $campañas -> links() !!}
</div>
</div>
@endsection