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
    protected $time1;
    protected $time2;
    protected $time3;
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $timesFutsal = Time::all();

        return view('timesFutsal.index', compact('timesFutsal'));
    }
    //******************************************************************** */
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


    //******************************************************************** */
    public function show($id)
    {
        $timesFutsal = Time::where('id', $id)->first();
        //dd($jogador);
        if (!$timesFutsal) :
            return redirect()->route('timesFutsal.index');
        endif;

        return view('timesFutsal.show', compact('timesFutsal'));
    }
    //******************************************************************** */
    public function destroy($id)
    {
        $timesFutsal = Time::find($id);

        if (!$timesFutsal) {
            return redirect()->route('timesFutsal.index');
        }
        $timesFutsal->delete();

        return redirect()->route('timesFutsal.index')->with('success', 'time excluído com sucesso!');
    }



    //******************************************************************** */
    public function listarRodada()
    {
        //lista rodadas
        $rodada  = Rodada::join('jogadores', 'jogadores.id', '=', 'rodadas.jogador_id')
            ->join('timesfutsal', 'timesfutsal.id', '=', 'rodadas.timefutsal_id')
            ->where('jogadores.presente', 'sim')
            ->orderBy('rodadas.id', 'ASC')
            ->limit(12)
            ->select('rodadas.id', 'rodadas.timefutsal_id', 'jogadores.posicao', 'jogadores.nivel', 'jogadores.nome_jogador', 'timesfutsal.nome_time')
            ->get();


        $time3  = Rodada::join('jogadores', 'jogadores.id', '=', 'rodadas.jogador_id')
            ->join('timesfutsal', 'timesfutsal.id', '=', 'rodadas.timefutsal_id')
            ->orderBy('rodadas.id', 'ASC')
            ->select('rodadas.id', 'rodadas.timefutsal_id', 'jogadores.posicao', 'jogadores.nivel', 'jogadores.nome_jogador', 'timesfutsal.nome_time')
            ->get();


        return view('timesFutsal.listaRodadas', compact('rodada', 'time3'));
    }
    //******************************************************************** */
    public function alterarJogadorTime($id)
    {

        $rodada = Rodada::find($id);
        $listRodadas = Time::select('id')->OrderBy('created_at', 'ASC')->limit(2)->get();
        //dd($rodada);

        return view('timesFutsal.alterarJogadorTime', compact('rodada', 'listRodadas'));
    }
    //*************************Montagem de time******************************************* */
    public function montarTime(Request $request)
    {

        $quantDefUsuario = $request->input('numerojogadores');
        $numeroJogadoresTime = $quantDefUsuario * 2;

        $jogadores = Jogador::select('id')->where('presente', 'sim')->get();

        $arrJogadorTime1 = array();

        foreach ($jogadores as $value) {

            $arrJogadorTime1[] = $value->id;
        }

        //Sortea os jogadores
        shuffle($arrJogadorTime1);

        $arrRetorno = array();

        foreach ($arrJogadorTime1 as $value) {

            $arrRetorno[] = $value;
        }

        $jogadoresConfirmados = count($jogadores);

        //print_r($jogadoresConfirmados."<".$numeroJogadoresTime);

        //Verifica se número de confirmados e menor por time
        if ($jogadoresConfirmados < $numeroJogadoresTime) {

            print_r('Quantidade ' . $jogadoresConfirmados . ' é menor que ' . $numeroJogadoresTime . ' definida pelo usuário menor por time!');
        } else {
            //dividi o número de jogadores por 2 times
            print_r('Confirmados' . $jogadoresConfirmados . '<br>Quantidade definida pelo usuário por time!' . $quantDefUsuario);

            $jogadoresPorTime = $numeroJogadoresTime/2;

            //array_chunk(array, int $size , bool $preserve_keys=false): array
            $times = array_chunk($arrRetorno, $jogadoresPorTime);

            foreach ($times as $key => $value) {
                echo "<pre>";
                print_r("time".$key);
                echo "<br>";
                print_r($value);
                echo "<br>";
                echo "</pre>";
            }
        }
    }

    //******************************************************************** */
    public function rodadaCreate()
    {
        $listaJogadores = Jogador::where('jogadores.presente', 'sim')->get();

        //$quant_jogadores =  count($listaJogadores);
        //var_dump($quant_jogadores);



        foreach ($listaJogadores as $value) {


            if ($value->posicao == 'goleiro') {

                // $posicao = $value->posicao;

                $goleiro[] = $value;
                // $nivelGoleiro[] =  $value->nivel;

            } else {

                $jogadorLinha[] = $value;
            } //fim if verifica se é goleiro
        } //fim foreach

        $times = Time::select('id')->OrderBy('created_at', 'ASC')->limit(2)->get();

        $timesformados  = $this->embaralhaTimes($times);
        $goleiros       = $this->embaralhaTimes($goleiro);
        $jogadoresLinha = $this->embaralhaTimes($jogadorLinha);

        //print_r($goleiros);
        $dt = new DateTime();
        $dataAtual = $dt->format("Y-m-d H:i:s");
        // $id = Auth::user()->id;//
        $id = 1;

        $tamTime = count($timesformados);
        $tamJogador = count($jogadoresLinha);


        for ($j = 0; $j < $tamTime; $j++) {

            $goleiros[$j];

            Rodada::create([
                'data_rodada' => $dataAtual,
                'user_id' => $id,
                'jogador_id' =>  $goleiros[$j],
                'timefutsal_id' =>  $timesformados[$j]
            ]);
        }

        $sortearTime = Time::select('id')->OrderBy('created_at', 'ASC')->limit(2)->get();


        for ($i = 0; $i < $tamJogador; $i++) {

            $jogadoresLinha[$i];

            $timeSorteado = $this->embaralhaUmValor($sortearTime);
            //dd($timeSorteado);


            Rodada::create([
                'data_rodada' => $dataAtual,
                'user_id' => $id,
                'jogador_id' =>  $jogadoresLinha[$i],
                'timefutsal_id' =>  $timeSorteado
            ]);
        }


        $rodada = Rodada::join('jogadores', 'jogadores.id', '=', 'rodadas.jogador_id')
            ->join('timesfutsal', 'timesfutsal.id', '=', 'rodadas.timefutsal_id')
            ->where('jogadores.presente', 'sim')
            ->orderBy('rodadas.id', 'ASC')
            ->select('rodadas.id', 'rodadas.timefutsal_id', 'jogadores.posicao', 'jogadores.nivel', 'jogadores.nome_jogador', 'timesfutsal.nome_time')
            ->get();

        $arrJogadorTime1 = array();
        $arrJogadorTime2 = array();

        //mudar jogador de time
        foreach ($rodada as $key => $value) {

            if ($value->timefutsal_id === 1) {

                $this->time1 = $value->timefutsal_id;

                $arrJogadorTime1[] = $value->id;
            } else {

                $arrJogadorTime2[] = $value->id;
                $this->time2 = $value->timefutsal_id;
            }
        }
        $this->balancearTime($arrJogadorTime1, $arrJogadorTime2);
    }

    //******************************************************************** */
    public function balancearTime($arrJogadorTime1, $arrJogadorTime2)
    {


        $quant_time = count($arrJogadorTime1);

        if ($this->time1 == 1 && $quant_time > 6) {

            $id_rodada1 = end($arrJogadorTime1);

            $alterar1 = Rodada::find($id_rodada1)->update([
                'timefutsal_id' => $this->time2,
            ]);

            if ($alterar1) {

                redirect()->route('timesFutsal.listaRodadas')->with('success', 'Time Adicionado com sucesso!');
            }
        } else {
            $id_rodada2 = end($arrJogadorTime2);
            $alterar2 = Rodada::find($id_rodada2)->update([
                'timefutsal_id' => $this->time1,
            ]);

            if ($alterar2) {

                redirect()->route('timesFutsal.listaRodadas')->with('success', 'Time Adicionado com sucesso!');
            }
        }
    }


    //******************************************************************** */
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
    //******************************************************************** */
    public function embaralhaUmValor($dado)
    {
        $arr = array();
        // $contador = 0;
        foreach ($dado as $key => $value) {

            $arr[] = $value->id;
            //var_dump($arr);
        }


        //print_r("Quant=> ".$contador);
        shuffle($arr);

        $arrRetorno = array();

        foreach ($arr as $value) {

            return $value;
        }
        //return $arrRetorno;
    }

    public function alteradoJogador(Request $request, $id)
    {

        $rodada  = Rodada::find($id);


        if (!$rodada) :

            return redirect()->back();
        endif;

        $data = $request->all();
        $rodada->update($data);
        return redirect()->route('timesFutsal.listaRodadas')->with('success', 'Time atualizado com sucesso!');
    }

    //******************************************************************** */

}
