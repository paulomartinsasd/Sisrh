<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function auth(Request $request){
        $credenciais = $request->validate([
            'email' => ['requered', 'email'],
            'password' => ['requered']
        ],[
            'email.required' => "O campo e-mail é Obrigatorio",
            'email.email' => 'O E-amil informado não é válido',
            'password.required' => 'O campo senha é Obrigatório'
        ]);

        if(Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->route('funcionarios.index');
        } else {
            return redirect()->back()->with('erro_login', 'E-mail ou Senha Inválido');
        }
    }
}
