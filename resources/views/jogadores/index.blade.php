@extends('layouts.app')


@section('content')

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Novos jogadores</h1>
                {{-- <a href="{{route('auth/logout')}}">Logout</a> --}}



                <a href="{{ route('jogadores.create') }}" class="btn btn-primary">
                    <h4>Cadastrar Cliente</h4>
                </a>
                <div class="table">
                    <table class="table table-hover" id="id_tabela">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Posicao</th>
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






@endsection
