<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /* Verificar se o Usuário está logado no sistema */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Receber os dados do banco através
        return view('dashboard.index');
    }

}
