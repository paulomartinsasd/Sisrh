<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
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
        $cargos = Cargo::where('descricao', 'like','%'.$request->busca.'%')->orderBy('descricao', 'asc')->paginate(3);

        $totalCargos = Cargo::all()->count();

        // Receber os dados do banco através
        return view('cargos.index', compact('cargos', 'totalCargos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();

        $input['user_id'] = 1;


        // Insert de dados no Banco
        Cargo::create($input);

        return redirect()->route('cargos.index')->with('sucesso', 'Cargo Cadastrado com Sucesso!');
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
        $cargo = Cargo::find($id);
        if(!$cargo){
            return back();
        }

        return view('cargos.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $cargo = Cargo::find($id);

        $cargo->fill($input);
        $cargo->save();
        return redirect()->route('cargos.index')->with('sucesso', 'Cargo Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cargo = Cargo::find($id);

        //Apagando o regristo do Banco de dados
        $cargo->delete();

        return redirect()->route('cargos.index')->with('sucesso', 'Cargo excluido com Sucesso.');
    }
}
