<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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
            'name' => $request->nome,
            'senha' => Hash::make($request->senha),
            'email' => $request->email]);
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

    public function login(Request $request)
    {
        try {
            $this->validateLoginFields($request);

            $email = $request->email;
            $user = User::where('email', '=', $email)->first();
            if($user == null) throw new BadRequestException("Usuario não encontrado!");

            // if($user->senha == '123456'){
            //     $senhaEncriptada = Hash::make($user->senha);
            //     $user->senha = $senhaEncriptada;
            //     $user->save();
            // }

           if(Hash::check($request->senha, $user->senha)){//compara senha
                //token-name é o nome do token
                $token = $user->createToken('token-name');//->plainTextToken
                return response()->json([
                    'message'=>"sucesso",
                    'token'=> 'Bearer '.$token->plainTextToken,
                ]);
            } else{
                throw new BadRequestException('Senha incorreta!'.$request->senha.":".$user->senha);
            }

            // // early return
            // if(!Hash::check($request->senha, $user->senha)){//compara senha
            //     throw new BadRequestException('Senha incorreta!');
            // }
            // if($pudim == 'de leite'){
            //     throw new BadRequestException('pudim de pao!');
            // }
            // $token = $user->createToken('token-name');//->plainTextToken
            // return response()->json([
            //     'message'=>"sucesso",
            //     'token'=> $token->plainTextToken,
            // ]);

        } catch (BadRequestException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    protected function validateLoginFields($request)
    {
        $this->validateField($request, 'email');
        $this->validateField($request, 'senha');
    }

    protected function validateField($request, $field)
    {
        if(is_null($request->$field) || empty($request->$field)) {
            throw new BadRequestException("Campo $field não enviado!");
        }
        // request->all do laravel retorna array
        // $array = $request->all();
        // if(!isset($array, $field) || is_null($array[$field]) || empty($array[$field])) {
        //     throw new BadRequestException("Campo $field não enviado!");
        // }
    }
}
