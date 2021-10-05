@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Cód do Jogador => {{ $rodada->jogador_id }}</h1>
        <div class="row align-items-center">
            <div class="col-md-12">
                <form action="{{ route('timesFutsal.alteradoJogador', $rodada->id) }}" method="put">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-6">
                            <label for="validationTooltip01"><h2>Alterar jogador por time:</h2></label>
                            <select name="id_jogador" class="form-control">
                                <option>Escolha um time:</option>
                                @foreach ($listRodadas as $time)
                                    <option value="{{ $time->id }}">{{ $time->id}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>



@endsection
