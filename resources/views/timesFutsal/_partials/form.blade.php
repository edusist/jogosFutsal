@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li> <h4>{{ $error }}</h4></li>
        @endforeach
    </ul>
@endif
<!-- Link para voltar -->
<a href="{{ route('timesFutsal.index') }}" class="btn btn-primary">Voltar</a>

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-12">
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-12 mb-6">
                        <label for="validationTooltip01">Nome:</label>
                        <input type="text" name="nome_time" class="form-control" id="nome"
                            value="{{ $timeFutsal->nome_time ?? old('nome_time') }}"
                            placeholder="Digite o nome...">
                    </div>

                </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
