<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Return_;

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
        $cargos = Cargo::all()->sortBy('descricao');
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

        if($request->hasFile('foto')){
            $input['foto'] = $this->uploadFoto($request->foto);
        }

        // Insert de dados no Banco
        Funcionario::create($input);

        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário Cadastrado com Sucesso!');
    }

    // Função para redimencionar e realizar o upload da foto
    private function uploadFoto($foto){
        $nomeArquivo = $foto->hashName();

        //Redimencionar a foto
        $imagem = image::make($foto)->fit(200,200);

        //Salvar Arquivo da Foto
        Storage::put('public/funcionarios/'.$nomeArquivo, $imagem->encode());

        //Upload Sem Redimencionar
        //$foto->store('public/funcionarios/');

        return $nomeArquivo;
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
        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return back();
        }

        $departamentos = Departamento::all()->sortBy('nome');
        $cargos = Cargo::all()->sortBy('descricao');

        return view('funcionarios.edit', compact('funcionario', 'departamentos', 'cargos'));
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
