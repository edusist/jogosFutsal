@extends('layouts.app')

@section('nome', 'Detalhes dos jogador')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="jumbotron">
                <h1 class="text-center">Detalhes dos jogadores {{ $jogador->nome_jogador }}</h1>

                <a href="{{route('jogadores.index')}}" class="btn btn-primary">Voltar</a>
                <p class="lead"><strong>nome: </strong>{{ $jogador->nome_jogador }}</p>
                <p class="lead"><strong>Posicao: </strong>{{ $jogador->posicao }}</p>
                <p class="lead"><strong>Está presente: </strong>{{ $jogador->presente }}</p>
            </div>

            <form action="{{ route('jogadores.destroy', $jogador->id) }}" method="post">
                @csrf
                <div class="form-group">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        @endsection

    </div>
</div>
