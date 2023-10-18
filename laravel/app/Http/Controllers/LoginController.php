<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function logout(){}
}
