@extends('layouts.app')

@section('nome', 'Criar rodada')
@section('content')
<a href="{{ route('timeFutsal.index') }}" class="btn btn-primary">Voltar</a>
    <div class="row">
        <h1 class="text-center">Criar rodada</h1>
        <div class="col-md-3">
            <p><strong>nome: </strong></p>
            <p></p>
        </div>

    </div>
