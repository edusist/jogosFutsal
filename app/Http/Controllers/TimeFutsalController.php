<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Rodada;
use App\Models\Jogador;
use DateTime;
use Illuminate\Support\Facades\Auth;

class TimeFutsalController extends Controller
{

    private $numeroPaginas = 10;
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $timesFutsal = Time::paginate($this->numeroPaginas);

        return view('timesFutsal.index', compact('timesFutsal'));
    }

    public function create()
    {
        return view("timesFutsal.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        Time::create($dados);
        return redirect()->route('timesFutsal.index')->with('success', 'time cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timesFutsal = Time::where('id', $id)->first();
        //dd($jogador);
        if (!$timesFutsal) :
            return redirect()->route('timesFutsal.index');
        endif;

        return view('timesFutsal.edit', compact('timesFutsal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $timesFutsal = Timefind($id);


        if (!$timesFutsal) {
            return redirect()->back();
        }

        $dados = $request->all();
        //dd($dados);
        $timesFutsal->update($dados);
        //dd($retorno);

        return redirect()->route('timesFutsal.index')->with('success', 'time alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timesFutsal = Time::where('id', $id)->first();
        //dd($jogador);
        if (!$timesFutsal) :
            return redirect()->route('timesFutsal.index');
        endif;

        return view('timesFutsal.show', compact('timesFutsal'));
    }

    public function destroy($id)
    {
        $timesFutsal = Time::find($id);

        if (!$timesFutsal) {
            return redirect()->route('timesFutsal.index');
        }
        $timesFutsal->delete();

        return redirect()->route('timesFutsal.index')->with('success', 'time excluído com sucesso!');
    }


    public function rodadaCreate()
    {
        $listaJogadores = Jogador::all();

        $quant_jogadores =  count($listaJogadores);


        if ($quant_jogadores >= '12') {

            foreach ($listaJogadores as $value) {


                if ($value->posicao == 'goleiro') {

                    $posicao = $value->posicao;

                    $goleiro[] = $value;
                    // $nivelGoleiro[] =  $value->nivel;

                } else {

                    $jogadorLinha[] = $value;
                } //fim if verifica se é goleiro
            } //fim foreach
        } else {
            echo "Não possível montar 2 times";
        } //fim if de quantidade de jogadores

        // $times = Time::select('id')->get();

        $times = Time::select('id')->OrderBy('created_at', 'ASC')->limit(2)->get();

        //dd($times);
        $timesformados = $this->embaralhaTimes($times);
        $goleiros       = $this->embaralhaTimes($goleiro);
        $jogadoresLinha = $this->embaralhaTimes($jogadorLinha);

        //print_r($goleiros);
        $dt = new DateTime();
        $dataAtual = $dt->format("Y-m-d H:i:s");
        $id = Auth::user()->id;

        $tamTime = count($timesformados);
        $tamJogador = count($jogadoresLinha);

        //dd($tamTime);

        // for ($j = 0; $j < $tamTime; $j++) {
        //     // var_dump($goleiros[$j]);
        //     // var_dump($timesformados[$j]);

        //     $RodadaAdd =  Rodada::create([

        //         'data_rodada' => $dataAtual,
        //         'user_id' => $id,
        //         'jogador_id' =>  $goleiros[$j],
        //         'timefutsal_id' =>  $timesformados[$j]
        //     ]);
        // }

        $sortearTime = Time::select('id')->OrderBy('created_at', 'ASC')->limit(2)->get();

        for ($i = 0; $i < $tamJogador; $i++) {

            $jogadoresLinha[$i];

            $timeSorteado = $this->embaralhaUmValor($sortearTime);

            $rodadaAddJogador =  Rodada::create([
                'data_rodada' => $dataAtual,
                'user_id' => $id,
                'jogador_id' =>  $jogadoresLinha[$i],
                'timefutsal_id' =>  $timeSorteado
            ]);

        }

        if ($rodadaAddJogador) {

            print_r("ok");
        }

    }

    public function embaralhaTimes($dado)
    {
        $arr = array();
        foreach ($dado as $key => $value) {

            $arr[] = $value->id;
        }
        shuffle($arr);

        $arrRetorno = array();

        foreach ($arr as $value) {

            $arrRetorno[] = $value;
        }
        return $arrRetorno;
    }

    public function embaralhaUmValor($dado)
    {
        $arr = array();
        foreach ($dado as $key => $value) {

            $arr[] = $value->id;
        }
        shuffle($arr);

        $arrRetorno = array();

        foreach ($arr as $value) {

            return $value;
        }
        //return $arrRetorno;
    }


    public function montarTimesRodada()
    {
    }
}


// echo "----------------------------------------<br>";
