<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        $user = User::all();

        return response()->json([
           $user
        ]);


    }



    public function store(Request $request){

        $user = User::create([
            'name' => $request->name,
            'password' =>$request->password,//Hash::make('password')
            'email' =>$request->email]);
        return response()->json($user);
    }

    public function show($id){
        return User::findOrFail($id);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function login(Request $request){

        $email = $request->email;
        $user = User::where('email', '=', $email)->first();

        if(Hash::check($request->password, $user->password)){//compara senha
            $token = $user->createToken('token-name');//->plainTextToken
            return response()->json([
                'mensagem'=>"sucesso",
                'token'=> $token->plainTextToken,

            ]);
        }else{
            return response()->json([
                'mensagem_erro'=>"Deu ruim"
            ]);
        }



    }
}
