@extends('layouts.app')

@section('content')
<hr>
@if (session('success'))
    <div>
        <div class="alert alert-success" role="alert">
        <h4>{{ session('success') }}</h4>
        </div>
    </div>
@endif

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Times de Futsal</h1>
                {{-- <a href="{{route('auth/logout')}}">Logout</a> --}}
                <div class="table">
                    <table class="table table-hover" id="id_tabela">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timesFutsal as $time_futsal)
                            <tr>

                                <td>{{ $time_futsal->id }}</td>
                                <td>{{ $time_futsal->nome_time}}</td>



         <td>
           <a href="{{ route('timesFutsal.edit', $time_futsal->id) }}" class="btn btn-success">Alterar</a>
             |
            <a href="{{ route('timesFutsal.show', $time_futsal->id) }}" class="btn btn-danger">Excluir</a>

        </td>

                            </tr>


                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>

@endsection
