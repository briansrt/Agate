<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Tipo de Anuncio</h1>

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
        <input class="form-input" type="text" name="nombre" id="nombre" value="{{ isset($tiposanuncio->nombre)?$tiposanuncio->nombre:old('nombre') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('tiposanuncio/') }}">Regresar</a>
    </div>
</div>