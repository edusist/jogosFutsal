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

    //**************************Sortear os jogadores time**************************************


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

                $arrGoleiros[] =  $value->id;
                $contadorGoleiros++;
            } else {

                $arrJogadorTime1[] = $value->id;
            }
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

                return redirect()->back()->withErrors(['errors' => 'Quantidade jogadores presentes é menor para a formação dos times!']);

            } else {


                $jogadoresLinha = $numeroJogadoresTime - 1; //retira o goleiro

                //dividi o número de jogadores por 2 time
                $jogadoresPorTime = round($jogadoresLinha) / 2;

                //monta a quantidade de time definida pelo usuário
                //Exemplo: 5 jogadores por time + 1 goleiro
                $times = array_chunk($arrRetorno, $jogadoresPorTime);

                $TimesCadRodada = Time::all();
                $quantTimesCadRod = count($TimesCadRodada);
                //dd($quantTimesCadRod);

                if ($quantTimesCadRod > 0) {

                    return redirect()->route('jogadores.index')->withErrors(['errors' => 'Já existe times para está rodada!']);
                } else {

                    $resultado = $this->montarTime($times, $arrGoleiros, $contadorGoleiros);


                    if ($resultado) {

                        return redirect()->route('listarTimeRodada')->with('success', 'Jogadores sorteados com sucesso!');
                    }
                }
            }
        } else {

            return redirect()->back()->withErrors(['errors' => 'Quantidade de goleiros presentes é menor para formação dos times!!']);

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


        for ($i = 0; $i < $contadorGoleiros; $i++) {

            $arrGoleiros[$i];

            $nome_time = $times_criados[$i]->nome_time;

            Time::create([

                'nome_time' => $nome_time,
                'data_rodada' => $dataAtual,
                'jogador_id' => $arrGoleiros[$i]
            ]);
        }

        if ($cadJogador) {

            return $cadJogador;
        }
        else{

            return redirect()->back()->withErrors(['errors' => 'Não possivel salva os times na rodada!']);
        }
    }

    //****************************Excluir a rodada**************************************** */
    public function excluirTimesRodada()
    {
        $excluirTudo = Time::query()->delete();

        // $delete = $excluirTudo->delete();

        if ($excluirTudo) {
            return redirect()->route('listarTimeRodada')->with('success', 'Rodada excluida com sucesso!');
        } else {

            return redirect()->back()->withErrors(['errors' => 'Não possivel excluir!']);
        }
    }
    //******************************************************************** */





}
