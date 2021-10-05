@extends('layouts.app')
@section('nome', 'Alterar timesFutsal')

@section('content')
<h1>Alterar timeFutsal => {{ $timeFutsal->nome_time }}</h1>

<form action="{{ route('timesFutsal.update', $timeFutsal->id) }}" method="post" enctype="multipart/form-data">
    {{-- Tipo de método tem ser PUT e não UPDATE --}}
    @csrf
    @method('put')
    @include('timesFutsal._partials.form')

</form>
@endsection
