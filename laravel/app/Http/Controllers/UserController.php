<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $users = User::all()->sortBy('name');

        //Recebe os dados do banco
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Retorna o formulário de cadastro do funcionário
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->toArray();
        $input['password'] = bcrypt($input['password']); /* Linha que criptografa a senha do usuário com o método bcrypt, antes de guardar no banco */
        //dd($input);

        $input['user_id'] = 1;

        // Insert de dados no Banco
        User::create($input);

        return redirect()->route('users.index')->with('sucesso', 'Usuário Cadastrado com Sucesso!');
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
    public function edit(string $id, Request $request): View|Application|Factory|RedirectResponse
    {
//        $input = $request->toArray();

        $user = User::find($id);

        $input = $user;

        if(!$user){
            return back();
        }

        if($input['password'] != null){
            $input['password'] = bcrypt($input['password']);
        }else{
            $input['password'] = $user['password'];
        }


        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $user = User::find($id);

        $user->fill($input);
        $user->save();
        return redirect()->route('users.index')->with('sucesso', 'Usuário Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::find($id);

        //Apagando o registro do Banco de dados
        $user->delete();

        return redirect()->route('users.index')->with('sucesso', 'Usuário excluído com Sucesso.');
    }
}
