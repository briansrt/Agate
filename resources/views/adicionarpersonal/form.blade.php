<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Personal</h1>

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
                <option value="{{ $cliente->codigocliente }}" {{(isset($adicionarpersonal->codigocliente) && $adicionarpersonal->codigocliente == $cliente->codigocliente) || old('codigocliente') == $cliente->codigocliente ? 'selected': ''}}> {{ $cliente->nombre }} {{$cliente->apellido}}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigocampana">Campaña:</label>
        <select name="codigocampana" id="codigocampana">
            <option value="">Seleccione un Cliente</option>
            @if(old('codigocliente') || (isset($adicionarpersonal) && $adicionarpersonal->codigocliente))
                @foreach($campañas as $campaña)
                    @if($campaña->codigocliente == old('codigocliente') || (isset($adicionarpersonal) && $campaña->codigocliente == $adicionarpersonal->codigocliente))
                        <option value="{{ $campaña->codigocampana }}" {{ (old('codigocampana') == $campaña->codigocampana || (isset($adicionarpersonal) && $adicionarpersonal->codigocampana == $campaña->codigocampana)) ? 'selected' : '' }}> {{$campaña->descripcion}}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigocontacto">Contacto:</label>
        <select name="codigocontacto" id="codigocontacto">
            <option value="">Selecciona el Contacto</option>
            @foreach($contactos as $contacto)
                <option value="{{ $contacto->codigocontacto }}" {{(isset($adicionarpersonal->codigocontacto) && $adicionarpersonal->codigocontacto == $contacto->codigocontacto) || old('codigocontacto') == $contacto->codigocontacto ? 'selected': ''}}>{{ $contacto->nombre }} {{ $contacto->apellido }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('adicionarpersonal/') }}">Regresar</a>
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
                        var CampañaSeleccionada = "{{ old('codigocampana', isset($adicionarpersonal) ? $adicionarpersonal->codigocampana : '') }}";
                            $('#codigocampana').val(CampañaSeleccionada);
                    }
                });
            } else {
                $('#codigocampana').empty();
                $('#codigocampana').append('<option value="">Seleccione un Cliente</option>');
            }
        });
        var clienteSeleccionado = "{{ old('codigocliente', isset($adicionarpersonal) ? $adicionarpersonal->codigocliente : '') }}";
            if (clienteSeleccionado) {
                $('#codigocliente').val(clienteSeleccionado).trigger('change');
            }
    });
</script>