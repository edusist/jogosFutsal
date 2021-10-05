@extends('layouts.app')

@section('content')
<hr>
@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Jogadores</h1>
                {{-- <a href="{{route('auth/logout')}}">Logout</a> --}}
                <div class="table">
                    <table class="table table-hover" id="id_tabela">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Posicao</th>
                                <th>Nivel</th>
                                <th>Presente</th>

                                <th>Ações</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jogadores as $jogador)
                            <tr>

                                <td>{{ $jogador->id }}</td>
                                <td>{{ $jogador->nome_jogador }}</td>
                                <td>{{ $jogador->posicao }}</td>
                                <td>{{ $jogador->nivel }}</td>
                                <td>{{ $jogador->presente }}</td>

         <td>
           <a href="{{ route('jogadores.edit', $jogador->id) }}" class="btn btn-success">Alterar</a>
             |
            <a href="{{ route('jogadores.show', $jogador->id) }}" class="btn btn-danger">Excluir</a>

        </td>

                            </tr>


                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
        {{ $jogadores->links() }}

@endsection
