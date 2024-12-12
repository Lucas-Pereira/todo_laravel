<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\User;

class TarefaController extends Controller
{
    public function index(){
        $tarefa = Tarefa::all();

        return response()->json([
           $tarefa
        ]);


    }



    public function store(Request $request){
        $tarefa = Tarefa::create([
            'nome' => $request->nome,
            'descricao' =>$request->descricao,
            'completo' =>$request->completo,
            'prioridade' =>$request->prioridade,
            'user_id' =>$request->user_id,
            'projeto_id' =>$request->projeto_id
        ]);

        return response()->json($tarefa);
    }

    public function show($id){
        return Tarefa::findOrFail($id);
    }

    public function update(Request $request, $id){
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
    }

    public function destroy($id){
        $tarefa = User::findOrFail($id);
        $tarefa->delete();
    }
}
