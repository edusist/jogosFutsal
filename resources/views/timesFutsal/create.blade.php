@extends('layouts.app')
@section('title', 'Cadastrar time')

@section('content')
    <h1>.::Cadastrar time::.</h1>


    <form action="{{ route('timesFutsal.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            @include('timesFutsal._partials.form')
        </div>
    </form>

@endsection
