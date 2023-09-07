<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::all()->sortBy('id');

        //Recebe os dados do banco
        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();

        $input['user_id'] = 1;


        // Insert de dados no Banco
        Departamento::create($input);

        return redirect()->route('departamentos.index')->with('sucesso', 'Departamento Cadastrado com Sucesso!');
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
        $departamento = Departamento::find($id);
        if(!$departamento){
            return back();
        }

        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $departamento = Departamento::find($id);

        $departamento->fill($input);
        $departamento->save();
        return redirect()->route('departamentos.index')->with('sucesso', 'Departamento Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departamento = Departamento::find($id);

        //Apagando o registro do Banco de dados
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('sucesso', 'Departamento excluído com Sucesso.');
    }
}
