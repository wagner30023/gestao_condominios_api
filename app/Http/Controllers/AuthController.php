<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;
use Illuminate\Support\facades\Auth;


use App\Models\User;
use App\Models\Unit;

class AuthController extends Controller
{
    public function unauthorized()
    {
        return response()->json([
            'Error' => 'Não autoriazado'
        ], 401);
    }

    public function register(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|digits:11|unique:users,cpf',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        if (!$validator->fails()) {
            $name = $request->input('name');
            $email = $request->input('email');
            $cpf = $request->input('cpf');
            $password = $request->input('password');

            $hash = password_hash($password, PASSWORD_DEFAULT);

            // depois da validação cria o usuario
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->cpf = $cpf;
            $newUser->password = $hash;
            $newUser->save();

            // gerando o token
            $token = auth()->attempt([
                'cpf' => $cpf,
                'password' => $password
            ]);

            // se não gerar o token
            if (!$token) {
                $array['error'] = 'Ocorreu um erro';
            }

            $array['token'] = $token;

            // senão
            $user = auth()->user();
            $array['user'] = $user;
            $properties = Unit::select(['id', 'name'])
                ->where('id_owner', $user['id'])
                ->get();
            $array['user']['properties'] = $properties;
        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }
        return $array;
    }

    public function login(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'cpf' => 'required|digits:11',
            'password' => 'required'
        ]);

        if (!$validator->fails()) {
            $cpf = $request->input('cpf');
            $password = $request->input('password');

            $token = auth()->attempt([
                'cpf' => $cpf,
                'password' => $password
            ]);

            // echo $token;

            if (!$token) {
                $array['error'] = 'CPF e/ou Senha estão errados ';
                return $array;
            }

            $array['token'] = $token;

            $user = auth()->user();
            $array['user'] = $user;
            $properties = Unit::select(['id', 'name'])
                ->where('id_owner', $user['id'])
                ->get();
            $array['user']['properties'] = $properties;
        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }

    public function validateToken()
    {
        $array = ['error' => ''];

        $user = auth()->user();
        $array['user'] = $user;
        $properties = Unit::select(['id', 'name'])
            ->where('id_owner', $user['id'])
            ->get();
        $array['user']['properties'] = $properties;

        return $array;
    }

    public function logout()
    {
        $array = ['error' => ''];
        auth()->logout();
        return $array;
    }
}
