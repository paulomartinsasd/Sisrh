<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
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
        $departamentos = Departamento::where('nome', 'like','%'.$request->busca.'%')->orderBy('nome', 'asc')->paginate(10);

        $totalDepartamentos = Departamento::all()->count();

        // Receber os dados do banco através
        return view('departamentos.index', compact('departamentos', 'totalDepartamentos'));
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

        // Insert de dados do usuário no banco
        Departamento::create($input);

        return redirect()->route('departamentos.index')->with('sucesso','Departamento cadastrado com sucesso');
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
