@extends('layouts.app')
@section('title', 'Cadastrar jogador')

@section('content')
    <h1>.::Cadastrar jogador::.</h1>


    <form action="{{ route('jogadores.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            @include('jogadores._partials.form')
        </div>
    </form>

@endsection
