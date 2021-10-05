@extends('layouts.app')

@section('content')
<hr>
@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

        <div class="row">
            <h1 class="text-center">Rodada</h1>
            <div class="col-md-6">

                {{-- <a href="{{route('auth/logout')}}">Logout</a> --}}
                <div class="table">
                    <table class="table table-hover" id="id_tabela">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cód. time</th>
                                <th>jogador</th>
                                <th>posicao</th>
                                <th>Nível</th>
                                <th>Nome time</th>
                                {{-- <th>Alterar</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rodada as $valor)
                            <tr>
                                @if ($valor->timefutsal_id == 1)
                                    <td>{{ $valor->id }}</td>
                                    <td>{{ $valor->timefutsal_id}}</td>
                                    <td>{{ $valor->nome_jogador}}</td>
                                    <td>{{ $valor->posicao}}</td>
                                    <td>{{ $valor->nivel}}</td>
                                    <td>{{ $valor->nome_time}}</td>
                                    {{-- <td> <a href="{{ route('timesFutsal.alterarJogadorTime', $valor->id) }}" class="btn btn-success">Alterar</a></td> --}}
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
            <h1>X</h1>
            <div class="col-md-6">
                <div class="table">
                    <table class="table table-hover" id="id_tabela">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cód. time</th>
                                <th>jogador</th>
                                <th>posicao</th>
                                <th>Nível</th>
                                <th>Nome time</th>
                                {{-- <th>Alterar</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rodada as $valor)
                            <tr>
                                @if ($valor->timefutsal_id == 2)
                                    <td>{{ $valor->id }}</td>
                                    <td>{{ $valor->timefutsal_id}}</td>
                                    <td>{{ $valor->nome_jogador}}</td>
                                    <td>{{ $valor->posicao}}</td>
                                    <td>{{ $valor->nivel}}</td>
                                    <td>{{ $valor->nome_time}}</td>
                                    {{-- <td> <a href="{{ route('timesFutsal.alterarJogadorTime', $valor->id) }}" class="btn btn-success">Alterar</a></td> --}}
                                @endif


                            </tr>


                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>

@endsection
