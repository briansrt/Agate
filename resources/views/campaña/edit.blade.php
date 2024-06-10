@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ url('/campaña/'.$campaña->codigocampana) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="d-flex flex-column justify-content-center align-items-center h-100 p-3">
            @include('campaña.form',['modo'=>'Editar']);
        </div>

    </form>
</div>