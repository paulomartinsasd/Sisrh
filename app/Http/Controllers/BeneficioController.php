<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Http\Request;

class BeneficioController extends Controller
{
     /* Verificar se o usuário está logado no sistema */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $beneficios = Beneficio::where('descricao','like','%'.$request->busca. '%')->orderBy('descricao', 'asc')->paginate(3);

        $totalbeneficios = Beneficio::all()->count();

        //Recebe os dados do banco
        return view('beneficio.index', compact('beneficios', 'totalbeneficios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('beneficio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();

        // Insert de dados do usuário no banco
        Beneficio::create($input);

        return redirect()->route('beneficios.index')->with('sucesso','Beneficio cadastrado com sucesso');
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
        $beneficios = Beneficio::find($id);
        if(!$beneficios){
            return back();
        }

        return view('beneficio.edit', compact('beneficios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $beneficios = Beneficio::find($id);

        $beneficios->fill($input);
        $beneficios->save();
        return redirect()->route('beneficios.index')->with('sucesso', 'Beneficio Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
