<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Return_;

class FuncionarioController extends Controller
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
        $funcionarios = Funcionario::where('nome','like','%'.$request->busca. '%')->orderBy('nome', 'asc')->paginate(3);

        $totalFuncionarios = Funcionario::all()->count();

        //Recebe os dados do banco
        return view('funcionarios.index', compact('funcionarios', 'totalFuncionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna o formulário de cadastro do funcionário
        $departamentos = Departamento::all()->sortBy('nome');
        $cargos = Cargo::all()->sortBy('descricao');
        $beneficios = Beneficio::all()->sortBy('descricao');
        return view('funcionarios.create', compact('departamentos', 'cargos', 'beneficios'));
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

    // Função para redimensionar e realizar o upload da foto
    private function uploadFoto($foto){
        $nomeArquivo = $foto->hashName();

        //Redimensionar a foto
        $imagem = image::make($foto)->fit(200,200);

        //Salvar Arquivo da Foto
        Storage::put('public/funcionarios/'.$nomeArquivo, $imagem->encode());

        //Upload Sem Redimensionar
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
        $input = $request->toArray();

        $funcionario = Funcionario::find($id);

        if($request->hasFile('foto')){
            Storage::delete('public/funcionarios/'.$funcionario['foto']);
            $input['foto'] = $this->uploadFoto($request->foto);
        }

        $funcionario->fill($input);
        $funcionario->save();
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funcionario = Funcionario::find($id);
        /* Se o funcionário tiver foto ela vai ser deletada */
        if($funcionario['foto'] != null){
            Storage::delete('public/funcionarios/'.$funcionario['foto']);
        }

        //Apagando o regristo do Banco de dados
        $funcionario->delete();

        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário excluido com Sucesso.');
    }
}
