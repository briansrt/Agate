@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/tiposanuncio') }}" method="post">
    @csrf

    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-3">
        @include('tiposanuncio.form', ['modo'=>'Crear']);
    </div>

</form>
</div>
@endsection