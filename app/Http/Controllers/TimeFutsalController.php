<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Rodada;
use App\Models\Jogador;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimeFutsalController extends Controller
{

    private $numeroPaginas = 10;
    protected $time1;
    protected $arrNomeTime = array();
    protected $arrId = array();
    protected $chave = 1;

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $timesFutsal = Time::select('id', 'nome_time')->groupBy('nome_time')->get();

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
    public function listarTimeRodada()
    {
        //lista rodadas
        $timesRodada  =  DB::table('timesfutsal')
            ->join('jogadores', 'jogadores.id', '=', 'timesfutsal.jogador_id')
            ->where('jogadores.presente', 'sim')
            ->orderBy('timesfutsal.nome_time', 'asc')
            ->select('timesfutsal.nome_time', 'timesfutsal.id', 'jogadores.posicao', 'jogadores.nivel', 'jogadores.nome_jogador')
            ->get();

        return view('timesFutsal.listarTimeRodada', compact('timesRodada'));
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
    public function sortearTime(Request $request)
    {

        $quantDefUsuario = $request->input('numerojogadores');
        $numeroJogadoresTime = $quantDefUsuario * 2;

        $jogadores = Jogador::select('id', 'posicao', 'nome_jogador')->where('presente', 'sim')->get();

        $arrJogadorTime1 = array();
        $arrGoleiros = array();

        $contadorGoleiros = 0;
        foreach ($jogadores as $value) {

            //Verifica se jogadores são goleiros
            if ($value->posicao == 'goleiro') {

                // $quantGoleiros = count($goleiro);

                $arrGoleiros[] =  $value->id;
                $contadorGoleiros++;
            } else {

                $arrJogadorTime1[] = $value->id;
                //print_r($value->posicao);
            }

            //$arrJogadorTime1[] = $value->posicao;
            //fim do if Verifica se jogadores são goleiros

            //$arrJogadorTime1[] = $value->id;

        }

        //Testa a quantidade de goleiros
        if ($contadorGoleiros >= 2) {

            //**************************Sortear os jogadores**************************************
            shuffle($arrJogadorTime1);

            $arrRetorno = array();

            foreach ($arrJogadorTime1 as $value) {

                $arrRetorno[] = $value;
            }

            $jogadoresConfirmados = count($jogadores);

            //Verifica se número de confirmados e menor por time
            if ($jogadoresConfirmados < $numeroJogadoresTime) {

                print_r('Quantidade' . $jogadoresConfirmados . ' é menor que ' . $numeroJogadoresTime . ' definida pelo usuário menor por time!');
            } else {


                $jogadoresLinha = $numeroJogadoresTime - 1; //retira o goleiro

                //dividi o número de jogadores por 2 time
                $jogadoresPorTime = round($jogadoresLinha) / 2;

                //monta a quantidade de time definida pelo usuário
                //Exemplo: 5 jogadores por time + 1 goleiro
                $times = array_chunk($arrRetorno, $jogadoresPorTime);

                $this->montarTime($times, $arrGoleiros, $contadorGoleiros);
            }
        } else {
            print_r("Quantidade de goleiros" .  $contadorGoleiros . " menor para formação de times!!");
            echo "<br>";
        } //fim do if de quantidade de goleiros

    }

    //******************************************************************** */
    public function  montarTime($times, $arrGoleiros, $contadorGoleiros)
    {


        $dt = new DateTime();
        $dataAtual = $dt->format("Y-m-d H:i:s");


        foreach ($times as $key => $value) {

            $this->chave = "Time_" . $key;


            foreach ($value as $id) {



               $cadJogador =  Time::create([

                    'nome_time' => $this->chave,
                    'data_rodada' => $dataAtual,
                    'jogador_id' =>  $id
                ]);
            }
        }

        $times_criados = Time::select('nome_time')->groupBy('nome_time')->limit($contadorGoleiros)->get();


        for ($i=0; $i <$contadorGoleiros ; $i++) {

            $arrGoleiros[$i];

           $nome_time = $times_criados[$i]->nome_time;

            $cadGoleiros =  Time::create([

                    'nome_time' => $nome_time,
                    'data_rodada' => $dataAtual,
                    'jogador_id' => $arrGoleiros[$i]
                ]);

        }

        if($cadJogador && $cadGoleiros){
            return redirect()->route('timesFutsal.listarTimeRodada')->with('success', 'times cadastrados com sucesso!');
        }


    }
    //******************************************************************** */



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

    //**************************Sortear os jogadores**************************************

}
