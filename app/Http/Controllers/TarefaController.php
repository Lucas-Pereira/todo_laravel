<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TarefaController extends Controller
{
    public function index(Request $request){

        /*$bearToken = $request->authorization;
        $token= PersonalAccessToken::findToken($bearToken);

        if(!$token){
            throw new BadRequestException("Token não existe");
        }
        $user = $token->tokenable();
        $tarefa = Tarefa::all();
        return response()->json([
           $bearToken
        ]);*/

        $tarefa = DB::table('tarefa')
                  ->select('tarefa.*')
                  ->get();


        return response()->json($tarefa);
    }


    public function getTarefaById($id){

            $tarefa = DB::table('tabela')
                      ->where('id', '=', $id)
                      ->select('tabela.*')
                      ->get();

                      if($tarefa == null) return new Exception("Não existe tarefas");

                      return response()->json($tarefa);
    }

    public function store(Request $request){
       try{
            $tarefa = Tarefa::create([
                'nome' => $request->nome,
                'descricao' =>$request->descricao,
                'completo' =>$request->completo,
                'prioridade' =>$request->prioridade,
                'user_id' =>Auth::id(),
                'projeto_id' =>$request->projeto_id
            ]);

            return response()->json($tarefa);
        }catch(Exception $e){
            throw new Exception("Não foi possível criar tarefa:<br>".$e);
        }
    }

    public function show($id){
        return Tarefa::findOrFail($id);
    }

    public function update(Request $request, $id){
        try{
        $tarefa = DB::table('tarefa')
                  ->where('id', $id)
                  ->update([
                    'nome' => $request->nome,
                    'descricao' => $request->descricao,
                    'completo' => $request->completo,
                    'prioridade' =>$request->prioridade,
                    'user_id' =>Auth::id(),
                    'projeto_id' =>$request->projeto_id
                  ]);
            }catch (Exception $e){
                throw new Exception("Erro na atualização: ".$e);
            }
    }

    public function destroy($id){

        try{
            $tarefa = DB::table('tarefa')
                      ->where('id', '=', $id)
                      ->delete();

        }catch(Exception $e){
            throw new Exception("Não foi possível excluir tarefa:<br>".$e);
        }

    }
}
