<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Anuncio</h1>

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
                <option value="{{ $cliente->codigocliente }}" {{(isset($anuncio->codigocliente) && $anuncio->codigocliente == $cliente->codigocliente) || old('codigocliente') == $cliente->codigocliente ? 'selected': ''}}> {{ $cliente->nombre }} {{$cliente->apellido}}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigocampana">Campaña:</label>
        <select name="codigocampana" id="codigocampana">
            <option value="">Seleccione un Cliente</option>
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigotiposanuncio">Tipo Anuncio:</label>
        <select name="codigotiposanuncio" id="codigotiposanuncio">
            <option value="">Selecciona el Tipo Anuncio</option>
            @foreach($tiposanuncios as $tiposanuncio)
                <option value="{{ $tiposanuncio->codigotiposanuncio }}" {{(isset($anuncio->codigotiposanuncio) && $anuncio->codigotiposanuncio == $tiposanuncio->codigotiposanuncio) || old('codigotiposanuncio') == $tiposanuncio->codigotiposanuncio ? 'selected': ''}}>{{ $tiposanuncio->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="descripcion">Descripcion</label>
        <input class="form-input" type="text" name="descripcion" id="descripcion" value="{{ isset($campaña->descripcion)?$campaña->descripcion:old('descripcion') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="fechainicio">Fecha Inicio</label>
        <input class="form-input" type="date" name="fechainicio" id="fechainicio" value="{{ isset($campaña->fechainicio)?$campaña->fechainicio:old('fechainicio') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="fechafin">Fecha Fin</label>
        <input class="form-input" type="date" name="fechafin" id="fechafin" value="{{ isset($campaña->fechafin)?$campaña->fechafin:old('fechafin') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="valor">Valor</label>
        <input class="form-input" type="text" name="valor" id="valor" value="{{ isset($campaña->presupuesto)?$campaña->presupuesto:old('presupuesto') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('anuncio/') }}">Regresar</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#codigocliente').change(function() {
            var codigocliente = $(this).val();
            if (codigocliente) {
                $.ajax({
                    url: '/agate/public/CampañaPorCliente/' + codigocliente,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#codigocampana').empty();
                        $('#codigocampana').append('<option value="">Seleccione una campaña</option>');
                        $.each(data, function(key, value) {
                            $('#codigocampana').append('<option value="' + value.codigocampana + '">' + value.descripcion + '</option>');
                        });
                    }
                });
            } else {
                $('#codigocampana').empty();
                $('#codigocampana').append('<option value="">Seleccione un Cliente</option>');
            }
        });
    });
</script>