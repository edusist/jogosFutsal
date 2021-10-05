@extends('layouts.app')

@section('nome', 'Detalhes do time')
@section('content')
<a href="{{ route('timeFutsal.index') }}" class="btn btn-primary">Voltar</a>
    <div class="row">
        <h1 class="text-center">Detalhes do timeFutsal {{ $timeFutsal->nome_time }}</h1>
        <div class="col-md-3">
            <p><strong>nome: </strong></p>
            <p>{{ $timeFutsal->nome_time }}</p>
        </div>


        <form action="{{ route('timeFutsal.destroy', $timeFutsal->id) }}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </form>
    </div>
@endsection
