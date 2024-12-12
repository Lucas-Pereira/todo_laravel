<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;

class ProjetoController extends Controller
{
    //
    public function index(){
        $projeto = Projeto::all();

        return response()->json([
           $projeto
        ]);


    }



    public function store(Request $request){
        $projeto = Projeto::create([
            'nome' => $request->nome
        ]
        );

        return response()->json($projeto);
    }

    public function show($id){
        return Projeto::findOrFail($id);
    }

    public function update(Request $request, $id){
        $projeto = Projeto::findOrFail($id);
        $projeto->update($request->all());
    }

    public function destroy($id){
        $projeto = Projeto::findOrFail($id);
        $projeto->delete();
    }
}
