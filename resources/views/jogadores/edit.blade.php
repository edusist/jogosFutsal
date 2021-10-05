@extends('layouts.app')
@section('nome', 'Alterar jogadores')

@section('content')
<h1>Alterar jogador => {{ $jogador->nome_jogador }}</h1>

<form action="{{ route('jogadores.update', $jogador->id) }}" method="post" enctype="multipart/form-data">
    {{-- Tipo de método tem ser PUT e não UPDATE --}}
    @csrf
    @method('put')
    @include('jogadores._partials.form')

</form>
@endsection
