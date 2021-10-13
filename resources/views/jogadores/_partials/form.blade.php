@if ($errors->any())

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <h4> {{ $error }}</h4>
        </div>
        @endforeach

@endif
<!-- Link para voltar -->
<a href="{{ route('jogadores.index') }}" class="btn btn-primary">Voltar</a>

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-12">
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-12 mb-6">
                        <label for="validationTooltip01">Nome:</label>
                        <input type="text" name="nome_jogador" class="form-control" id="nome"
                            value="{{ $jogador->nome_jogador ?? old('nome_jogador') }}"
                            placeholder="Digite o nome...">
                    </div>
                    <div class="col-md-12 mb-6">
                        <label for="validationTooltip05"><strong>Goleiro:</strong></label>
                        @if (!isset($jogador->id))
                            <input type="radio" name="posicao" value="goleiro">sim
                            <input type="radio" name="posicao" value="linha"> não

                        @elseif($jogador->posicao == 'goleiro')
                            <input type="radio" name="posicao" value="goleiro" checked>sim
                            <input type="radio" name="posicao" value="linha"> não
                        @else
                            <input type="radio" name="posicao" value="goleiro"> sim
                            <input type="radio" name="posicao" value="linha" checked>não
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-6">


                        @if (!isset($jogador->id))
                        <label for="validationTooltip04"><strong>Nivel:</strong></label>
                            <input type="radio" name="nivel" value="1">1 - Ruim
                            <input type="radio" name="nivel" value="2">2 - Regular
                            <input type="radio" name="nivel" value="3">3 - Médio
                            <input type="radio" name="nivel" value="4">4 - Bom
                            <input type="radio" name="nivel" value="5">5 - Excelente

                        @elseif($jogador->nivel == '1' || $jogador->nivel == '2' || $jogador->nivel == '3' ||
                            $jogador->nivel == '4'|| $jogador->nivel == '5')
                            <label for="validationTooltip04"><h4><strong>Valor do nível:{{$jogador->nivel}}</strong></h4></label><br>
                            <input type="radio" name="nivel" value="1">1 - Ruim
                            <input type="radio" name="nivel" value="2">2 - Regular
                            <input type="radio" name="nivel" value="3">3 - Médio
                            <input type="radio" name="nivel" value="4">4 - Bom
                            <input type="radio" name="nivel" value="5">5 - Excelente
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-6">
                            <label for="presenca"><strong>Está presente:</strong></label>

                            @if (!isset($jogador->id))
                                <input type="radio" name="presente" value="sim"> sim
                                <input type="radio" name="presente" value="não"> não

                            @elseif($jogador->presente == 'sim')
                                <input type="radio" name="presente" value="sim" checked> sim
                                <input type="radio" name="presente" value="não"> não
                            @else
                                <input type="radio" name="presente" value="sim"> sim
                                <input type="radio" name="presente" value="não" checked> não
                            @endif
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
