@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
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
                        value="{{ $cliente->nome ?? old('nome') }}" placeholder="Digite o nome...">
                </div>
                <div class="col-md-12 mb-6">
                    <label for="validationTooltip05"><strong>Goleiro:</strong></label>
                    <input type="radio" name="posicao" value="gol_sim"> sim
                    <input type="radio" name="posicao" value="jogador"> não <br>

                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-6">
                    <label for="validationTooltip04"><strong>Nivel:</strong></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" for="inlineRadio1">1 - Ruim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                        <label class="form-check-label" for="inlineRadio2">2 - Regular</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option3">
                        <label class="form-check-label" for="inlineRadio3">3 - Médio</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option4">
                        <label class="form-check-label" for="inlineRadio4">4 - Bom</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option5">
                        <label class="form-check-label" for="inlineRadio5">5 - Excelente</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-6">
                    <label for="presenca"><strong>Está presente:</strong></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" for="inlineRadio1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                        <label class="form-check-label" for="inlineRadio2">Não</label>
                    </div>
                </div>


            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>
</div>
