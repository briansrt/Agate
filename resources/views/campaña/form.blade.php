<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Campaña</h1>

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
        <label class="form-label" for="codigocliente">Cliente:</label>
        <select name="codigocliente" id="codigocliente">
            <option value="">Selecciona un Cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->codigocliente }}" {{(isset($campaña->codigocliente) && $campaña->codigocliente == $cliente->codigocliente) || old('codigocliente') == $cliente->codigocliente ? 'selected': ''}}> {{ $cliente->nombre }} {{$cliente->apellido}}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigocontacto">Contacto:</label>
        <select name="codigocontacto" id="codigocontacto">
            <option value="">Selecciona un Contacto</option>
            @foreach($contactos as $contacto)
                <option value="{{ $contacto->codigocontacto }}" {{(isset($campaña->codigocontacto) && $campaña->codigocontacto == $contacto->codigocontacto) || old('codigocontacto') == $contacto->codigocontacto ? 'selected': ''}}>{{ $contacto->nombre }} {{$contacto->apellido}}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="descripcion">Descripcion</label>
        <input class="form-input" type="text" name="descripcion" id="descripcion" value="{{ isset($campaña->descripcion)?$campaña->descripcion:old('descripcion') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="presupuesto">Presupuesto</label>
        <input class="form-input" type="text" name="presupuesto" id="presupuesto" value="{{ isset($campaña->presupuesto)?$campaña->presupuesto:old('presupuesto') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="fechainicio">Fecha Inicio</label>
        <input class="form-input" type="date" name="fechainicio" id="fechainicio" value="{{ isset($campaña->fechainicio)?$campaña->fechainicio:old('fechainicio') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="fechafin">Fecha Fin</label>
        <input class="form-input" type="date" name="fechafin" id="fechafin" value="{{ isset($campaña->fechafin)?$campaña->fechafin:old('fechafin') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('campaña/') }}">Regresar</a>
    </div>
</div>
