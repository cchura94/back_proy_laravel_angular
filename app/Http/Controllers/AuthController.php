<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // funLogin
    public function funLogin(Request $request){
        // autenticar
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credenciales)) {
            return response()->json(["message" => "Credenciales Incorrectas"], 401); 
        }

        $usuario = $request->user();

        $token = $usuario->createToken("Token Auth")->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "usuario" => $usuario
        ]);

    } 

    // registrar
    public function funRegister(Request $request){
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|same:c_password"
        ]);

        // registramos al usuario
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        // $usuario->password = bcrypt($request->password);
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        
        return response()->json(["message" => "Usuario registrado"], 201);

    } 

    // funProfile
    public function funProfile(Request $request){
        $usuario = $request->user();

        return response()->json($usuario);
    }

    // funLogout
    public function funLogout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json(["message" => "Salió"]);
    }
}
