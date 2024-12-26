<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProjetoController extends Controller
{
    //
    public function index(){
        $projeto = Projeto::all();
        return response()->json($projeto);

    }

    public function getTarefasByProjetoId($id){

        $tarefas = DB::table('tarefa')
                   ->join('projeto', 'tarefa.projeto_id', '=', 'projeto.id')
                   ->select('tarefa.*')
                   ->where('tarefa.projeto_id','=', $id)
                   ->get();


        if($tarefas == null){
            throw new BadRequestException("Não há tarefas vinculadas ao projeto!");
        }

        return response()->json($tarefas);
    }



    public function store(Request $request){

        $projeto = DB::table('projeto')
                   ->insert([
                    'nome'=> $request->nome,
                    'created_at' => date('Y-m-d H:i:s'),
                    'user_id' => Auth::id()
                   ]);

        return response()->json($projeto);
    }

    public function show($id){
        return Projeto::findOrFail($id);
    }

    public function update(Request $request, $id){
        $projeto = DB::table('projeto')
                   ->where('id', $id)
                   ->update(['nome'=> $request->nome, 'updated_at' => date('Y-m-d H:i:s')]);

        if(!$projeto) throw new BadRequestException("Não foi possível atualizar o projeto");
    }

    public function destroy($id){
        $projeto = DB::table('projeto')
                   ->where('id','=', $id)
                   ->delete();

        return response()->json($projeto);

    }
}
