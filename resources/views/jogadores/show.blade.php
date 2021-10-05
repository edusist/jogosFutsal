@extends('layouts.app')

@section('nome', 'Detalhes dos jogador')
@section('content')
<a href="{{ route('jogadores.index') }}" class="btn btn-primary">Voltar</a>
    <div class="row">
        <h1 class="text-center">Detalhes do jogador {{ $jogador->nome_jogador }}</h1>
        <div class="col-md-3">
            <p><strong>nome: </strong></p>
            <p>{{ $jogador->nome_jogador }}</p>
        </div>
        <div class="col-md-3">
            <p><strong>Posicao: </strong></p>
            <p>{{ $jogador->posicao }}</p>
        </div>
        <div class="col-md-3">
            <p><strong>Está presente: </strong></p>
            <p>{{ $jogador->presente }}</p>
        </div>
        <div class="col-md-3">
            <p><strong>Nivel: </strong></p>
            <p>{{ $jogador->nivel }}</p>
        </div>

        <form action="{{ route('jogadores.destroy', $jogador->id) }}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </form>
    </div>
@endsection
