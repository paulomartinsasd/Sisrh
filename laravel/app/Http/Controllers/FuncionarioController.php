<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = Funcionario::all()->sortBy('nome');

        //Recebe os dados do banco
        return view('funcionarios.index', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna o formulario de cadastro do funcionário
        $departamentos = Departamento::all()->sortBy('nome');
        $cargos = Cargo::all()->sortBy('descrcao');
        return view('funcionarios.create', compact('departamentos', 'cargos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();
        //dd($input);

        $input['user_id'] = 1;

        // Insert de dados no Banco
        Funcionario::create($input);

        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário Cadastrado com Sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
