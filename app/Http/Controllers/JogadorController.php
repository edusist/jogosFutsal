<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use App\Http\Requests\ValidacaoFormulario;
use App\Models\Time;

class JogadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $numeroPaginas = 12;

    public function index()
    {
        $jogadores = Jogador::paginate($this->numeroPaginas);

        return view('jogadores.index', compact('jogadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("jogadores.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacaoFormulario $request)
    {
        $dados = $request->all();
        dd($dados);
        Jogador::create($dados);
        return redirect()->route('jogadores.index')->with('success', 'Jogador cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jogador = Jogador::where('id', $id)->first();
        //dd($jogador);
        if (!$jogador) :
            return redirect()->route('jogadores.index');
        endif;

        return view('jogadores.edit', compact('jogador'));
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
         $jogador = Jogador::find($id);


        if (!$jogador) {
            return redirect()->back();
        }

        $dados = $request->all();
        //dd($dados);
        $jogador->update($dados);
        //dd($retorno);

        return redirect()->route('jogadores.index')->with('success', 'Jogador alterado com sucesso!');
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
        $jogador = Jogador::where('id', $id)->first();
        //dd($jogador);
        if (!$jogador) :
            return redirect()->route('jogadores.index');
        endif;

        return view('jogadores.show', compact('jogador'));
    }

    public function destroy($id)
    {
        $jogador = Jogador::find($id);

        if (!$jogador) {
            return redirect()->route('jogadores.index');
        }
        $jogador->delete();

        return redirect()->route('jogadores.index')->with('success', 'Jogador excluído com sucesso!');
    }


}
