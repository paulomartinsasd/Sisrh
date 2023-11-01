<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = User::where('name', 'like','%'.$request->busca.'%')->orderBy('name', 'asc')->paginate(10);

        $totalUsers = User::all()->count();

        // Receber os dados do banco através
        return view('users.index', compact('users', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        User::create($input);

        return redirect()->route('users.index')->with('sucesso','Usuário cadastrado com sucesso');
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
        $user = User::find($id);

        if(!$user){
            return back();
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $user = User::find($id);

        if($request->password){
            $input['password'] = bcrypt($input['password']);
        } else {
            $input['password'] = $user['password'];
        }

        $user->fill($input);
        $user->save();
        return redirect()->route('users.index')->with('sucesso','Usuário alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
