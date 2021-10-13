@extends('layouts.app')

@section('content')
    <hr>
    @if (session('success'))
        <div>
            <div class="alert alert-success" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <p>{{ $error }}</p>
        </div>
        @endforeach

    @endif

    <div class="row">

        <h1 class="text-center">Times da Rodada</h1>

        <div class="col-md-6">
            <a class="btn btn-primary" href="{{route('jogadores.index')}}" role="button">Voltar</a>
            <hr>
            <a href="{{route('excluirTimesRodada')}}" class="btn btn-danger">
                Excluir Times por rodada
            </a>
            {{-- <a href="{{route('auth/logout')}}">Logout</a> --}}
            <div class="table">
                <table class="table table-hover" id="id_tabela">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>jogador</th>
                            <th>posicao</th>
                            <th>Nível</th>
                            <th>Nome time</th>
                            {{-- <th>Alterar</th> --}}

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timesRodada as $valor)
                            <tr>
                                {{-- @if ($valor->timefutsal_id == '') --}}
                                    <td>{{ $valor->id }}</td>
                                    <td>{{ $valor->nome_jogador }}</td>
                                    <td>{{ $valor->posicao }}</td>
                                    <td>{{ $valor->nivel }}</td>
                                    <td>{{ $valor->nome_time }}</td>
                                    {{-- <td> <a href="{{ route('timesFutsal.alterarJogadorTime', $valor->id) }}" class="btn btn-success">Alterar</a></td> --}}
                                {{-- @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
