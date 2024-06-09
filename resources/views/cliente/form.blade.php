<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Cliente</h1>

    @if(count($errors)>0)
        <div class="alert alert-danger w-50" role="alert">
            <ul>
                @foreach($errors-> all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex flex-column w-100">
        <label class="form-label" for="nombre">Nombre</label>
        <input class="form-input" type="text" name="nombre" id="nombre" value="{{ isset($cliente->nombre)?$cliente->nombre:old('nombre') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="apellido">Apellido</label>
        <input class="form-input" type="text" name="apellido" id="apellido" value="{{ isset($cliente->apellido)?$cliente->apellido:old('apellido') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="direccion">Direccion</label>
        <input class="form-input" type="text" name="direccion" id="direccion" value="{{ isset($cliente->direccion)?$cliente->direccion:old('direccion') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="celular">Celular</label>
        <input class="form-input" type="text" name="celular" id="celular" value="{{ isset($cliente->celular)?$cliente->celular:old('celular') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('cliente/') }}">Regresar</a>
    </div>
</div>
