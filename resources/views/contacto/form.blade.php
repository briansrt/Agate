<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Contacto</h1>

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
        <input class="form-input" type="text" name="nombre" id="nombre" value="{{ isset($contacto->nombre)?$contacto->nombre:old('nombre') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="apellido">Apellido</label>
        <input class="form-input" type="text" name="apellido" id="apellido" value="{{ isset($contacto->apellido)?$contacto->apellido:old('apellido') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="direccion">Direccion</label>
        <input class="form-input" type="text" name="direccion" id="direccion" value="{{ isset($contacto->direccion)?$contacto->direccion:old('direccion') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="celular">Celular</label>
        <input class="form-input" type="text" name="celular" id="celular" value="{{ isset($contacto->celular)?$contacto->celular:old('celular') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('contacto/') }}">Regresar</a>
    </div>
</div>