<div class="form-control p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>{{$modo}} Nota Anuncio</h1>

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
                <option value="{{ $cliente->codigocliente }}" {{(old('codigocliente') == $cliente->codigocliente || (isset($adicionarnota) && $adicionarnota->codigocliente == $cliente->codigocliente)) ? 'selected': ''}}> {{ $cliente->nombre }} {{$cliente->apellido}}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigocampana">Campaña:</label>
        <select name="codigocampana" id="codigocampana">
            <option value="">Seleccione un Cliente</option>
            @if(old('codigocliente') || (isset($adicionarnota) && $adicionarnota->codigocliente))
                @foreach($campañas as $campaña)
                    @if($campaña->codigocliente == old('codigocliente') || (isset($adicionarnota) && $campaña->codigocliente == $adicionarnota->codigocliente))
                        <option value="{{ $campaña->codigocampana }}" {{ (old('codigocampana') == $campaña->codigocampana || (isset($adicionarnota) && $adicionarnota->codigocampana == $campaña->codigocampana)) ? 'selected' : '' }}> {{$campaña->descripcion}}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="codigoanuncio">Anuncio:</label>
        <select name="codigoanuncio" id="codigoanuncio">
            <option value="">Seleccione una Campaña</option>
            @if(old('codigocampana') || (isset($adicionarnota) && $adicionarnota->codigocampana))
                @foreach($anuncios as $anuncio)
                    @if($anuncio->codigocampana == old('codigocampana') || (isset($adicionarnota) && $anuncio->codigocampana == $adicionarnota->codigocampana))
                        <option value="{{ $anuncio->codigoanuncio }}" {{ (old('codigoanuncio') == $anuncio->codigoanuncio || (isset($adicionarnota) && $adicionarnota->codigoanuncio == $anuncio->codigoanuncio)) ? 'selected' : '' }}> {{$anuncio->descripcion}}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="fecha">Fecha:</label>
        <input class="form-input" type="date" name="fecha" id="fecha" value="{{ isset($adicionarnota->fecha)?$adicionarnota->fecha:old('fecha') }}">
    </div>
    <div class="d-flex flex-column w-100">
        <label class="form-label" for="nota">Nota:</label>
        <input class="form-input" type="text" name="nota" id="nota" value="{{ isset($adicionarnota->nota)?$adicionarnota->nota:old('nota') }}">
    </div>
    <div class="mt-5">
        <input class="btn btn-success" type="submit" value="{{$modo}} datos">
        <a class="btn btn-primary" href="{{ url('adicionarnota/') }}">Regresar</a>
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
                        var CampañaSeleccionada = "{{ old('codigocampana', isset($adicionarnota) ? $adicionarnota->codigocampana : '') }}";
                            $('#codigocampana').val(CampañaSeleccionada).trigger('change');
                    }
                });
            } else {
                $('#codigocampana').empty();
                $('#codigocampana').append('<option value="">Seleccione un Cliente</option>');
            }
            $('#codigoanuncio').empty();
            $('#codigoanuncio').append('<option value="">Seleccione una Campaña</option>');
        });
        $('#codigocampana').change(function() {
                var codigocampana = $(this).val();
                if (codigocampana) {
                    $.ajax({
                        url: '/agate/public/AnuncioPorCampaña/' + codigocampana,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#codigoanuncio').empty();
                            $('#codigoanuncio').append('<option value="">Seleccione un anuncio</option>');
                            $.each(data, function(key, value) {
                                $('#codigoanuncio').append('<option value="' + value.codigoanuncio + '">' + value.descripcion + '</option>');
                            });
                            var AnuncioSeleccionado = "{{ old('codigoanuncio', isset($adicionarnota) ? $adicionarnota->codigoanuncio : '') }}";
                            $('#codigoanuncio').val(AnuncioSeleccionado);
                        }
                    });
                } else {
                    $('#codigoanuncio').empty();
                    $('#codigoanuncio').append('<option value="">Seleccione un anuncio</option>');
                }
            });
        var clienteSeleccionado = "{{ old('codigocliente', isset($adicionarnota) ? $adicionarnota->codigocliente : '') }}";
            if (clienteSeleccionado) {
                $('#codigocliente').val(clienteSeleccionado).trigger('change');
            }
        
    });
</script>